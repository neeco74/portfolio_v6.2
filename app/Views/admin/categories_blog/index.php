<?= $this->extend('templates/template_home') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-sub-padding">

        <h1>Categories de blog</h1>

        <div class="container-galerie-admin">
            
            <p class="padding-20-nl">
                <a href="<?php echo base_url(); ?>/admin/cat-blog/edit" class="btn btn-transition btn-success">Ajouter une nouvelle categorie</a>
                <a href="<?php echo base_url(); ?>/admin/" class="btn btn-transition btn-secondary">Revenir à l'administration</a>
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
                    <?php foreach ($catBlog as $categorie) { ?>
                        <tr>
                            <td><?= $categorie['id_categorie_article']; ?></td>
                            <td><?= $categorie['titre']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>/admin/cat-blog/edit/<?php echo $categorie['id_categorie_article']; ?>" class="btn btn-transition btn-primary">Editer la catégorie</a>
                                <a href="<?= base_url(); ?>/admin/cat-blog/delete/<?php echo $categorie['id_categorie_article']; ?>" class="btn btn-transition btn-primary" onclick="return confirm('Sur de sur ?')">Supprimer</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>