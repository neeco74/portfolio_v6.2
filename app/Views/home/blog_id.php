<?= $this->extend('templates/template_home') ?>

<?= $this->section('content') ?>

<section class="section section4-articles">

    <div class="breadcrumb">
        <div><a class="a-active" href="<?= base_url() . '/blog/'; ?>">Blog</a> <i class="fas fa-angle-right breadcrumb-separator"></i> <a href="" class="a-active"><?= $article['titre']; ?></a></div>
    </div>

    <div class="page-introduction-titre section-title">
        Blog
    </div>
    
    <div class="separateur-description"></div>

    <div class="text-center">
        <p class="page-introduction-sous-titre"><?= $article['titre']; ?></p>
    </div>

    <div class="separateur-description"></div>

    <?php if (!empty($article) && is_array($article)) : ?>

    
        <div class="article-container-id">

            <div class="article">
                
                <?php if($images != null) :
                        $cheminImage = base_url() . '/uploads/' . $images[0]['name'];
                ?>
                    <div class="article-image">
                        <img class="img-border" src="<?= $cheminImage ?> " width="800" height="500">
                    </div>

                <?php endif; ?>

                <div class="text-justified margin-t-25">
                    <?= nl2br($article['contenu']); ?>
                </div>

            </div>
        </div>
    <?php endif ?>
    
    <div class="separateur-description">
    </div>

    <div class="padding-10">
        <h2 class="portfolio-item-h2">Commentaires</h2>
    </div>
            
</section>

<section class="section section-commentaires">
    

        <?= $this->include('includes/include_commentaires') ?>

   
</section>

<?= $this->endSection() ?>