<?php

namespace App\Libraries;

use App\Entities\Users;
use App\Models\UsersModel;
use App\Libraries\Validator;
use App\Libraries\Str;
use App\Libraries\SendMail;


class Registration {

    private $usersModel;
    private $session;
    private const DESTINATAIRE_EMAIL = "olagnon.n@gmail.com";

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->session = session();

    }

    public function registerNewUser($prenom, $nom, $email, $password) {

        $password_hash = Str::hashPassword($password);
        $token = Str::random(60);
        $now = date('Y-m-d H:i:s');
        $login = strtolower($prenom) . '.' . strtolower($nom);

        $user = new Users;

        $user->login                = $login;
        $user->prenom               = ucfirst($prenom);
        $user->nom                  = ucfirst($nom);
        $user->email                = $email;
        $user->password             = $password_hash;
        $user->role                 = "user";
        $user->confirmation_token   = $token;
        $user->confirmation_at      = null;
        $user->reset_token          = null;
        $user->reset_at             = null;
        $user->remember_token       = null;
        $user->created_at           = $now;
        $user->modified_at          = $now;

        //$this->usersModel->insertNewUser($prenom, $nom, $email, $password, $token);
        $this->usersModel->save($user);

        $user->id_user = $this->usersModel->lastInsertId();


        // Mail de confirmation du compte
        $emailConfirmAccount = new SendMail();
        $emailConfirmAccount->prepareMailConfirmAccount($user->id_user, $token, $user->login, $user->email);


    }

    
    public function confirm($user_id, $token) {
        
        $user = $this->usersModel->getUserFromId($user_id);
        
        if ($user AND $user->confirmation_token == $token) {

            $this->usersModel->updateConfirmationToken($user_id);
           
            /* Nouvelle requetes pour avoir $user à jour */
            $user = $this->usersModel->getUserFromId($user_id);

            $this->session->set('authPortfolio', $user);

            return true;
        } 

        return false;
    }

}