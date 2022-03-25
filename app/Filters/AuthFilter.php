<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    private $session;

    public function before(RequestInterface $request, $arguments = null)
    {
        $this->session = \Config\Services::session();   
        
        // activer ou desactiver le login et l'invité
        $isAuthActive = 1;
        $isinviteActive = 0;

        if($isAuthActive) {  

            if(empty($this->session->get('authPortfolio'))){
                
                //echo '<pre>'.print_r($_SESSION, true).'</pre>';
                return redirect('/');
            }
            
        }
        else {
            if($isinviteActive) {
                session()->set('authPortfolio', [
                    'id_user'       => null, 
                    'login'         => 'user.user',       // null ici permet de ne pas permettre les commentaires pour user     
                    'prenom'        => 'user',
                    'nom'           => 'user',
                    'email'         => '',
                    'password'      => 'user4556',
                    'role'          => '',
                ]);
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}