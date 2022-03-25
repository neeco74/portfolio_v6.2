<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>

<section class="section section-cv">
    
        <iframe src="<?php echo base_url(); ?>/files/CV.pdf" width="100%" height="100%"></iframe>   
   
</section>


<?= $this->endSection() ?>