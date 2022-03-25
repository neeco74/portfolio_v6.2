<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>

<section class="section">
    <div class="section-sub-padding">

        <h1>Administrer les articles</h1>

        <div class="container-portfolio-item-admin">
            

            <p class="padding-20-nl">
                <a href="<?= base_url(); ?>/admin/blog/edit" class="btn btn-transition btn-success">Ajouter un nouvel article</a>
                <a href="<?= base_url(); ?>/admin/" class="btn btn-transition btn-secondary">Revenir à l'administration</a>
            </p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article) { ?>
                        <tr>
                            <td><?= $article['id_article']; ?></td>
                            <td><?= $article['titre']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>/admin/blog/edit/<?php echo $article['id_article']; ?>" class="btn btn-transition btn-primary">Editer l'article</a>
                                <a href="<?= base_url(); ?>/admin/blog/delete/<?php echo $article['id_article']; ?>" class="btn btn-transition btn-primary" onclick="return confirm('Sur de sur ?')">Supprimer</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>