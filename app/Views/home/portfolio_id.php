<?= $this->extend('templates/template_home') ?>

<?= $this->section('content') ?>

<section class="section section3-portfolio">


    <div class="breadcrumb">
        <div><a class="a-active" href="<?= base_url() . '/portfolio/'; ?>">Portfolio</a> <i class="fas fa-angle-right breadcrumb-separator"></i> <a href="<?= base_url() . '/portfolio/' . $item["id_portfolio_item"] . '-' . $item['slug']; ?>" class="a-active"><?= $item['titre']; ?></a></div>
    </div>

    <div class="page-introduction-titre section-title">
        Portfolio
    </div>
    <div class="separateur-description">
            </div>
    <div class="flex-space-between relative">

        <div class="link-previous-item">
            <?php if($linkPrevious != '') : ?>
                <a href="<?= base_url() . '/portfolio/'.$linkPrevious ?>"><i class="fas fa-angle-left"></i></a>
            <?php endif; ?>
        </div>
        <div class="informations-item">

            <p><span class="informations-item-icon"><i class="fas fa-key"></i></span> Id : <?= $item['id_portfolio_item'] ?></p>
            <p><span class="informations-item-icon"><i class="fas fa-calendar"></i></span> Date réalisation : <?= $item['date_realisation'] ?></p>
            <p><span class="informations-item-icon"><i class="fas fa-clone"></i></span> Ajouter le : <?php $date = date_create($item['created_at']); echo date_format($date, 'Y-m-d') ?></p>

        </div>

        <div class="text-center">
            <p class="page-introduction-sous-titre"><?= $item['titre']; ?></p>
            <p class="page-introduction-sous-titre-subtitle"><?= $item['description_subtitle']; ?></p>
        </div>

        
        <div class="link-next-item">
            <?php if($linkNext != '') : ?>
                <a href="<?= base_url() . '/portfolio/'.$linkNext ?>"><i class="fas fa-angle-right"></i></a>
            <?php endif; ?>
        </div>
        
    </div>
    <div class="separateur-description">
            </div>
    <div class="page-portfolio-item-container">



        <div class="page-portfolio-item-container-sous">

            <div class="col-md-8 caroussel-gauche display-mq">

                <?php
                if ($isSeveralImages) {
                ?>
                    <div class="controls1 previous">
                        <div class="controls1-fleche-gauche">

                            <img class="" src="<?php echo base_url(); ?>/img/fg.png" width="100%">

                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="slide-taille aspect-ratio">
                    <img name="slide" class="caroussel-img-photo-presentation-index img-border aspect-ratio zoomin" />
                </div>


                <?php
                if ($isSeveralImages) {
                ?>
                    <div class="controls2 next">
                        <div class="controls2-fleche-droite">

                            <img class="" src="<?php echo base_url(); ?>/img/fd.png" width="100%">

                        </div>

                    </div>
                <?php
                }
                ?>
            </div>



            <div class="col-md-2 caroussel-droite">
                <div class="col-md-4 caroussel-droite-container">

                    <div class="short-description">

                        <h2 class="portfolio-item-h2">Mots-clés</h2>

                        <?php if(!empty($item['keywords'])) :
                    
                        $keywordsTrimed = trim($item['keywords']);
                        $badging = str_getcsv($keywordsTrimed, ' ');

                        foreach($badging as $valeur) {
                            echo "<div class='badge cursor'>$valeur</div>";
                        }
                        endif;
                        ?>
                       
                    </div>

                </div>

            </div>

        </div>


        <div class="portfolio-item-description">

            <div class="padding-10">

                <h2 class="portfolio-item-h2">Voir le site</h2>

                <p>
                    <?php if($item['site_url']) { ?>       
                        <a class="a-link-website" target="_blank" href="<?= base_url() . '/site/' . $item['site_url']; ?>"><?= base_url() . '/site/' . $item['site_url']; ?></a></p>
                    <?php } else { ?> 
                        <i>Pas de lien disponible</i>
                    <?php } ?>      
                </p>
            </div>


            <div class="separateur-description">
            </div>


            <div class="padding-10">

                <h2 class="portfolio-item-h2">Description</h2>

                Type de projet : <?= $item['description_type_projet']; ?>
                <br>
                <br>

                <p class="text-justified"><?= $item['description_contenu']; ?></p>

            </div>


            <div class="separateur-description">
            </div>


            <div class="description-access">

                <div class="padding-10">
                    <h2 class="portfolio-item-h2">Accès</h2>



                    <div class="flex-space-between margin-b-15">

                        <div class="col-md-6 padding-10 width-100-mq">

                            <p class="acces-label">Login Admin :</p>

                            <div class="acces-contenu">
                                <p><?= $item['access_login_admin'] ? $item['access_login_admin'] : "Pas besoin de login"; ?></p>
                            </div>

                        </div>



                        <div class="col-md-6 padding-10 width-100-mq">

                            <p class="acces-label">Mot de passe Admin :</p>

                            <div class="acces-contenu">
                                <p><?= $item['access_mdp_admin'] ? $item['access_mdp_admin'] : "Pas besoin de mot de passe"; ?></p>
                            </div>

                        </div>




                    </div>

                    <div class="flex-space-between">

                        <div class="col-md-6 padding-10 width-100-mq">

                            <p class="acces-label">Login Utilisateur :</p>

                            <div class="acces-contenu">
                                <p><?= $item['access_login_user'] ? $item['access_login_user'] : "Pas besoin de login"; ?></p>
                            </div>

                        </div>



                        <div class="col-md-6 padding-10 width-100-mq">

                            <p class="acces-label">Mot de passe Utilisateur :</p>

                            <div class="acces-contenu">
                                <p><?= $item['access_mdp_user'] ? $item['access_mdp_user'] : "Pas besoin de mot de passe"; ?></p>
                            </div>

                        </div>



                    </div>
                </div>

            </div>


            <div class="separateur-description">
            </div>

            <div class="padding-10">
                <h2 class="portfolio-item-h2">Commentaires</h2>
            </div>

        </div>





    </div>



</section>





<section class="section section-commentaires">
    

        <?= $this->include('includes/include_commentaires') ?>

   
</section>

<script>
    var imagesCaroussel = [];
    var basePathImage   = '<?= $basePathImage ?>';
    var imagesJson      = '<?= $imagesJson ?>';

    if(imagesJson == '') {
        imagesCaroussel[0] = basePathImage;
    }
    else {
        var imagesJsonObj = JSON.parse(imagesJson);
        for(i = 0; i < imagesJsonObj.length; i++) {
            imagesCaroussel[i] = basePathImage + imagesJsonObj[i].name;
        }
    }

</script>

<?= $this->endSection() ?>