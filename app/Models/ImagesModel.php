<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagesModel extends Model
{
    protected $table = 'images';

    protected $allowedFields = [
        'id_image', 
        'name', 
        'articles_id', 
        'portfolio_items_id'
    ];



    public function getImagesInitialPortfolioItem($id)
    {
        $query = $this->db->query('SELECT id_image, name    
        FROM images 
        WHERE portfolio_items_id = ' . $id . ' AND name NOT LIKE "330x_%"');

        return $query->getResultArray();

    }

    // Une seule image par article autorisée
    public function getImagesInitialArticle($id)
    {
        $query = $this->db->query('SELECT id_image, name   
        FROM images 
        WHERE articles_id = ' . $id . ' AND name NOT LIKE "330x_%"');

        return $query->getResultArray();
    }

    public function getSmallImages($champOfTableImages, $id) {

        $builder = $this->db->table('images');

        return $builder->where($champOfTableImages, $id)
                ->like('name', '330x_%')
                ->orLike('name', '600x_%')
                ->get()
                ->getResultArray();

    }

    public function getImageFromId($id) {

        $builder = $this->db->table('images');

        return $builder->where('id_image', $id)->get()->getRowArray();

    }

    public function deleteImage($id = null, $name = null) {

        $builder = $this->db->table('images');

        if(isset($id)) {
            $builder->where('id_image', $id);
        }
        if(isset($name)) {
            $builder->orWhere('name', $name);
        }

        $builder->delete();

    }

    public function insertImage($data) {
        
        $builder = $this->db->table('images');

        $builder->insert($data);
    
    }

    public function lastInsertId() {

        return $this->db->insertID();
    }
}