<section class="section section4-articles" id="articles">

    <h2 class="section-title section4-title">
        <a class="section-title-a" href="<?= base_url() . '/blog/'; ?>">Blog</a>
    </h2>
    <div class="titre-sous-sous margin-t-20">
            <i class="fas fa-arrow-alt-circle-right chevron"></i> Derniers articles
        </div>
    <div class="article-container">



        <?php if(!empty($articles) && is_array($articles)) :

            foreach($articles as $article) :

                if($article['name'] == null) {
                    $cheminImage = base_url() . '/img/330x_none.jpg';
                } 
                else {
                    // va chercher l'unique image, en 300 car telle qu'enregistrée
                    $cheminImage = base_url() . '/uploads/' . $article['name'];
                    // echo $cheminImage;
                }

        ?>


<?= $this->setData(compact('article', 'cheminImage'))->include('includes/include_card_article') ?>




            <?php endforeach; ?>

        <?php endif ?>

    </div>

</section>