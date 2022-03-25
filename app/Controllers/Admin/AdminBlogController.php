<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesArticlesModel;
use App\Models\ArticlesModel;
use App\Models\ImagesModel;
use App\Libraries\ImagesManager;
use App\Libraries\ImagesResizer;
use DateTime;

class AdminBlogController extends BaseController
{

    protected $modelArticles ;
    protected $modelImages;
    protected $imageResizer;
    protected $db;
    protected $session;


    public function __construct()
    {
        $this->modelCategoriesArticles  = new CategoriesArticlesModel();
        $this->modelArticles            = new ArticlesModel();
        $this->modelImages              = new ImagesModel();

        $this->imageResizer             = new ImagesResizer();

        $this->db                       = db_connect();
        $this->session                  = session();
    }


    /**********************************************************/
    // route: "admin/blog" appel Admin\AdminBlogController::index
    public function index()
    {
        $dataview = [
            'session'       => $this->session,
            'articles'      => $this->modelArticles->getArticles(),
        ];

        return view('admin/blog/index', $dataview);
    }



    /**********************************************************/
    // route: "admin/blog/edit/(:num)" appel Admin\AdminBlogController::edit/$1
    public function edit($idArticle = null)
    {
        $now = date('Y-m-d H:i:s');
        $article = null;
        $images = [];
        $listeTitreCategorieArticle = [];

        $categoriesArticlesAll = $this->modelCategoriesArticles->getCategoriesArticles();

        foreach($categoriesArticlesAll as $categorie){
            $listeTitreCategorieArticle[$categorie['id_categorie_article']] = $categorie['titre'];
        }

        if(isset($idArticle)) {

            $article = $this->modelArticles->getArticles($idArticle);

            if(empty($article)) {
                $this->session->setFlashdata('danger_home', 'Impossible de trouver l\'article: ' . $idArticle);
                return redirect('admin/blog');
            }

            $images = $this->modelImages->getSmallImages("articles_id", $idArticle);

            /**
            * Mise en avant d'une image
            **/
            if($this->request->getGet('highlight')) {

                ImagesManager::highlightImage($idArticle, $this->request->getGet('highlight'), "article");

                $this->session->setFlashdata('success_home', 'L\'image a bien été mise en avant');

                return redirect()->to(base_url('admin/blog/edit/'.$idArticle));

            }
            
            if($this->request->getGet('deleteimg')) {

                $idImage = $this->request->getGet('deleteimg');

                $result = ImagesManager::deleteImage($idImage);

                if($result === true) {
                    $this->session->setFlashdata('success_home', "L'image $idImage a bien été supprimé");
                }
                else {
                    $this->session->setFlashdata('danger_home', $result);
                }

                return redirect()->to(base_url('admin/blog/edit/'.$idArticle));
                
            }
        } //END: if(isset($idArticle)){


        if($this->request->getMethod() === 'post') {
                            
            $rules = [ 
                'titre'                     => 'required|min_length[3]|max_length[255]',
                'contenu'                   => 'required',
                'keywords'                  => 'required|max_length[255]',
                
                'theFile'                   => 'max_size[theFile, 8024]|is_image[theFile]'
            ];

            if($this->validate($rules)) {

                if(isset($idArticle)) {

                    // Si il y a l'id, on UPDATE
                    $data = [
                        'titre'                     => $this->request->getPost('titre'),
                        'slug'                      => url_title($this->request->getPost('titre'), '-', true),
                        'contenu'                   => $this->request->getPost('contenu'),
                        'keywords'                  => $this->request->getPost('keywords'),
                        'modified_at'               => $now,
                    ];

                    if($this->request->getPost('categories_articles_id')) {
                        $data['categories_articles_id'] = $this->request->getPost('categories_articles_id');
                    }

                    $this->modelArticles->updateArticle($idArticle, $data);

                    if($this->request->getFiles()) {
                        ImagesManager::manageFiles($this->request->getFiles(), $idArticle, "articles_id", 330, true);
                    }

                    $this->session->setFlashdata('success_home', 'L\'article a bien été modifié');
                } 
                else {

                    // Sinon, (s'il n'y a pas l'id lors de la requete post), on INSERT
                    $data = [
                        'titre'                     => $this->request->getPost('titre'),
                        'slug'                      => url_title($this->request->getPost('titre'), '-', true),
                        'contenu'                   => $this->request->getPost('contenu'),
                        'keywords'                  => $this->request->getPost('keywords'),
                        'created_at'                => $now,
                        'modified_at'               => $now,
                        'users_id'                  => $this->session->get('authPortfolio')->id_user
                    ];

                    if($this->request->getPost('categories_articles_id')) {
                        $data['categories_articles_id'] = $this->request->getPost('categories_articles_id');
                    }
                
                    $this->modelArticles->insertArticle($data);                    

                    $lastInsertArticleId = $this->modelArticles->lastInsertId();

                    
                    if($this->request->getFiles()) {
                        $lastInsertImageId = ImagesManager::manageFiles($this->request->getFiles(), $lastInsertArticleId, "articles_id", 330, true);

                        if(isset($lastInsertImageId)) {
                            ImagesManager::highlightImage($lastInsertArticleId, $lastInsertImageId, "article");
                        }
                    }
                    
                    $this->session->setFlashdata('success_home', 'L\'article a bien été ajouté');
                }

                return redirect('admin/blog');
            }

            $this->session->setFlashdata('danger_home', 'L\'article n\'a pas été édité car certains champs n\'ont pas été remplis correctement');
            return redirect('admin/blog');

        }

        $dataview = [
            'article' => $article,
            'images' => $images,
            'listeTitreCategorieArticle' => $listeTitreCategorieArticle
        ];

        return view('admin/blog/edit', $dataview);
    }


    /**********************************************************/
    // route: "admin/portfolio/delete/{id}" appel Admin\AdminPortfolioController::delete/$1
    public function delete($idArticle = null)
    {
        if (empty($idArticle)) {
            $this->session->setFlashdata('danger_home', 'L\'article n\'existe pas');
            return redirect('admin/blog'); 
        } 

        $this->modelArticles->deleteArticle($idArticle);
        
        $this->session->setFlashdata('success_home', 'L\'article a bien été supprimé');

        return redirect('admin/blog');
    }


}
