<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriesArticlesModel extends Model {
    
    protected $table = 'categories_articles';

    protected $allowedFields = [
        'titre',
        'slug'
    ];

    public function getCategoriesArticles($id = false) {

        if($id == false) {
            return $this->findAll();
        }

        return $this->asArray()->where(['id_categorie_article' => $id])->first(); 
    }


    public function updateCategorieArticle($id, $data) {

        $builder = $this->db->table('categories_articles');

        $builder->where(['id_categorie_article' => $id])->update($data);

    }

    public function insertCategorieArticle($data) {

        $builder = $this->db->table('categories_articles');

        $builder->insert($data);

    }

    public function deleteCategorieArticle($id) {

        $builder = $this->db->table('categories_articles');

        $builder->where('id_categorie_article', $id)->delete();
        
    }

}