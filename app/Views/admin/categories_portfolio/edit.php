<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>

<section class="section">
    <div class="">

    <h1>Edition d'une catégorie</h1>

        <div class="">

            <p class="padding-20-nl">
                <a href="<?php echo base_url(); ?>/admin/cat-portfolio/" class="btn btn-transition btn-success">Revenir à la liste des catégories de portfolio</a>
                <a href="<?php echo base_url(); ?>/admin/" class="btn btn-transition btn-secondary">Revenir à l'administration</a>
            </p>

            <form action="" method="post">

                <div class="col-md-8">
                    <?= csrf_field() ?>

                    <br>
                    <div class="form-group padding-10">
                        <label class="col-md-2 col-form-label" for="titre">Titre : </label>
                        <div class="col-md-8 input-form">
                            <input type="text" class="form-control" name="titre" id="titre" value="<?= isset($catPortfolio['titre']) ? $catPortfolio['titre'] : ''; ?>" required autofocus />
                        </div>
                    </div>

                </div>

                <div>

                    <input type="submit" class="btn btn-transition btn-primary" name="submit" value="Editer la catégorie" />
                </div>

            </form>

        </div>
    </div>
</section>
<?= $this->endSection() ?>