<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriesPortfolioItemsModel extends Model {
    
    protected $table = 'categories_portfolio_items';

    protected $allowedFields = [
        'titre',
        'slug'
    ];

    public function getCategoriesPortfolioItems($id = false) {

        if($id == false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['id_categorie_portfolio_item' => $id])
            ->first(); 
    }


    public function updateCategoriePortfolioItem($id, $data) {

        $builder = $this->db->table('categories_portfolio_items');

        $builder->where(['id_categorie_portfolio_item' => $id])->update($data);

    }

    public function insertCategoriePortfolioItem($data) {

        $builder = $this->db->table('categories_portfolio_items');

        $builder->insert($data);

    }

    public function deleteCategoriePortfolioItem($id) {

        $builder = $this->db->table('categories_portfolio_items');

        $builder->where('id_portfolio_item', $id)->delete();
        
    }

}