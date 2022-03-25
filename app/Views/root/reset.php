<?= $this->extend('templates/template_root') ?>

<?= $this->section('content') ?>


<div id="cr-rain" class="cr-rain">
    <canvas></canvas>
    <canvas></canvas>

</div>

<div id="div-reset">

    <div class="container-reset">

        <h2>Reinitialiser le mot de passe</h2>

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <p>Vous n'avez pas rempli le formulaire correctement</p>
                <ul>

                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif ?>


        <form action="" method="POST">

        <div class="form-group">
                <div class="div-form-control">
                    <input type="password" class="form-control" name="reset_password" id="reset_cpassword" placeholder="Nouveau mot de passe" required />
                </div>
            </div>

            <div class="form-group">
                <div class="div-form-control">
                    <input type="password" class="form-control" name="reset_cpassword" id="reset_cpassword" placeholder="Mot de passe de confirmation" required />
                </div>
            </div>

            <div class="form-group flex-space-between">
                <button type="submit" name="submit" value="reset" class="btn-form pointer">Envoyer</button>
                <button type="button" class="btn-form pointer js-link" href="<?= base_url() ?>">Retour</button>
            </div> 
        </form>


    </div>
</div>

<?= $this->endSection() ?>