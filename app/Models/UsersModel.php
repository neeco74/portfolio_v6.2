<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Users;

class UsersModel extends Model
{
    // Le nom de la table MySQL
    protected $table = 'users';

    // Le type d'objet à retourner
    protected $returnType = Users::class;

    // Les champs modifiables
    protected $allowedFields = [
        'id_user',
        'login',
        'prenom',
        'nom',
        'email',
        'password',
        'role',
        'confirmation_token',
        'confirmation_at',
        'reset_token',
        'reset_at',
        'remember_token',
        'created_at',
        'modified_at'
    ];

    public function __construct() {

        $this->db = db_connect();

    }

    public function getDb() {

        return $this->db;

    }


    public function getUserFromId($user_id) {

        return $this->db->query('SELECT * FROM users WHERE id_user = ?', [$user_id])->getRow(0, Users::class);

    }

    public function getUserConfirmedFromEmail($email) {
        
        return $this->db->query('SELECT * FROM users WHERE email = ? AND confirmation_at IS NOT NULL', [$email])->getRow(0, Users::class);

    }
    
    public function updateRememberToken($remember_token, $user_id) {

        $this->db->query('UPDATE users SET remember_token = ? WHERE id_user = ?', [$remember_token, $user_id]);

    }
    
    public function updateConfirmationToken($user_id) {

        $this->db->query('UPDATE users SET confirmation_token = NULL, confirmation_at = NOW() WHERE id_user = ?', [$user_id]);

    }


/*     public function insertNewUser($prenom, $nom, $email, $password, $token) {

        $this->db->query("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?", [
            $username,
            $password,
            $email,
            $token
        ]);

    } */




    public function lastInsertId() {

        return $this->db->insertID();
    }






    public function updateResetToken($token, $user_id) {
        
        $this->db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id_user = ?', [$token, $user_id]);

    }

    public function checkResetToken($user_id, $token) {

        return $this->db->query('SELECT * FROM users WHERE id_user = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$user_id, $token])->getRow();

    }

    
    public function updateResetPassword($password, $id_user) {

        $this->db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id_user = ?', [$password, $_GET['id']]);
    }


    public function updatePassword($password, $id_user) {

        $this->db->query('UPDATE users SET password = ? WHERE id_user = ?', [$password, $id_user]);
    }


}