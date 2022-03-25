<div class="article-card col-md-4-mq animate-in-down card-hover">

    <div class="article-photo js-link" href="<?= base_url() . '/blog/' . $article['id_article'] . '-' . $article['slug']; ?>">

        <p class="text-center height-100">
            <img class="card-img-top" src="<?= $cheminImage ?>">
        </p>

    </div>
    <div class="article-card-body">
        <div class="article-titre">
            <h3><a class="a-standard a-active" href="<?= base_url() . '/blog/' . $article['id_article'] . '-' . $article['slug']; ?>"><?= $article['titre']; ?></a></h3>
        </div>

        <div class="article-description">
            <?= substr($article['contenu'], 0, 370); ?>

            
            <div class="article-suite">
                <a class="a-standard" href="<?= base_url() . '/blog/' . $article['id_article'] . '-' . $article['slug']; ?>">Lire la suite...</a>

            </div>
        </div>



        <div class="article-date-publication">
            <p>Publié il y a 1 mois</p>
        </div>
    </div>

</div>