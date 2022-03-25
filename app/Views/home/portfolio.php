<?= $this->extend('templates/template_home') ?>

<?= $this->section('content') ?>


<section class="section section3-portfolio">

    <div class="breadcrumb">
        <div><a class="a-active" href="<?= base_url() . '/portfolio/'; ?>">Portfolio</a> <i class="fas fa-angle-right breadcrumb-separator"></i> <a href="" class="a-active">Index</a></div>
    </div>

    <div class="page-introduction-titre section-title">
        Portfolio
    </div>
    <div class="separateur-description">
            </div>
    <div class="page-introduction">
        <p>Bienvenue sur mon portfolio. Vous y trouverez des projets personnels ainsi que professionnels pour lesquels j'ai travaillé via les différentes sociétés par lesquelles je suis passé.</p>
    </div>
    <div class="separateur-description">
            </div>


    <div id="tab-menu">

        <ul id="nav-tab">
            <li><a href="#" class="nav-tab-active"><span class="icone-navbar"><i class="fas fa-laptop-code"></i></span>  Tous les projets</a></li>
            <li><a href="#"><span class="icone-navbar"><i class="fas fa-file-code"></i></span>  Personnels</a></li>
            <li><a href="#"><span class="icone-navbar"><i class="fas fa-file-code"></i></span>  Professionnels</a></li>
            <li><a href="#"><span class="icone-navbar"><i class="fab fa-free-code-camp"></i></span>  CodeIgniter</a></li>
            <li><a href="#"><span class="icone-navbar"><i class="fab fa-symfony"></i></span>  Symfony</a></li>
        </ul>
    </div>
    <div id="tab-content">

        <div id="all">
            <div class="page-portfolio-container">

                <?php if (!empty($portfolioItems) && is_array($portfolioItems)) :

                    foreach ($portfolioItems as $item) :
                        if ($item['name'] == null) {
                            $cheminImage = base_url() . '/img/330x_none.jpg';
                        } else {
                            // va chercher l'unique image, en 330 car telle qu'enregistrée
                            $cheminImage = base_url() . '/uploads/' . $item['name'];
                            // echo $chemin_image;
                        }
                ?>
                        <?= $this->setData(compact('item', 'cheminImage'))->include('includes/include_card_item') ?>

                    <?php endforeach; ?>

                <?php endif ?>

            </div>
        </div>

        
        <div id="perso">
            <div class="page-portfolio-container">

                <?php if (!empty($portfolioItemsPerso) && is_array($portfolioItemsPerso)) :

                    foreach ($portfolioItemsPerso as $item) :

                        if ($item['name'] == null) {
                            $cheminImage = base_url() . '/img/330x_none.jpg';
                        } else {
                            // va chercher l'unique image, en 330 car telle qu'enregistrée
                            $cheminImage = base_url() . '/uploads/' . $item['name'];
                            // echo $chemin_image;
                        }

                ?>


<?= $this->setData(compact('item', 'cheminImage'))->include('includes/include_card_item') ?>


                    <?php endforeach; ?>



                <?php endif ?>

            </div>
        </div>

        <div id="pro">
            <div class="page-portfolio-container">

                <?php if (!empty($portfolioItemsPro) && is_array($portfolioItemsPro)) :

                    foreach ($portfolioItemsPro as $item) :

                        if ($item['name'] == null) {
                            $cheminImage = base_url() . '/img/330x_none.jpg';
                        } else {
                            // va chercher l'unique image, en 330 car telle qu'enregistrée
                            $cheminImage = base_url() . '/uploads/' . $item['name'];
                            // echo $chemin_image;
                        }

                ?>


<?= $this->setData(compact('item', 'cheminImage'))->include('includes/include_card_item') ?>



                    <?php endforeach; ?>

                <?php endif ?>

            </div>

        </div>

        <div id="ci">
            <div class="page-portfolio-container">

                <?php if (!empty($portfolioItemsCi) && is_array($portfolioItemsCi)) :

                    foreach ($portfolioItemsCi as $item) :

                        if ($item['name'] == null) {
                            $cheminImage = base_url() . '/img/330x_none.jpg';
                        } else {
                            // va chercher l'unique image, en 330 car telle qu'enregistrée
                            $cheminImage = base_url() . '/uploads/' . $item['name'];
                            // echo $chemin_image;
                        }

                ?>


<?= $this->setData(compact('item', 'cheminImage'))->include('includes/include_card_item') ?>



                    <?php endforeach; ?>

                <?php endif ?>

            </div>

        </div>
        <div id="sf">
            <div class="page-portfolio-container">

                <?php if (!empty($portfolioItemsSf) && is_array($portfolioItemsSf)) :

                    foreach ($portfolioItemsSf as $item) :

                        if ($item['name'] == null) {
                            $cheminImage = base_url() . '/img/330x_none.jpg';
                        } else {
                            // va chercher l'unique image, en 330 car telle qu'enregistrée
                            $cheminImage = base_url() . '/uploads/' . $item['name'];
                            // echo $chemin_image;
                        }

                ?>


<?= $this->setData(compact('item', 'cheminImage'))->include('includes/include_card_item') ?>



                    <?php endforeach; ?>


                <?php endif ?>

            </div>

        </div>



    </div>


</section>

<?= $this->endSection() ?>