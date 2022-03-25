<?php

namespace App\Controllers;

use App\Models\ImagesModel;
use App\Models\ArticlesModel;
use App\Models\PortfolioItemsModel;
use App\Models\CommentairesModel;
use App\Libraries\SendMail;

class HomeController extends BaseController
{

    protected $modelPortfolioItems;
    protected $modelArticles; 
    protected $mmodelImages;
    protected $modelCommentaires;
    protected $session;

    public function __construct() {

        $this->modelPortfolioItems    = new PortfolioItemsModel();
        $this->modelArticles          = new ArticlesModel();
        $this->modelImages            = new ImagesModel();
        $this->modelCommentaires      = new CommentairesModel();
        $this->session                = session();
        $this->config                 = config('MainConfig');

    }
    


    
    /**********************************************************/
    // route: "/home" appel Home::home
    public function home()
    {
        $imagesLastItemTriedJson = [];
        $isSeveralImages = false;
        $basePathImage = null;
        $articles = $this->modelArticles->getArticles();
        $lastItem = $this->modelPortfolioItems->getLastItem();

        if(!empty($lastItem)) {

            $imagesLastItem = $this->modelImages->getImagesInitialPortfolioItem($lastItem['id_portfolio_item']);

            if(!empty($imagesLastItem)) {

                $isSeveralImages = count($imagesLastItem) > 1 ? true : false;
    
                /* Algorithme de mise en avant de la photo du carroussel */
                $imagesLastItemTried = $this->algoHighlight($lastItem, $imagesLastItem);
    
                $imagesLastItemTriedJson = json_encode($imagesLastItemTried);
    
                $basePathImage = base_url() . '/uploads/';
            }
            else {
                $isSeveralImages = false;
                $imagesLastItemTriedJson = null;
                $basePathImage = base_url() . '/img/none.jpg';
            }

        }


        $dataview = [
            'lastPortfolioItem'         => $lastItem,
            'imagesJson'                => $imagesLastItemTriedJson,
            'articles'                  => $articles,
            'isSeveralImages'           => $isSeveralImages,
            'basePathImage'             => $basePathImage,
        ];

        return view('home/home', $dataview);
    }



    
    /**********************************************************/
    // route: "/profile" appel Home::profile
    public function profile()
    {
        return view('home/profile');
    }



    
    /**********************************************************/
    // route: "/contact" appel Home::contact
    public function contact()
    {
        
        if ($this->request->getMethod() == 'post' AND $this->request->getPost('contact_champ_login') AND $this->request->getPost('contact_champ_message')) {

            // Mail de contact
            $objet = $this->request->getPost('contact_champ_sujet');
            $message = $this->request->getPost('contact_champ_message');

            $auteur = $this->request->getPost('contact_champ_login');
            $auteurEmail = $this->request->getPost('contact_champ_email');  


            $emailContact = new SendMail();
            $send = $emailContact->prepareMailContact($objet, $message, $auteur, $auteurEmail);


            if($send) {
                session()->setFlashdata('success_contact', 'Le message a bien été envoyé');
            }
            else {         
                session()->setFlashdata('danger_contact', 'Le message n\'a pas été envoyé suite à une erreur');
            }
            
        }

        return view('home/contact');
    }



    
    /**********************************************************/
    // route: "/contact" appel Home::contact
    public function cv()
    {
        return view('home/cv');
    }



    
    /**********************************************************/
    // route: "/portfolio" appel Home::portfolio
    public function portfolio()
    {

        $dataview = [
            'portfolioItems'        => $this->modelPortfolioItems->getItems(),
            'portfolioItemsPerso'   => $this->modelPortfolioItems->getItemsPerso(),
            'portfolioItemsPro'     => $this->modelPortfolioItems->getItemsPro(),
            'portfolioItemsCi'      => $this->modelPortfolioItems->getItemsFramework("codeigniter"),
            'portfolioItemsSf'      => $this->modelPortfolioItems->getItemsFramework("symfony")
        ];

        echo view('home/portfolio', $dataview);
    }



    
    /**********************************************************/
    // route: "/portfolio/{id}-{slug}" appel Home::portfolioItem/$1
    public function portfolioItem($idItem)
    {

        if($this->request->getMethod() == 'post' AND $this->request->getPost('contenu_post')) {
            $this->postCommentaire($idItem, null);
        }

        $item = $this->modelPortfolioItems->getItems($idItem);

        if(empty($item)) {
            session()->setFlashdata('danger_home', 'Impossible de trouver l\'item: ' . $idItem);
            return redirect('portfolio');
        }

        /* Va chercher les images INITIALES - qui ne sont pas en 330x_ */
        $imagesItem = $this->modelImages->getImagesInitialPortfolioItem($idItem);

        if(!empty($imagesItem)) {

            $isSeveralImages = count($imagesItem) > 1 ? true : false;

            /* Algorithme de mise en avant de la photo du carroussel */
            $imagesItemTried = $this->algoHighlight($item, $imagesItem);

            $imagesItemTriedJson = json_encode($imagesItemTried);

            $basePathImage = base_url() . '/uploads/';
        }
        else {
            $isSeveralImages = false;
            $imagesItemTriedJson = null;
            $basePathImage = base_url() . '/img/none.jpg';
        }

        $listeCommentaires = $this->modelCommentaires->getCommentairesPortfolioItem($idItem);

        /*
        * LINK PREVIOUS/NEXT PORTFOLIO ITEM
        */
        $itemIdAndLink = $this->modelPortfolioItems->getItemsIdAndLink();

        $compteur = 0;

        foreach($itemIdAndLink as $key => $value) {
            if($value['id_portfolio_item'] == $idItem) {
                
                if($compteur != 0) {
                    $previousKey = $compteur - 1;
                    $linkPrevious = $itemIdAndLink[$previousKey]['item_url'];
                }
                if($compteur < count($itemIdAndLink) - 1) {
                    $nextKey = $compteur + 1;
                    $linkNext = $itemIdAndLink[$nextKey]['item_url']; 
                }
            }
            $compteur++;
        }

        $dataview = [
            'item'              => $item,
            'isSeveralImages'   => $isSeveralImages,
            'imagesJson'        => $imagesItemTriedJson,
            'listeCommentaires' => $listeCommentaires,
            'basePathImage'     => $basePathImage,
            'linkPrevious'      => $linkPrevious ?? '',
            'linkNext'          => $linkNext ?? ''
        ];

        return view('home/portfolio_id', $dataview);
    }



    
    /**********************************************************/
    // route: "/blog" appel Home::blog
    public function blog()
    {

        $dataview = [
            'articles' => $this->modelArticles->getArticles(),
        ];

        return view('home/blog', $dataview);
    }



    
    /**********************************************************/
    // route: "/blog/{id}-{slug}" appel Home::blogArticle/$1
    public function blogArticle($id)
    {
        if($this->request->getMethod() == 'post' AND  $this->request->getPost('contenu_post')) {

            $this->postCommentaire(null, $id);
        }

        $article = $this->modelArticles->getArticles($id);

        if(empty($article)) {
            session()->setFlashdata('danger_home', 'Impossible de trouver l\'article: ' . $id);
            return redirect('blog');
        }

        $imagesInitialArticle = $this->modelImages->getImagesInitialArticle($id);

        $imagesInitialArticleTried = $this->algoHighlight($article, $imagesInitialArticle);

        $listeCommentaires = $this->modelCommentaires->getCommentairesArticle($id);

        $compteur1 = 1;
        

        $dataview = [
            'article' => $article,
            'images' => $imagesInitialArticleTried,
            'listeCommentaires' => $listeCommentaires,
            'compteur1' => $compteur1,
           

        ];

        return view('home/blog_id', $dataview);
    }



    
    /**********************************************************/
    private function postCommentaire($idItem = null, $idArticle = null)
    {

        $rules = [
            'contenu_post' => 'required|min_length[5]|max_length[5000]',
        ];
 
        if ($this->validate($rules)) {

            $dateInsert = date('Y-m-d H:i:s');
            $modelCommentaires = new CommentairesModel();

            $data = [
                'auteur_login'          => $this->session->get('authPortfolio')->login,
                'contenu'               => $this->request->getPost('contenu_post'),
                'created_at'            => $dateInsert,
                'users_id'              => $this->session->get('authPortfolio')->id_user,
                'portfolio_items_id'    => $idItem,
                'articles_id'           => $idArticle
            ];

            $modelCommentaires->insert($data);

            $this->session->setFlashdata('success_commentaires', 'Lecommentaire a bien été ajouté');
            return true;

        } 
        else {
            $this->session->setFlashdata('danger_commentaires', 'Le commentaire n\'est pas valide');
            return false;
        }

    }




    /**********************************************************/
    private function algoHighlight($item, $images) {

        $compteur = 0;
        foreach ($images as $key => $value) {

            /* Si les deux valeurs match lors de la boucle */
            if ($item['image_highlight_id'] == ($value['id_image']) + 1) {

                /* Si le compteur est egal à zero, on ne fait rien car l'image est deja la premiere dans le tableau */
                if ($compteur > 0) {

                    /* On enregistre le compteur */
                    $keyCible = $compteur;

                    /* On sauvegarde la portion de tableau dans $output :  
                    array_slice(1,2,3) retourne une série d'éléments du tableau array (1) commençant à l'offset (2) et représentant length éléments (3)*/
                    $output = array_slice($images, $keyCible, 1);

                    /* On supprime la portion de tableau originel */
                    array_splice($images, $keyCible, 1);

                    /* Mise en premiere position de l'output trouvé, dans le data image // (1) tableau // (2) = 0 = position 0 // (3) = 0 = 0 suppression // (4) = insertion de output */
                    array_splice($images, 0, 0, $output);
                }

                break;

            }

            $compteur++;
        }

        return $images;
    }



}
