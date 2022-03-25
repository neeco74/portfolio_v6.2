<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\PortfolioItems;

class PortfolioItemsModel extends Model
{
    // Le nom de la table MySQL
    protected $table = 'portfolio_items';

    // Le type d'objet à retourner
    protected $returnType = PortfolioItems::class;

    // Les champs modifiables
    protected $allowedFields = [
        'id_portfolio_item', 
        'titre', 
        'slug', 
        'description_subtitle', 
        'description_type_projet', 
        'description_contenu',
        'access_login_admin',
        'access_mdp_admin',
        'access_login_user',
        'access_mdp_user',
        'site_url',
        'item_url',
        'keywords',  
        'sort_order',  
        'date_realisation',  
        'created_at', 
        'modified_at', 
        'users_id', 
        'image_highlight_id',
        'categories_portfolio_items_id',
    ];

    public function getItems($id = false)
    {
        if($id === false) {
            
            $query = $this->db->query('SELECT 
                p.id_portfolio_item, 
                p.titre,
                p.slug,
                p.description_subtitle,
                p.description_type_projet,
                p.description_contenu,
                p.access_login_admin,
                p.access_mdp_admin,
                p.access_login_user,
                p.access_mdp_user,
                p.site_url,
                p.item_url,
                p.keywords,
                p.sort_order,
                p.date_realisation,
                p.created_at,
                p.modified_at,
                p.users_id,
                p.image_highlight_id,
                p.categories_portfolio_items_id,

                i.id_image,
                i.name
                		
                FROM portfolio_items p
                LEFT JOIN images i
                ON p.image_highlight_id = i.id_image
                ORDER BY sort_order ASC');

                return $query->getResultArray();
        }

        return $this->asArray()
            ->where(['id_portfolio_item' => $id])
            ->first(); 
    }

    public function getLastItem() {
 
        $query = $this->db->query('SELECT *                 
            FROM portfolio_items
            ORDER BY modified_at DESC
            LIMIT 1');
        return $query->getRowArray();
    }

    public function getItemsIdAndLink() {
 
        $query = $this->db->query('SELECT  
            id_portfolio_item,                 
            item_url                 
            FROM portfolio_items
            ORDER BY sort_order ASC');

        return $query->getResultArray();
    }


    public function getItemsPerso()
    {
        $query = $this->db->query('SELECT 
            p.id_portfolio_item, 
            p.titre,
            p.slug,
            p.description_subtitle,
            p.description_type_projet,
            p.description_contenu,
            p.access_login_admin,
            p.access_mdp_admin,
            p.access_login_user,
            p.access_mdp_user,
            p.site_url,
            p.item_url,
            p.keywords,
            p.sort_order,
            p.date_realisation,
            p.created_at,
            p.modified_at,
            p.users_id,
            p.image_highlight_id,
            p.categories_portfolio_items_id,

            i.id_image,
            i.name
                
        FROM portfolio_items p
        LEFT JOIN images i
        ON p.image_highlight_id = i.id_image
        WHERE p.description_type_projet = "personnel"');

        return $query->getResultArray();        
    }


    public function getItemsPro()
    {
 
        $query = $this->db->query('SELECT 
            p.id_portfolio_item, 
            p.titre,
            p.slug,
            p.description_subtitle,
            p.description_type_projet,
            p.description_contenu,
            p.access_login_admin,
            p.access_mdp_admin,
            p.access_login_user,
            p.access_mdp_user,
            p.site_url,
            p.item_url,
            p.keywords,
            p.sort_order,
            p.date_realisation,
            p.created_at,
            p.modified_at,
            p.users_id,
            p.image_highlight_id,
            p.categories_portfolio_items_id,

            i.id_image,
            i.name
                
        FROM portfolio_items p
        LEFT JOIN images i
        ON p.image_highlight_id = i.id_image
        WHERE p.description_type_projet = "professionnel"');

        return $query->getResultArray();         
    }
 
    public function getItemsFramework($slug)
    {
        $sql = "SELECT 
            p.id_portfolio_item, 
            p.titre,
            p.slug,
            p.description_subtitle,
            p.description_type_projet,
            p.description_contenu,
            p.access_login_admin,
            p.access_mdp_admin,
            p.access_login_user,
            p.access_mdp_user,
            p.site_url,
            p.item_url,
            p.keywords,
            p.sort_order,
            p.date_realisation,
            p.created_at,
            p.modified_at,
            p.users_id,
            p.image_highlight_id,
            p.categories_portfolio_items_id,

            i.id_image,
            i.name
                
        FROM portfolio_items p
        LEFT JOIN images i
        ON p.image_highlight_id = i.id_image
        WHERE p.categories_portfolio_items_id = (SELECT id_categorie_portfolio_item FROM categories_portfolio_items WHERE slug = '$slug')";

        $query = $this->db->query($sql);
        
        

        return $query->getResultArray();
    }


    public function highlightImage($id, $dataHighlight) {
        
        $builder = $this->db->table('portfolio_items');

        $builder->where(['id_portfolio_item' => $id])->update($dataHighlight); 

    }

    public function updatePortfolioItem($id, $data) {

        $builder = $this->db->table('portfolio_items');

        $builder->where(['id_portfolio_item' => $id])->update($data);

    }

    public function insertPortfolioItem($data) {

        $builder = $this->db->table('portfolio_items');

        $builder->insert($data);

    }

    public function deletePortfolioItem($id) {

        $builder = $this->db->table('portfolio_items');

        $builder->where('id_portfolio_item', $id)->delete();
        
    }

    public function lastInsertId() {

        return $this->db->insertID();
    }

    public function count() {

        $builder = $this->db->table('portfolio_items');

        return $builder->countAll();
    }

    public function updatePositionItem($id, $position) {

        $sql = "UPDATE portfolio_items SET sort_order = '$position' WHERE id_portfolio_item = '$id'";
        
        $this->db->query($sql);
    }

}