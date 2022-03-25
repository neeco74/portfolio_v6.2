<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>

<section class="section section4-articles">

    <div class="breadcrumb">
        <div><a class="a-active" href="<?= base_url() . '/contact/'; ?>">Contact</a></div>
    </div>

    <div class="page-introduction-titre section-title">
        Me contacter
    </div>
    
    <div class="separateur-description"></div>

    <div class="section-contact-container block-center">

    <?php if (session()->has('success_contact')) : ?>
    <div class="notification-success-home margin-b-40" role="alert">
        <?= session()->get('success_contact') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('danger_contact')) : ?>
    <div class="notification-danger-home margin-b-40" role="alert">
        <?= session()->get('danger_contact') ?>
    </div>
<?php endif; ?>
        

        <form class="form-horizontal" action="" method="POST">


            <fieldset>

                <div class="flex-center">
                    <?php if (!empty($_SESSION['authPortfolio'])) : ?>



                        <?php if (empty($_SESSION['authPortfolio']->id_user)) : ?>

                            <div class="padding-10 col-md-6">
                                <label for="contact_champ_login" class="col-md-2 offset-md-2 col-form-label">Votre nom : </label>

                                <div class="margin-t-10">
                                    <input tabindex="1" type="text" class="form-control" name="contact_champ_login" id="contact_champ_login" value=<?= $_SESSION['authPortfolio']->login; ?> required />
                                    

                                </div>

                            </div>


                        <?php else : ?> 

                            <div class="col-md-6 padding-10">
                                <label for="contact_champ_login" class="col-md-2 offset-md-2 col-form-label">Votre nom : </label>

                                <div class="margin-t-10">
                                    <input tabindex="1" type="text" class="form-control" name="contact_champ_login" id="contact_champ_login" value="<?= $_SESSION['authPortfolio']->prenom . ' ' . $_SESSION['authPortfolio']->nom ; ?>" disabled="disabled" />

                                    <input tabindex="1" type="hidden" class="form-control" name="contact_champ_login" id="contact_champ_login" value=<?= $_SESSION['authPortfolio']->login; ?> />

                                </div>

                            </div>
                        
                        <?php endif; ?>




                        <?php if (empty($_SESSION['authPortfolio']->id_user)) : ?> 

                            <div class="padding-10 col-md-6">
                                <label for="contact_champ_email" class="col-md-2 offset-md-2 col-form-label">Votre email : </label>

                                <div class="margin-t-10">
                                    <input type="text" name="contact_champ_email" id="contact_champ_email" value="<?php echo $_SESSION['authPortfolio']->email; ?>" class="form-control" required />
                                

                                </div>

                            </div>

                        <?php else : ?>
                        
                            <div class="padding-10 col-md-6">
                                <label for="contact_champ_email" class="col-md-2 offset-md-2 col-form-label">Votre email : </label>

                                <div class="margin-t-10">
                                    <input type="text" name="contact_contact_champ_email" id="contact_champ_email" value="<?= $_SESSION['authPortfolio']->email; ?>" class="form-control" disabled="disabled" />

                                    <input tabindex="1" type="hidden" class="form-control" name="contact_champ_email" id="contact_champ_email" value=<?php echo $_SESSION['authPortfolio']->email; ?> />

                                </div>

                            </div>
                        
                        <?php endif; ?>

                    <?php endif; ?>
                    
                </div>

                <div class="padding-10 ">
                    <label for="contact_champ_sujet" class="col-md-2 offset-md-2 col-form-label">Sujet : </label>

                    <div class="margin-t-10">
                        <input type="text" name="contact_champ_sujet" id="contact_champ_sujet" placeholder="Sujet" class="form-control" />
                    </div>
                </div>


                <div class='padding-10'>
                    <label for="contact_champ_message" class="col-md-2 offset-md-2 col-form-label">Message : </label>

                    <div class="margin-t-10">
                        <textarea class="form-control" name="contact_champ_message" id="contact_champ_message" rows="10" cols="500" maxlength="5000" placeholder="Votre message (taille max : 5000 caracteres)" required ></textarea>
                    </div>
                </div>

                <div class="padding-10">
                    
                    <button type="submit" name="submit" class="btn btn-transition btn-primary">Envoyer le message</button>
                </div>
            </fieldset>
        </form>

    
    </div>                    
</section>
<?= $this->endSection() ?>