<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>

<section class="section">
    <div class="">

        <h1>Edition d'un item</h1>

        <div class="">



            <p class="padding-20-nl">
                <a href="<?= base_url(); ?>/admin/portfolio/" class="btn btn-transition btn-success">Retour à la liste des items</a>
                <a href="<?= base_url(); ?>/admin/" class="btn btn-transition btn-secondary">Retour à l'administration</a>
                <?php if(isset($item)) : ?>
                    <a href="<?= base_url() . '/portfolio/' . $item["id_portfolio_item"] . '-' . $item["slug"]; ?>" class="btn btn-transition btn-secondary">Voir l'item</a>
                <?php endif; ?>
            </p>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="flex-center">

                    <div class="col-md-8">

                        <br>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="titre">Titre : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="titre" id="titre" value="<?php echo (isset($item['titre'])) ? $item['titre'] : ''; ?>" required autofocus />
                            </div>
                        </div>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="date_realisation">Date de réalisation (varchar aproximative) : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="date_realisation" id="date_realisation" value="<?php echo (isset($item['date_realisation'])) ? $item['date_realisation'] : ''; ?>" required autofocus />
                            </div>
                        </div>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="description_sous">Description subtitle : </label>
                            <div class="col-md-8 input-form ">
                                <textarea class="form-control" id="description_sous" name="description_sous" rows="10"><?php echo (isset($item['description_subtitle'])) ? $item['description_subtitle'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="description_type_projet">Description type projet : </label>
                            <div class="col-md-8 input-form">
                                <select class='form-control' name="description_type_projet">
                                    <option value="personnel" selected="selected">Personnel</option>
                                    <option value="professionnel">Professionnel</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="description_contenu">Description contenu : </label>
                            <div class="col-md-8 input-form ">
                                <textarea class="form-control" id="description_contenu" name="description_contenu" rows="10"><?php echo (isset($item['description_contenu'])) ? $item['description_contenu'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="titre">Acces Login Admin : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="access_login_admin" id="access_login_admin" value="<?php echo (isset($item['access_login_admin'])) ? $item['access_login_admin'] : ''; ?>" />
                            </div>
                        </div>
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="titre">Acces Password Admin : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="access_mdp_admin" id="access_mdp_admin" value="<?php echo (isset($item['access_mdp_admin'])) ? $item['access_mdp_admin'] : ''; ?>" />
                            </div>
                        </div>
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="titre">Acces Login User : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="access_login_user" id="access_login_user" value="<?php echo (isset($item['access_login_user'])) ? $item['access_login_user'] : ''; ?>" />
                            </div>
                        </div>
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="titre">Acces Password User : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="access_mdp_user" id="access_mdp_user" value="<?php echo (isset($item['access_mdp_user'])) ? $item['access_mdp_user'] : ''; ?>" />
                            </div>
                        </div>
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="keywords">Keywords : </label>
                            <div class="col-md-8 input-form ">
                                <input type="text" class="form-control" name="keywords" id="keywords" value="<?php if(isset($item['keywords'])) {
                                    echo htmlentities($item['keywords']);
                                } 
                                else {
                                    echo "";
                                } ?>" />
                                
                            </div>
                        </div>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="item_url">URL de l'item : </label>
                            <div class="col-md-8 input-form ">
                                <input type="text" disabled class="form-control" name="item_url" id="item_url" value="<?php echo (isset($item['item_url'])) ? $item['item_url'] : ''; ?>" />
                            </div>
                        </div>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="site_url">Site URL : (nom du dossier, sans aucun / ni espace)</label>
                            <div class="col-md-8 input-form ">
                                <input type="text" class="form-control" name="site_url" id="site_url" value="<?php echo (isset($item['site_url'])) ? $item['site_url'] : ''; ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group padding-10">
                            <label class="col-md-2" for="categorie_portfolio_item">Categorie de Portfolio Item : </label>
                            <div class="col-md-8 input-form">
                                    <?php 
                                    
                                    $return = "<select class='form-control' name='categories_portfolio_items_id'>";
                                    $return .= "<option value=''>Choisir une catégorie</option>";
                                    foreach($listeTitreCategoriePortfolio as $key => $value){
                                        $selected = '';
                                        if(isset($item["categories_portfolio_items_id"]) AND $key == $item["categories_portfolio_items_id"]) {
                                            $selected = ' selected="selected"';
                                        }
                                        
                                        $return .= "<option value='$key' $selected>$value</option>";
                                    }
                                    $return .= '</select>';
                                    
                                    echo $return;

                                    ?>
                            </div>
                        </div>

                        <div class="form-group padding-10">

                            <input type="checkbox" name="item_highlight" id="item_highlight" value="on" /><label for="item_highlight"> Mettre l'item en une</label>

                        </div>

                    </div>

                    <div class="col-md-4 margin-b-40">
                        <?php foreach ($images as $key => $image) :
                            $cheminImage = base_url() . '/uploads/' . $image['name'];     ?>
                            <div class="liste-small-images flex-center">
                                
                                <div class="col-md-6">
                                    <img src="<?php echo $cheminImage ?>" width="100%">
                                </div>
                                <div class="col-md-6">
                                    <a class="a-block btn btn-secondary margin-10" href="?deleteimg=<?= $image['id_image']; ?>" onclick="return confirm('Sur ?');">Supprimer</a>
                                    <a class="a-block btn btn-secondary margin-10" href="?highlight=<?= $image['id_image']; ?>">Mettre à la une</a>
                                </div>
                            </div>
                        <?php endforeach ?>

                        <div class="form-group padding-10">
                            <input type="file" name="theFile[]">
                            <input type="file" name="theFile[]" class="hidden" id="duplicate">
                        </div>
                        <p>
                            <a href="#" class="btn btn-transition btn-success" id="duplicate-btn">Ajouter une image</a>
                        </p>
                    </div>


                </div>
                <div class="padding-10">

                    <input type="submit" class="btn btn-transition btn-primary" name="submit" value="Editer l'item" />
                    <input type="reset" class="btn btn-transition btn-primary" name="submit" value="Reset" />
                </div>
            </form>

        </div>
    </div>
</section>
<?= $this->endSection() ?>