<?= $this->extend('templates/template_root') ?>

<?= $this->section('content') ?>


<div id="cr-rain" class="cr-rain">
    <canvas></canvas>
    <canvas></canvas>

    <div class="text-web-project pointer">
        <p class="animate-text">Nicolas Olagnon Portfolio</p>
    </div>

</div>


<div id="div-login">


    <div class="container-login">


        <div class="espace-pour-notification text-center">

            <?php if (session()->has('success_login')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success_login') ?>
                </div>

            <?php elseif (session()->has('danger_login')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    if(is_array(session()->get('danger_login'))) {
                        
                        foreach(session()->get('danger_login') as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; 
                    }
                    else {
                        echo session()->get('danger_login');
                    }
                    ?>
                </div>
            <?php 
                else :
                    echo "<p class='padding-15'>Veuillez vous connecter</p>";
                endif; ?>
        </div>

        <form action="<?php echo base_url(); ?>/login" method="POST">

            <div class="form-group">
                <div class="div-form-control">
                    <input type="text" class="form-control" id="login_email" name="login_email" placeholder='Email ou "invité"' required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="div-form-control">
                    <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-check-label control control-checkbox"> Rester connecté
                    <input type="checkbox" class="form-check-input" value="on" checked name="remember">
                    <div class="control_indicator"></div>
                </label>
            </div>


            <div class="form-group flex-space-between">
                <button type="submit" name="submit" value="login" class="btn-form pointer">Se connecter</button>
                <button type="button" class="btn-form pointer js-btn-register">S'inscrire</button>
            </div>
        </form>

        <p class="password-forget js-btn-forget pointer">Mot de passe oublié ?
        <p>

    </div>
</div>



<div id="div-register">
    <h2>S'inscrire</h2>

    <div class="container-register">

        <form action="<?php echo base_url(); ?>/register" method="POST">


            <div class="form-group">
                <div class="div-form-control">
                    <input type="text" class="form-control" name="register_prenom" id="register_prenom" placeholder="Prenom" value="<?= old('register_prenom') ?>" required autofocus />
                </div>
            </div>

            <div class="form-group">
                <div class="div-form-control">
                    <input type="text" class="form-control" name="register_nom" id="register_nom" value="<?= old('register_nom') ?>" placeholder="Nom" required />
                </div>
            </div>

            <div class="form-group">
                <div class="div-form-control">
                    <input type="email" class="form-control" name="register_email" id="register_email" value="<?= old('register_email') ?>" placeholder="Email" required />
                </div>
            </div>

            <div class="form-group">
                <div class="div-form-control">
                    <input type="password" class="form-control" name="register_password" id="register_password" placeholder="Mot de passe" required />
                </div>
            </div>

            <div class="form-group">
                <div class="div-form-control">
                    <input type="password" class="form-control" name="register_cpassword" id="register_cpassword" placeholder="Mot de passe de confirmation" required />
                </div>
            </div>

            <div class="form-group flex-space-between">
                <button type="submit" name="submit" value="register" class="btn-form pointer">S'inscrire</button>
                <button type="button" class="btn-form pointer js-btn-retour">Retour</button>
            </div>

        </form>

    </div>
</div>


<div id="div-forget">
    <h2>Mot de passe oublié</h2>

    <div class="container-forget">

        <form action="<?php echo base_url(); ?>/forget" method="POST">

        <div class="form-group">
                <div class="div-form-control">
                    <input type="text" class="form-control" id="forget_email" name="forget_email" placeholder='Email' required autofocus>
                </div>
            </div>


            <div class="form-group flex-space-between">
                <button type="submit" name="submit" value="forget" class="btn-form pointer">Envoyer</button>
                <button type="button" class="btn-form pointer js-btn-retour-forget">Retour</button>
            </div>

        </form>


    </div>
</div>













<?= $this->endSection() ?>