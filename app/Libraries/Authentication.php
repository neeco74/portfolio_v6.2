<?php


namespace App\Libraries;

use App\Models\UsersModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Libraries\Str;
use App\Libraries\SendMail;
use App\Entities\Users;

class Authentication {

    private $session;
    private $request;
    private $errors;

    /* MIGRÉ VERS MAINCONFIG
    private const LOGIN_INVITE = ["invite", "invité", "Invite", "Invité"];
    private const PASSWORD_INVITE = "74269";
    private const KEY_COOKIE = 'ratons';
    private const DESTINATAIRE_EMAIL = "olagnon.n@gmail.com";

    private static $timeCookie = 3600 * 24 * 3;
*/
    
    public function __construct(RequestInterface $request)
    {
        $this->usersModel   = new UsersModel();
        $this->session      = session();
        $this->request      = $request;
        $this->config       = config('MainConfig');
    }


    public function login($email, $password, $remember = false) {

        if(in_array($email, $this->config::LOGIN_INVITE) AND $password == $this->config::PASSWORD_INVITE) {

            $userInvite = $this->createUserInvite();

            $this->connect($userInvite);

            if($remember) {
                $this->remember();
            }
            
            

            return $userInvite;
        }  
        // si jamais la date de confirm est null, le client n a pas valider son compte
        $user = $this->usersModel->getUserConfirmedFromEmail($email);
        
        if($user AND (password_verify($password, $user->password))){
            
            $this->connect($user);

            if($remember) {
                $this->remember($user->id_user);
            }

            return $user;
        }
        else {
            return false;
    
        }
    }

    public function connectFromCookie() {
        
        if($this->request->getCookie('remember') && !$this->getAuthPortfolio()) {

            $remember_token = $this->request->getCookie('remember');
            $parts = explode('====', $remember_token);
            $user_id = $parts[0];

            // Cookie invité
            if($user_id == 0) {

                $expected = $user_id . '====' . sha1($user_id . $this->config::KEY_COOKIE);
                
                $user = $this->createUserInvite();
            }
            else {
                $user = $this->usersModel->getUserFromId($user_id);
                
                if($user) {
                    $expected = $user->id_user . '====' . $user->remember_token . sha1($user_id . $this->config::KEY_COOKIE);
                  
                }
            }
           
            // false si fetch vide
            if($user) {

                if($expected == $remember_token) {

                    $this->connect($user);

                    setcookie('remember', $remember_token, time() + $this->config::$timeCookie);
        
                    return true;
                    
                }
                else {
                    setcookie('remember', '', -1);

                    return false;
                }
            }
            else {
                setcookie('remember', '', -1);

                return false;

            }
        }
        return;
    }


    public function connect($user) {
        $this->session->set('authPortfolio', $user);
        $this->session->set('isLoggedIn', true);
    }


    public function remember($user_id = null) {
        $remember_token = Str::random(50);

        if(!is_null($user_id)) {
            $this->usersModel->updateRememberToken($remember_token, $user_id);

            setcookie('remember', $user_id . '====' . $remember_token . sha1($user_id . $this->config::KEY_COOKIE), time() + $this->config::$timeCookie);
        }
        else {
            $user_id = 0;

            setcookie('remember', $user_id . '====' . sha1($user_id . $this->config::KEY_COOKIE), time() + $this->config::$timeCookie);
        }


    }


    public function restrict() {

        if(!$this->session->get('authPortfolio')) {
            if(!$this->request->getCookie('remember')) {
                $this->session->setFlashdata('danger', "Vous n'avez pas le droit d'acceder à cette page");
            }
            return true;
        }
        return false;
    }

    public function getAuthPortfolio() {
        if(!$this->session->get('authPortfolio')) {
            return false;
        }
        return $this->session->get('authPortfolio');
    }

    public function getIsLoggedIn() {
        if(!$this->session->get('isLoggedIn')) {
            return false;
        }
        return true;
    }




    public function updateCookieRemember() {
        
        if($this->request->getCookie('remember')) {
            $value = $this->request->getCookie('remember');
            setcookie('remember', $value, time() + $this->config::$timeCookie);
        }
    }


    public function logout() {

        setcookie('remember', NULL, -1);

        $this->session->set('authPortfolio', []);
        
        $this->session->destroy();
        
        
    }

    public function mailForgetPassword($email) {

        $user = $this->usersModel->getUserConfirmedFromEmail($email);

        if($user){

            $resetToken = Str::random(60);
            
            $this->usersModel->updateResetToken($resetToken, $user->id_user);
  
    
            $emailForgetPassword = new SendMail();
            $send = $emailForgetPassword->prepareMailForgetPassword($user->id_user, $resetToken, $user->login, $email);

            if(!$send) {
                return false;
            }

            return $user;
        }
        else {
            return false;
        }

    }


    public function checkResetToken() {

        $fetch = $this->usersModel->checkResetToken($this->request->getGet('id'), $this->request->getGet('token'));
        
        return !empty($fetch) ? $fetch : false;

    }

    public function updateResetPassword() {

        $password_hash = Str::hashPassword($this->request->getPost('reset_password'));

        $this->usersModel->updateResetPassword($password_hash, $this->request->getGet('id'));

    }
    

    public function getErrors() {
        return $this->errors;
    }

    public function createUserInvite() {

        $user = new Users;

        $user->id_user              = null;
        $user->login                = "invite";
        $user->prenom               = null;
        $user->nom                  = null;
        $user->email                = null;
        $user->password             = null;
        $user->role                 = "invite";
        $user->confirmation_token   = null;
        $user->confirmation_at      = null;
        $user->reset_token          = null;
        $user->reset_at             = null;
        $user->remember_token       = null;
        $user->created_at           = null;
        $user->modified_at          = null;

        return $user;
    }





}