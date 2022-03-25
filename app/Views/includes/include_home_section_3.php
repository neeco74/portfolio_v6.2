<section class="section section3-projets" id="projets">

    <h2 class="section-title section3-title">
        <a class="section-title-a" href="<?= base_url() . '/portfolio/'; ?>">Portfolio</a>
    </h2>


    <div class="section3-container">


        <div class="titre-sous-sous">
            <i class="fas fa-arrow-alt-circle-right chevron"></i> Projet mis en avant
        </div>


        <?php if (!empty($lastPortfolioItem) AND is_array($lastPortfolioItem)) : ?>

            <div class="caroussel">

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

                <a class="a-block a-standard" href="<?= base_url() . '/portfolio/' . $lastPortfolioItem['id_portfolio_item'] .'-'. $lastPortfolioItem['slug']; ?>">
                    <img name="slide" class="caroussel-img-photo-presentation-index img-border aspect-ratio" />
                </a>

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
                <div class="legende-caroussel">
                    <div class="contenu-legende-caroussel flex-space-between">

                        <div class="col-md-6">
                            <p class="caroussel-description-texte"><?php echo $lastPortfolioItem['titre']; ?></p>

                            <p><?php echo $lastPortfolioItem['description_subtitle']; ?></p>
                        </div>
                        <div class="col-md-6-2">
                            <div class="position-right">
                                <a class="btn btn-transition btn-secondary text-center btn-big" href="<?= base_url() . '/portfolio/' . $lastPortfolioItem['id_portfolio_item'] .'-'. $lastPortfolioItem['slug']; ?>">
                                    <i class="fas fa-arrow-alt-circle-right btn-big-icon"></i>
                                    Voir ce projet

                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php endif ?>

    </div>


    <div class="section3-liens margin-t-25 text-center">
        <a class="btn btn-transition btn-primary center btn-big" href="<?php echo base_url(); ?>/portfolio">
            <i class="fas fa-arrow-alt-circle-right btn-big-icon"></i>
            Voir le portfolio

        </a>

    </div>



</section>