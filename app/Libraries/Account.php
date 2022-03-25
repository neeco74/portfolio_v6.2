<?php

namespace App\Libraries;

use App\Models\UsersModel;
use App\Libraries\Validator;
use App\Libraries\Str;
use App\Libraries\SendMail;
use CodeIgniter\HTTP\RequestInterface;

class Account {

    private $request;
    protected $session;

    public function __construct(RequestInterface $request) 
    {
        $this->usersModel = new UsersModel();
        $this->request = $request;
        $this->session = session();
    }

    public function isPasswordValid() {

        $validator = new Validator($this->request->getPost());
        $validator->isConfirmed('password');
        return $validator->isValid() ? true : false;

    }


    public function changePassword() {

        $password = Str::hashPassword($this->request->getPost('password'));
                
        $id_user = $this->session->get('authPortfolio')->id_user;
    
        $this->usersModel->updatePassword($password, $id_user);
    
    
    }


}