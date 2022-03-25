<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>

<section class="section">
    <div class="">

        <h1>Edition d'un article</h1>

        <div class="">

            <p class="padding-20-nl">
                <a href="<?= base_url(); ?>/admin/blog/" class="btn btn-transition btn-success">Retour à la liste des articles</a>
                <a href="<?= base_url(); ?>/admin/" class="btn btn-transition btn-secondary">Retour à l'administration</a>
                <?php if(isset($article)) : ?>
                    <a href="<?= base_url() . '/blog/' . $article["id_article"] . '-' . $article["slug"]; ?>" class="btn btn-transition btn-secondary">Voir l'article</a>
                <?php endif; ?>
            </p>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="flex-center">

                    <div class="col-md-8">

                        <br>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="titre">Titre : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="titre" id="titre" value="<?php echo isset($article['titre']) ? $article['titre'] : ''; ?>" required autofocus />
                            </div>
                        </div>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="contenu">Contenu : </label>
                            <div class="col-md-8 input-form">
                                <textarea class="form-control" id="contenu" name="contenu" rows="15" required><?php echo isset($article['contenu']) ? $article['contenu'] : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group padding-10">
                            <label class="col-md-2" for="keywords">Keywords : </label>
                            <div class="col-md-8 input-form">
                                <input type="text" class="form-control" name="keywords" id="keywords" value="<?php echo isset($article['keywords']) ? $article['keywords'] : ''; ?>" required />
                            </div>
                        </div>


                        <div class="form-group padding-10">
                            <label for="categories_articles_id" class="col-md-2">Catégorie de blog :</label>

                            <div class="col-md-8 input-form">

                                <?php 
                                    
                                    $return = "<select class='form-control' name='categories_articles_id'>";
                                    $return .= "<option value=''>Choisir une catégorie</option>";
                                    foreach($listeTitreCategorieArticle as $key => $value){
                                        $selected = '';
                                        if(isset($item["categories_articles_id"]) AND $key == $item["categories_articles_id"]) {
                                            $selected = ' selected="selected"';
                                        }
                                        
                                        $return .= "<option value='$key' $selected>$value</option>";
                                    }
                                    $return .= '</select>';
                                    
                                    echo $return;

                                    ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 margin-b-40">
                        <?php foreach ($images as $k => $image) :
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


                <div>

                    <input type="submit" class="btn btn-transition btn-primary" name="submit" value="Editer l'article" />
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>