<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesPortfolioItemsModel;
use App\Models\PortfolioItemsModel;
use App\Models\ImagesModel;
use App\Libraries\ImagesManager;
use App\Libraries\ImagesResizer;


class AdminPortfolioController extends BaseController
{
    protected $catPortfolioItemsModel;
    protected $modelPortfolioItems ;
    protected $modelImages;
    protected $imageResizer;
    protected $db;
    protected $session;


    public function __construct()
    {
        $this->modelCategoriesPortfolioItems   = new CategoriesPortfolioItemsModel();
        $this->modelPortfolioItems      = new PortfolioItemsModel();
        $this->modelImages              = new ImagesModel();

        $this->imageResizer             = new ImagesResizer();

        $this->db                       = db_connect();
        $this->session                  = session();
    }


    /**********************************************************/
    // route: "admin/portfolio" appel Admin\AdminPortfolioController::index
    public function index()
    {

        if ($this->request->isAJAX()) {

            $this->modelPortfolioItems->updatePositionItem($this->request->getPost("idItem"), $this->request->getPost("position"));

            return $this->response->setJSON(true);
        }

        $numberOfItems = $this->modelPortfolioItems->count();

        $dataview = [
            'numberOfItems' => $numberOfItems,
            'session'       => $this->session,
            'items'         => $this->modelPortfolioItems->getItems(),
        ];

        return view('admin/portfolio/index', $dataview);
    }



    /**********************************************************/
    // route: "admin/portfolio/edit/(:num)" appel Admin\AdminPortfolioController::edit/$1
    public function edit($idItem = null)
    {
        $now = date('Y-m-d H:i:s');
        $item = null;
        $listeTitreCategoriePortfolio = [];
        $images = [];

        $categoriesPortfolioItemsAll = $this->modelCategoriesPortfolioItems->getCategoriesPortfolioItems();

        foreach($categoriesPortfolioItemsAll as $categorie){
            $listeTitreCategoriePortfolio[$categorie['id_categorie_portfolio_item']] = $categorie['titre'];
        }


        if(isset($idItem)) {

            $item = $this->modelPortfolioItems->getItems($idItem);

            if(empty($item)) {
                $this->session->setFlashdata('danger_home', 'Impossible de trouver l\'item: ' . $idItem);
                return redirect('admin/portfolio');
            }

            $images = $this->modelImages->getSmallImages("portfolio_items_id", $idItem);

            /**
            * Mise en avant d'une image
            **/
            if($this->request->getGet('highlight')) {

                ImagesManager::highlightImage($idItem, $this->request->getGet('highlight'), "portfolio_item");

                $this->session->setFlashdata('success_home', 'L\'image a bien été mise en avant');
                
                return redirect()->to(base_url('admin/portfolio/edit/'.$idItem));

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

                return redirect()->to(base_url('admin/portfolio/edit/'.$idItem));
                
            }
        } //END: if(isset($idItem)){



        if($this->request->getMethod() === 'post') {

            $rules = [
                'titre' => 'required|min_length[3]|max_length[255]',
                'theFile' => 'max_size[theFile, 1024]|is_image[theFile]'
            ];

            if($this->validate($rules)) {

                if(isset($idItem)) {

                    // Si il y a l'id, on UPDATE
                    $data = [
                        'titre'                     => $this->request->getPost('titre'),
                        'date_realisation'          => $this->request->getPost('date_realisation'),
                        'slug'                      => url_title($this->request->getPost('titre'), '-', true),
                        'description_subtitle'      => $this->request->getPost('description_sous'),
                        'description_type_projet'   => $this->request->getPost('description_type_projet'),
                        'description_contenu'       => $this->request->getPost('description_contenu'),
                        'access_login_admin'        => $this->request->getPost('access_login_admin'),
                        'access_mdp_admin'          => $this->request->getPost('access_mdp_admin'),
                        'access_login_user'         => $this->request->getPost('access_login_user'),
                        'access_mdp_user'           => $this->request->getPost('access_mdp_user'),
                        'site_url'                  => $this->request->getPost('site_url'),
                        'keywords'                  => $this->request->getPost('keywords'),
                    ];

                    if($this->request->getPost('categories_portfolio_items_id')) {
                        $data['categories_portfolio_items_id'] = $this->request->getPost('categories_portfolio_items_id');
                    }
                
                    if($this->request->getPost('item_highlight')) {
                        $data['modified_at'] = $now;
                    }
                    
                    $this->modelPortfolioItems->updatePortfolioItem($idItem, $data);


                    $this->session->setFlashdata('success_home', 'L\'item a bien été modifié');

                    if($this->request->getFiles()) {
                        ImagesManager::manageFiles($this->request->getFiles(), $idItem, "portfolio_items_id", 330, true);
                    }

                } 
                else {

                    // Sinon, (s'il n'y a pas l'id lors de la requete post), on INSERT
                    $data = [                  
                        'titre'                     => $this->request->getPost('titre'),
                        'date_realisation'          => $this->request->getPost('date_realisation'),
                        'slug'                      => url_title($this->request->getPost('titre'), '-', true),
                        'description_subtitle'      => $this->request->getPost('description_sous'),
                        'description_type_projet'   => $this->request->getPost('description_type_projet'),
                        'description_contenu'       => $this->request->getPost('description_contenu'),
                        'access_login_admin'        => $this->request->getPost('access_login_admin'),
                        'access_mdp_admin'          => $this->request->getPost('access_mdp_admin'),
                        'access_login_user'         => $this->request->getPost('access_login_user'),
                        'access_mdp_user'           => $this->request->getPost('access_mdp_user'),
                        'site_url'                  => $this->request->getPost('site_url'),
                        'keywords'                  => $this->request->getPost('keywords'),
                        'created_at'                => $now,
                        'users_id'                  => $this->session->get('authPortfolio')->id_user
                    ];

                    /**
                     * Obliger de passer par une condition if, car if(string vide) = false, donc le if ne se fait pas, et donc la bdd enregistre une valeure null comme souhaité et non 0
                     */
                    if($this->request->getPost('categories_portfolio_items_id')) {

                        $data['categories_portfolio_items_id'] = $this->request->getPost('categories_portfolio_items_id');
                        
                    }
                    
                    if($this->request->getPost('item_highlight')) {

                        $data['modified_at'] = $now;

                    }

                    $this->modelPortfolioItems->insertPortfolioItem($data);

                    $lastInsertPortfolioItemId = $this->modelPortfolioItems->lastInsertId();


                    
                    $dataItem['item_url'] = $lastInsertPortfolioItemId . '-' . $data['slug'];
                    

                    $this->modelPortfolioItems->updatePortfolioItem($lastInsertPortfolioItemId, $dataItem);
                   

                    if($this->request->getFiles()) {
                        ImagesManager::manageFiles($this->request->getFiles(), $lastInsertPortfolioItemId, "portfolio_items_id", 330, true);
                    }

                    $this->session->setFlashdata('success_home', 'L\'item a bien été ajouté');
                }

                return redirect('admin/portfolio');
            }

            $this->session->setFlashdata('danger_home', "L'item' n'a pas été édité car certains champs n'ont pas été remplis correctement");
            return redirect('admin/portfolio');

        }

        $dataview = [
            'item' => $item,
            'images' => $images,
            'listeTitreCategoriePortfolio' => $listeTitreCategoriePortfolio
        ];

        return view('admin/portfolio/edit', $dataview);
    }


    /**********************************************************/
    // route: "admin/portfolio/delete/{id}" appel Admin\AdminPortfolioController::delete/$1
    public function delete($idItem = null)
    {
        if (empty($idItem)) {
            $this->session->setFlashdata('danger_home', 'L\'item n\'existe pas');
            return redirect('admin/portfolio'); 
        } 

        $this->modelPortfolioItems->deletePortfolioItem($idItem);
        
        $this->session->setFlashdata('success_home', 'L\'item a bien été supprimé');

        return redirect('admin/portfolio');
    }


}
