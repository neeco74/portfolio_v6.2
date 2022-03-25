<div class="div-container-card col-md-4 animate-in-down display-mq margin-b-20-mq">

    <div class="card card-box-shadow card-hover">
        <div class="card-div-img-top js-link" href="<?= base_url() . '/portfolio/' . $item['id_portfolio_item'] . '-' . $item['slug']; ?>">
            <p class="text-center">
                <img class="card-img-top" src="<?= $cheminImage ?> ">
            </p>
        </div>
        <div class="card-body">
            <div class="card-body-description">

                <p class="card-titre"><a class="a-standard a-active" href="<?= base_url() . '/portfolio/' . $item['id_portfolio_item'] . '-' . $item['slug']; ?>"><?= $item['titre']; ?></a></p>

                <p class="card-text"><?= $item['description_subtitle']; ?></p>
        
            </div>

            <div class="btn-group">

                    <a href="<?= base_url() . '/portfolio/' . $item['id_portfolio_item'] . '-' . $item['slug']; ?>" class="btn btn-transition btn-secondary btn-card-large">Détails</a>
                    <a href="<?= base_url() . '/site/' . $item['site_url']; ?>" target="_blank" class="btn btn-transition btn-secondary btn-card-large">Voir le site</a>
                    <?php if ($_SESSION["authPortfolio"]->role == "admin") : ?>
                        <a href="<?= base_url() . '/admin/portfolio/edit/' . $item['id_portfolio_item']; ?>" class="btn btn-transition btn-outline-secondary btn-card-admin">Admin</a>
                    <?php endif; ?>
                

            </div>
            <div class="card-publication">Date de réalisation : <?= $item['date_realisation']; ?></div>
        </div>
    </div>

</div>