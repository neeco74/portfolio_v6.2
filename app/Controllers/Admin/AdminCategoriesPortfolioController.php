<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesPortfolioItemsModel;


class AdminCategoriesPortfolioController extends BaseController
{    
    
    protected $session;
    protected $categoriesPortfolioItemsModel;

    public function __construct()
    {
        $this->session = session();
        $this->modelCategoriesPortfolioItems = new CategoriesPortfolioItemsModel();
    }
 
    
    public function index()
    {
        $dataview = [
            'session' => $this->session,
            'catPortfolio'  => $this->modelCategoriesPortfolioItems->getCategoriesPortfolioItems(),
        ];

        return view('admin/categories_portfolio/index', $dataview);
    }


    public function edit($id = null)
    {
        $catPortfolio = [];

        if(isset($id)) {

            $catPortfolio = $this->modelCategoriesPortfolioItems->getCategoriesPortfolioItems($id);

            if(empty($catPortfolio)) {
                $this->session->setFlashdata('danger_home', 'Impossible de trouver la catégorie: ' . $id);
                return redirect('admin/cat-portfolio');
            }

        } 

        if($this->request->getMethod() === 'post') {

            $rules = [
                'titre' => 'required|min_length[3]|max_length[255]',
            ];

            if($this->validate($rules)) {

                if(isset($id)) {

                    // Si il y a l'id, on UPDATE
                    $data = [
                        'titre' => $this->request->getPost('titre'),
                        'slug'  => url_title($this->request->getPost('titre'), '-', TRUE),
                    ];

                    $this->modelCategoriesPortfolioItems->updateCategoriePortfolioItem($id, $data);

                    $this->session->setFlashdata('success_home', 'La catégorie a bien été modifié');
                }
                else {

                    // Sinon, (s'il n'y a pas l'id lors de la requete post), on INSERT
                    $data = [
                        'titre' => $this->request->getPost('titre'),
                        'slug'  => url_title($this->request->getPost('titre'), '-', TRUE),
                    ];

                    $this->modelCategoriesPortfolioItems->insertCategoriePortfolioItem($data);;

                    $this->session->setFlashdata('success_home', 'La catégorie a bien été ajouté');

                }

                return redirect('admin/cat-portfolio');

            }
            $this->session->setFlashdata('danger_home', 'La catégorie n\'a pas été édité car les champs n\'ont pas été remplis correctement');
            return redirect('admin/cat-portfolio');

        }

        $dataview = [
            'catPortfolio' => $catPortfolio,

        ];

        return view('admin/categories_portfolio/edit', $dataview);
    }


    public function delete($id = null)
    {
        if(empty($id)) {
            session()->setFlashdata('danger_home', 'La catégorie n\'existe pas');
            return redirect('admin/cat-portfolio');
        } 

        $this->modelCategoriesPortfolioItems->deleteCategoriePortfolioItem($id);
        
        $this->session->setFlashdata('success_home', 'La catégorie a bien été supprimé');
        
        return redirect('admin/categories_portfolio');
    }



















}