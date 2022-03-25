<?php if (session()->has('success_commentaires')) : ?>
    <div class="notification-success-home margin-b-40" role="alert">
        <?= session()->get('success_commentaires') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('danger_commentaires')) : ?>
    <div class="notification-danger-home margin-b-40" role="alert">
        <?= session()->get('danger_commentaires') ?>
    </div>
<?php endif; ?>

<?php foreach($listeCommentaires as $key => $unCommentaire) :
?>
    <div class="main-container-comments">

        <div class="container-avatar">
            <img class="img-responsive rounded" src="<?php echo base_url(); ?>/img/avatar.png" width="70%;">
        </div>

        <div class="container-message">

            <div class="message-data">

                <div class="message-data-auteur">
                    <?= $unCommentaire['auteur_login'] ?>
                </div>

                <div class="message-data-date">
                    <?= $unCommentaire['created_at'] ?>
                </div>

            </div>


            <div class="message">
                    <?= $unCommentaire['contenu'] ?>
            </div>

        </div>

    </div>
<?php endforeach;

if (isset($_SESSION['authPortfolio']->id_user)) {
?>


    <div class="main-container-comments-add">
        <div class="container-avatar">
            <img class="img-responsive user-photo rounded" src="<?= base_url(); ?>/img/avatar.png" width="70%;">
        </div>

        <div class="container-message">

            <div class="message-data">

                <div class="message-data-auteur">

                    <?= $_SESSION['authPortfolio']->login; ?>

                </div>
                <div class="message-data-date">



                </div>


            </div>
            <div class="message">

                <form class="message-form" method="post" action="">
                    <input type="hidden" name="auteur_login" value="" />

                    <textarea class="message-text-area" name="contenu_post" rows="5" cols="50"></textarea>

                    <button class="btn btn-transition btn-success" type="submit" class="">Envoyer le commentaire</button>
                </form>


            </div>


        </div>



    </div>

<?php
}
else {      // On invite l'invité à se connecter ou a s'sinscrire
?>
    <div class="main-container-comments-add">
        <div class="container-avatar">
            <img class="img-responsive user-photo rounded" src="<?= base_url(); ?>/img/avatar.png" width="70%;">
        </div>

        <div class="container-message">

            <div class="message-data">

                <div class="message-data-auteur">

                    <?= $_SESSION['authPortfolio']->login ?>

                </div>
                <div class="message-data-date">



                </div>


            </div>
            <div class="message">

                
                    <input type="hidden" name="auteur_login" value="" />

                    <textarea class="message-text-area" name="contenu_post" rows="5" cols="50" disabled>Vous devez être identifié pour ajouter un commentaire. Pour cela, merci de vous inscrire.</textarea>

                 
                    <a href="<?= base_url('logout') . '/?register=1' ?>" class="btn btn-transition btn-outline-secondary">S'inscrire</a>
                


            </div>


        </div>



    </div>

<?php
}
?>