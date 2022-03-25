<?= $this->extend('templates/template_home') ?>


<?= $this->section('content') ?>



<section class="section">
    <div class="section-sub-padding">

        <h1>Administrer les Portfolio Items</h1>

        <div class="container-portfolio-item-admin">
            

            <p class="padding-20-nl">
                <a href="<?php echo base_url(); ?>/admin/portfolio/edit" class="btn btn-transition btn-success">Ajouter un nouvel item</a>
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
                    <?php foreach($items as $item) : ?>
                        <tr>
                            <td class="id-item-js"><?= $item['id_portfolio_item']; ?></td>
                            <td><a class="a-standard" href="<?= base_url(); ?>/portfolio/<?= $item['id_portfolio_item'] . '-' . $item['slug']; ?>"><?php echo $item['titre']; ?></a>  </td>
                            <td>	
                                <select class="selectPosition btn btn-transition btn-secondary" name="selectPosition">
                                    <option value="">Position</option>

                                </select>
                                <a href="<?= base_url(); ?>/admin/portfolio/edit/<?= $item['id_portfolio_item']; ?>" class="btn btn-transition btn-primary">Editer l'item</a>
                                <a href="<?= base_url(); ?>/admin/portfolio/delete/<?= $item['id_portfolio_item']; ?>" class="btn btn-transition btn-primary" onclick="return confirm('Sur de sur ?')">Supprimer</a>
                            </td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    var numberOfItems = <?= $numberOfItems ?>;
    var selectOptions = document.getElementsByClassName("selectPosition");
    

    for(let selectOption of selectOptions) {
        for (i = 1; i <= numberOfItems; i++)
        { 
            var opt = document.createElement('option');
            opt.value = i;
            opt.innerHTML = i;
            selectOption.appendChild(opt);

        }

        selectOption.addEventListener('change', function() {

            var idSelectOption = this.closest("td").previousElementSibling.previousElementSibling.innerHTML;

            var data = 'idItem=' + idSelectOption + '&position=' + this.value;
            console.log(data);
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    alert(xhr.responseText);
                }
            }
            xhr.open('POST', '<?= base_url("admin/portfolio");?>', true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
 
            xhr.send(data);
        });
    }





</script>

<?= $this->endSection() ?>