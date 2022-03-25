<?= $this->extend('templates/template_home') ?>

<?= $this->section('content') ?>


<section class="section section4-articles">

    <div class="breadcrumb">
        <div><a class="a-active" href="<?= base_url() . '/blog/'; ?>">Blog</a> <i class="fas fa-angle-right breadcrumb-separator"></i> <a href="" class="a-active">Index</a></div>
    </div>

    <div class="page-introduction-titre section-title">
        Blog
    </div>
    <div class="separateur-description">
            </div>
    <div class="page-introduction">
        <p>Bienvenue sur mon blog. Vous y trouverez mes articles à propos de Symfony mais aussi du developpement en général.</p>
    </div>
    <div class="separateur-description">
            </div>
    

    <div class="article-container">

        <?php if(!empty($articles) && is_array($articles)) :

            foreach($articles as $article) :

                if ($article['name'] == null) {
                    $cheminImage = base_url() . '/img/330x_none.jpg';
                } else {
                    // va chercher l'unique image, en 600 car telle qu'enregistrée
                    $cheminImage = base_url() . '/uploads/' . $article['name'];
                    // echo $chemin_image;
                }

        ?>

            <?= $this->setData(compact('article', 'cheminImage'))->include('includes/include_card_article') ?>



            <?php endforeach; ?>

        <?php endif ?>

    </div>

</section>

<?= $this->endSection() ?>