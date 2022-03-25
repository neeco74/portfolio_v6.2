<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>

<section class="section">
    <div class="section-sub-padding">
        
        <h1>Administration</h1>    
    </div>
</section>


<section class="section-admin">
    <div class="section-sub-padding">
        
        <a class="btn btn-transition btn-large btn-primary" href="<?= base_url(); ?>/admin/portfolio/" role="button">Gerer le portfolio</a>
    </div>
</section>

<section class="section-admin">
    <div class="section-sub-padding">
        
        <a class="btn btn-transition btn-large btn-primary" href="<?= base_url(); ?>/admin/blog/" role="button">Gerer les articles</a>
    </div>
</section>

<section class="section-admin">
    <div class="section-sub-padding">
        
        <a class="btn btn-transition btn-large btn-primary" href="<?= base_url(); ?>/admin/cat-portfolio/" role="button">Gerer les categories de portfolio</a>
    </div>
</section>
<section class="section-admin">
    <div class="section-sub-padding">
        
        <a class="btn btn-transition btn-large btn-primary" href="<?= base_url(); ?>/admin/cat-blog/" role="button">Gerer les categories de blog</a>
    </div>
</section>

<?= $this->endSection() ?>