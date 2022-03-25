<?php

namespace App\Libraries;

use Config\Services;


class SendMail {

    private $emailService;

    private $auteur; 
    private $auteurEmail; 
    private $destinataire = "Nicolas Olagnon"; 
    private $destinataireEmail = "olagnon.n@gmail.com";
    private $objet; 
    private $message;


    public function __construct()
    {
        $this->emailService = Services::email();

    }



    public function send() {
 
        $this->emailService->clear();

        if(empty($this->auteurEmail)) {
            $this->auteurEmail = 'Auteur non renseigné';
        }

        if(empty($this->objet)) {
            $this->objet = "Mail de la part de {$this->auteur}";
        }

        $this->emailService->setFrom($this->auteurEmail, $this->auteur);
        $this->emailService->setTo($this->destinataireEmail, $this->destinataire);

        $this->emailService->setSubject($this->objet);
        $this->emailService->setMessage($this->message);

        if(!$this->emailService->send()) {
            return false;
        }
        
        $this->emailService->clear();

        return true;
    }


    public function prepareMailConfirmAccount($id_user, $token, $userLogin, $userEmail) {

        $objet = "Nicolas Olagnon Portfolio : Confirmation de votre compte";

        $message = 'Bonjour, afin de valider votre compte, veuillez cliquez sur le lien suivant : ' . base_url() . '/confirm?id=' . $id_user . '&token=' . $token;

        $this->objet = $objet;
        $this->message = $message;
        $this->auteur = "Nicolas Olagnon Portfolio";
        $this->auteurEmail = "olagnon.n@gmail.com";
        $this->destinataire = $userLogin;
        $this->destinataireEmail = $userEmail;

        return $this->send();
    }



    public function prepareMailForgetPassword($id_user, $resetToken, $destinataire, $destinataireEmail) {

        $objet = 'Nicolas Olagnon Portfolio : Réinitialisation du mot de passe';

        $message = 'Bonjour, afin de generer un nouveau mot de passe, veuillez cliquez sur le lien suivant : ' . base_url() . '/reset?id=' . $id_user . '&token=' . $resetToken;

        $this->objet = $objet;
        $this->message = $message;
        $this->auteur = "Nicolas Olagnon Portfolio";
        $this->auteurEmail = "olagnon.n@gmail.com";
        $this->destinataire = $destinataire;
        $this->destinataireEmail = $destinataireEmail;

        return $this->send();
    }



    public function prepareMailContact($objet, $message, $auteur, $auteurEmail) {

        $this->objet = $objet;
        $this->message = $message;
        $this->auteur = $auteur;
        $this->auteurEmail = $auteurEmail;
        /*$this->destinataire = $destinataire;
        $this->destinataireEmail = $destinataireEmail;
*/
        return $this->send();
    }



}