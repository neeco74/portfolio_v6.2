<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>


    <?= $this->include('includes/include_home_section_1') ?>

<div class="separateur-section"></div>

    <?= $this->include('includes/include_home_section_2') ?>    

<div class="separateur-section"></div>

    <?= $this->include('includes/include_home_section_3') ?>

<div class="separateur-section"></div>

    <?= $this->include('includes/include_home_section_4') ?>


<?= $this->endSection() ?>