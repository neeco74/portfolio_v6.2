<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Authentication;
use App\Libraries\Registration;
use Config\Services;


class LoginController extends BaseController
{

    private $auth;
    private $registration;
    protected $session;

    public function __construct()
    {
        $this->auth         = new Authentication(Services::request());
        $this->session      = session();
    }


    public function login()
    {

        if($this->request->getPost('login_email') AND $this->request->getPost('login_password')) {

            $user = $this->auth->login($this->request->getPost('login_email'), $this->request->getPost('login_password'), $this->request->getPost('remember'));

            if($user) {
                if($user->login == "invite") {
                    $this->session->setFlashdata('success_home', "Vous êtes maintenant connecté en tant qu'invité");
                }
                else {
                    $this->session->setFlashdata('success_home', "{$user->prenom} {$user->nom}, vous êtes maintenant connecté");
                }

                return redirect('home');
            } 
            else {
                $this->session->setFlashdata('danger_login', "Identifiant ou mot de passe incorrect");
                
            }
        }
        return redirect('/');
    }



    public function logout()
    {

        
        setcookie('remember', '', -1);
        //$this->session->set('auth', []);
        $this->session->destroy();

        if($this->request->uri->getQuery() == "register=1") {
            
            return redirect()->deleteCookie('remember')->to(base_url('/?register=1'));
        }

        return redirect('/')->deleteCookie('remember');
    }


    public function forgetPassword()
    {

        if($this->request->getPost() AND $this->request->getPost('forget_email')) {

            if($this->auth->mailForgetPassword($this->request->getPost('forget_email'))) {

                $this->session->setFlashdata('success_login', "Les instructions de rappel de mot de passe vous ont été envoyées par email");
            } 
            else {
                $this->session->setFlashdata('danger_login', "Aucun compte ne correspond à cet adresse");
            }
        }
        return redirect('/');
    }


    public function resetPassword()
    {
        if($this->request->getGet('id') AND $this->request->getGet('token')) {

            $user = $this->auth->checkResetToken();

            if($user) {

                if($this->request->getPost()) {
                    $rules = [
                        'reset_password' => [
                            'label' => 'Password',
                            'rules' => 'required|min_length[4]|max_length[20]',
                            'errors' => [
                                'required' => 'A password is required.',
                                'min_length' => 'Le mot de passe doit contenir au moins {param} caracteres',
                                'max_length' => 'Le mot de passe doit faire au maximum {param} caracteres',
                            ]
                        ],
                        'reset_cpassword' => [
                            'label' => 'Password Confirmation',
                            'rules' => 'required|matches[reset_password]',
                            'errors' => [
                                'required' => 'Must confirm password.',
                                'matches' => 'Les mots de passe ne correspondent pas'
                            ]
                        ]
                    ];

                    $validate = $this->validate($rules);


                    if($validate) {

                        $this->auth->updateResetPassword();

                        //$this->auth->connect($user);

                        $this->session->setFlashdata('success_login', "Votre mot de passe a bien été modifié");

                        return redirect('/');

                    } 
                    else {
                        $errors = $this->validator->getErrors();

                        $this->session->setFlashdata('danger_login', $errors);

                        return redirect('/')->withInput();
                    }
                }
                return view('root/reset');
            } 
            else {
                $this->session->setFlashdata('danger_login', "Ce lien n'est pas valide");

                return redirect('/');
            }
        }
        return redirect('/');
    }
}
