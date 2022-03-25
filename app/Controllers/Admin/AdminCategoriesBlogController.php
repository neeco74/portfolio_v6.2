<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesArticlesModel;


class AdminCategoriesBlogController extends BaseController
{    
    
    protected $session;
    protected $categoriesArticlesModel;

    public function __construct()
    {
        $this->session = session();
        $this->modelCategoriesArticles = new CategoriesArticlesModel();
    }
 
    
    public function index()
    {
        $dataview = [
            'session' => $this->session,
            'catBlog'  => $this->modelCategoriesArticles->getCategoriesArticles(),
        ];

        return view('admin/categories_blog/index', $dataview);
    }


    public function edit($idCategorie = null)
    {
        $catBlog = [];

        if(isset($idCategorie)) {

            $catPortfolio = $this->modelCategoriesArticles->getCategoriesArticles($idCategorie);

            if(empty($catPortfolio)) {
                $this->session->setFlashdata('danger_home', 'Impossible de trouver la catégorie: ' . $idCategorie);
                return redirect('admin/cat-blog');
            }

        } 

        if($this->request->getMethod() === 'post') {

            $rules = [
                'titre' => 'required|min_length[3]|max_length[255]',
            ];

            if($this->validate($rules)) {

                if(isset($idCategorie)) {

                    // Si il y a l'id, on UPDATE
                    $data = [
                        'titre' => $this->request->getPost('titre'),
                        'slug'  => url_title($this->request->getPost('titre'), '-', TRUE),
                    ];

                    $this->modelCategoriesArticles->updateCategorieArticle($idCategorie, $data);

                    $this->session->setFlashdata('success_home', 'La catégorie a bien été modifié');
                }
                else {

                    // Sinon, (s'il n'y a pas l'id lors de la requete post), on INSERT
                    $data = [
                        'titre' => $this->request->getPost('titre'),
                        'slug'  => url_title($this->request->getPost('titre'), '-', true),
                    ];

                    $this->modelCategoriesArticles->insertCategorieArticle($data);;

                    $this->session->setFlashdata('success_home', 'La catégorie a bien été ajouté');

                }

                return redirect('admin/cat-blog');

            }
            $this->session->setFlashdata('danger_home', 'La catégorie n\'a pas été édité car les champs n\'ont pas été remplis correctement');
            return redirect('admin/cat-blog');

        }

        $dataview = [
            'catBlog' => $catBlog,

        ];

        return view('admin/categories_blog/edit', $dataview);
    }


    public function delete($idCategorie = null)
    {
        if(empty($idCategorie)) {
            session()->setFlashdata('danger_home', 'La catégorie n\'existe pas');
            return redirect('admin/cat-portfolio');
        } 

        $this->modelCategoriesArticles->deleteCategorieArticle($idCategorie);
        
        $this->session->setFlashdata('success_home', 'La catégorie a bien été supprimé');
        
        return redirect('admin/cat-blog');
    }



















}