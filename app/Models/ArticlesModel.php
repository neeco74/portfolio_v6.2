<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Articles;

class ArticlesModel extends Model
{
    // Le nom de la table MySQL
    protected $table = 'articles';

    // Le type d'objet à retourner
    protected $returnType = Articles::class;

    // Les champs modifiables
    protected $allowedFields = [
        'id_article',
        'titre',
        'slug',
        'contenu',
        'keywords',
        'created_at',
        'modified_at',
        'image_highlight_id',
        'categories_articles_id',
        'users_id',
    ];

    public function getArticles($id = false)
    {
        if ($id === false) {
            $query = $this->db->query('SELECT 
                a.id_article, 
                a.titre,
                a.slug,
                a.contenu,
                a.keywords,
                a.created_at,
                a.modified_at,
                a.image_highlight_id,
                a.categories_articles_id,
                a.users_id,

                i.id_image,
                i.name

                FROM articles a
                LEFT JOIN images i
                ON a.image_highlight_id = i.id_image');

            return $query->getResultArray();
        }

        return $this->asArray()
            ->where(['id_article' => $id])
            ->first();
    }


    public function highlightImage($id, $dataHighlight) {
        
        $builder = $this->db->table('articles');

        $builder->where('id_article', $id)->update($dataHighlight); 

    }

    public function updateArticle($id, $data) {

        $builder = $this->db->table('articles');

        $builder->where('id_article', $id)->update($data);

    }

    public function insertArticle($data) {

        $builder = $this->db->table('articles');

        $builder->insert($data);

    }

    public function deleteArticle($id) {

        $builder = $this->db->table('articles');

        $builder->where('id_article', $id)->delete();
        
    }

    public function lastInsertId() {

        return $this->db->insertID();
    }
}
