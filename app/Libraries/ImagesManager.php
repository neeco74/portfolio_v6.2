<?php

namespace App\Libraries;
use App\Models\ImagesModel;
use App\Models\PortfolioItemsModel;
use App\Models\ArticlesModel;
use DateTime;

class ImagesManager {

    public static function highlightImage(int $id, int $idHighlight, $type): void {

        if($type == "portfolio_item") {
            $modelPortfolioItems = new PortfolioItemsModel();

            /* On réduit de 1 l'id Highlight car l'id passé est celle de la miniature, or on veut l'image initial 
            /* MaJ : EN FAIT NON */
            //$idHighlight--;

            $dataHighlight = ['image_highlight_id' => $idHighlight];

            $modelPortfolioItems->highlightImage($id, $dataHighlight);
        }
        else if($type == "article") {
            $modelArticles = new ArticlesModel();

            $dataHighlight = ['image_highlight_id' => $idHighlight];

            $modelArticles->highlightImage($id, $dataHighlight);
        }
    }



    public static function deleteImage($id): bool {

        /* Suppression, d'abord de la petite image car tel que passé en parametre $id en cliquant sur la miniature */
        $modelImages = new ImagesModel();

        $arrayImage = $modelImages->getImageFromId($id);
        
        if(empty($arrayImage)) {
            $error = "L'image n'existe pas";
            return $error;
        }

        $pathUnlinkSmall = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$arrayImage["name"];
        
        /* Suppression physique de la grande image (image initial) */
        $nameImageInitial = substr($arrayImage["name"], 5); // on retire 330x_ ou 600x_ du nom
        $pathUnlinkInitial = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$nameImageInitial;
        
        /* Suppression */
        if(is_file($pathUnlinkSmall) AND is_file($pathUnlinkInitial)) {
            unlink($pathUnlinkSmall);
            unlink($pathUnlinkInitial);
        }
        else {
            $error = 'Les images n\'ont pas été supprimé car absence physique';
            return $error;
        }

        // Suppression en base de données
        $modelImages->deleteImage($id, $nameImageInitial);

        return true;
    }
    
    
    
    public static function manageFiles($files, $id, $champOfTableImages, int $newTaille, $resize = false)
    {
        $modelImages = new ImagesModel();
        
        $dateNow = (new DateTime('now'))->format('Ymd-His');
        $lastInsertImageId = null;

        foreach($files['theFile'] as $key => $file) {

            if($file->isValid() && !$file->hasMoved()) {

                $newName = $dateNow.'-'.substr($file->getRandomName(), 20);
                $file->move('./uploads/', $newName);

                $dataImageInitial = [
                    'name'                  => $newName,
                    $champOfTableImages     => $id,
                ];
                $modelImages->insertImage($dataImageInitial);


                if($resize) {

                    $imagePath = ROOTPATH . '/public/uploads/' . $newName;

                    $newName = 'x_' . $newName;

                    $imageDest = ROOTPATH . '\public\uploads\\'. $newTaille . $newName;

                    $return = ImagesResizer::resize($imagePath, $imageDest, $newTaille, 80, 'auto', false);
                    
                    /*
                    echo '<pre style="background-color: orange; margin-left:300px; z-index:999">' . print_r($return, true) . '</pre>';                    
                    echo '<pre style="background-color: red; margin-left:300px; z-index:999">' . print_r(ROOTPATH, true) . '</pre>';
                    echo '<pre style="background-color: violet; margin-left:300px; z-index:999">' . print_r($imagePath, true) . '</pre>';
                    echo '<pre style="background-color: green; margin-left:300px; z-index:999">' . print_r($imageDest, true) . '</pre>';
                    echo '<pre style="background-color: blue; margin-left:300px; z-index:999">' . print_r($_SERVER['DOCUMENT_ROOT'], true) . '</pre>';
                    */

                    $dataImagesResized = [
                        'name'                  => $newTaille . $newName,
                        $champOfTableImages     => $id,
                    ];
                    $modelImages->insertImage($dataImagesResized);
    
                }

                if($key === array_key_first($files['theFile'])) {
                    $lastInsertImageId = $modelImages->lastInsertId();
                }
            }
        }

        return isset($lastInsertImageId) ? $lastInsertImageId : null;
    }
}