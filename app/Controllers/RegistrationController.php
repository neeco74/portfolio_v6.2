<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Authentication;
use App\Libraries\Registration;
use Config\Services;


class RegistrationController extends BaseController
{

    private $auth;
    private $registration;
    protected $session;

    
    public function __construct()
    {
        $this->auth         = new Authentication(Services::request());
        $this->registration = new Registration();
        $this->session      = session();
    }


    public function register() {

        if($this->request->getPost()) {
        
            $rules = [
                'register_prenom' => [
                    'label' => 'Prenom',
                    'rules' => 'required|min_length[4]|max_length[20]',
                    'errors' => [
                        'required' => 'Un prénom est requis',
                        'min_length' => 'Le prénom doit faire au moins {param} caracteres',
                        'max_length' => 'Le prénom ne peut faire plus de {param} caracteres de long',
                
                    ]
                ],
                'register_nom' => [
                    'label' => 'Nom',
                    'rules' => 'required|min_length[4]|max_length[20]',
                    'errors' => [
                        'required' => 'Un nom est requis',
                        'min_length' => 'Le nom doit faire au moins {param} caracteres',
                        'max_length' => 'Le nom ne peut faire plus de {param} caracteres de long',
            
                    ]
                ],
                'register_email' => [
                    'label' => 'E-Mail',
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Un email est requis',
                        'valid_email' => 'L\'email doit être valide',
                        'is_unique' => 'Cet email est déja pris'

                    ]
                ],
                'register_password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[4]|max_length[20]',
                    'errors' => [
                        'required' => 'A password is required',
                        'min_length' => 'Le mot de passe doit contenir au moins {param} caracteres',
                        'max_length' => 'Le mot de passe doit faire au maximum {param} caracteres',
                    ]
                ],
                'register_cpassword' => [
                    'label' => 'Password Confirmation',
                    'rules' => 'required|matches[register_password]',
                    'errors' => [
                        'required' => 'Must confirm password',
                        'matches' => 'Les mots de passes ne correspondent pas'
                    ]
                ]
            ];

            $validate = $this->validate($rules);

            if($validate) {
                
                $prenom     = $this->request->getPost('register_prenom');
                $nom        = $this->request->getPost('register_nom');
                $email      = $this->request->getPost('register_email');
                $password   = $this->request->getPost('register_password');

                $user = $this->registration->registerNewUser($prenom, $nom, $email, $password);
        
                $this->session->setFlashdata('success_login', "Un email vous a été envoyé pour confirmer votre compte");

                return redirect('/');
                
            }
            else {
                $errors = $this->validator->getErrors();

                $this->session->setFlashdata('danger_login', $errors);

                return redirect('/')->withInput();
                
            }
        }
        return view('root/index');
        
    }


    public function confirm() {

        if($this->request->getGet()) {
            
            if($this->registration->confirm($this->request->getGet('id'), $this->request->getGet('token'))) {
        
                $this->session->setFlashdata('success_home', "Votre compte a bien été validé");
            
                return redirect('home');
  
            } 
            else {
                $this->session->setFlashdata('danger_login', "Ce lien a expiré");
            
                return redirect('/');
            }
        }
        else {
            return redirect('/');
     
        }
    }






    private function setUserSession($user)
    {
        session()->set('auth', [
            'id_user'               => $user->id_user,
            'login'                 => $user->login,
            'prenom'                => $user->prenom,
            'nom'                   => $user->nom,
            'email'                 => $user->email,
            'password'              => $user->password,
            'role'                  => $user->role,
            'confirmation_token'    => $user->confirmation_token, 
            'confirmation_at'       => $user->confirmation_at,
            'reset_token'           => $user->reset_token, 
            'reset_at'              => $user->reset_at,
            'remember_token'        => $user->remember_token,
            'created_at'            => $user->created_at,
            'modified_at'           => $user->modified_at 
        ]);
        
    }





}


