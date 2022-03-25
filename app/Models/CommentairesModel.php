<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentairesModel extends Model
{
    protected $table = 'commentaires';

    protected $allowedFields = [
        'auteur_login', 
        'contenu', 
        'created_at', 
        'users_id', 
        'articles_id', 
        'portfolio_items_id'
    ];

    public function getCommentairesPortfolioItem($idItem) {
        $query = $this->db->query('SELECT 
            c.id_commentaire,
            c.auteur_login,
            c.contenu,
            c.created_at,
            c.users_id,
            c.articles_id,
            c.portfolio_items_id
        FROM commentaires c
        WHERE c.portfolio_items_id = '. $idItem); 

        return $query->getResultArray();
        
    }


    public function getCommentairesArticle($idArticle) {
        $query = $this->db->query('SELECT 
            c.id_commentaire,
            c.auteur_login,
            c.contenu,
            c.created_at,
            c.users_id,
            c.articles_id,
            c.portfolio_items_id
        FROM commentaires c
        WHERE c.articles_id = '. $idArticle); 
        
        return $query->getResultArray();
        
    }

}