<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->session = \Config\Services::session();   
    
        if($this->session->get('authPortfolio') !== null){
            
            if($this->session->get('authPortfolio')->role != "admin") {
            //echo '<pre>'.print_r($_SESSION, true).'</pre>';
                return redirect('/');
            }
        }
        else {
            return redirect('/');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}