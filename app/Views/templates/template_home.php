<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Portfolio 4">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico" />
    <title>Portfolio de Nicolas Olagnon</title>

    <script src="<?php echo base_url(); ?>/js/animatein.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/css/style_home.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/css/style_media.css" rel="stylesheet">

</head>

<body>

    <?= $this->include('includes/include_nav') ?>

    <div class="main-wrapper">

        <?php
            if(session()->getFlashdata('success_home') <> '') { ?>
                <div class="notification-success-home">  
                    <?= session()->getFlashdata('success_home') ?>
                </div>
           <?php     
            }
            if(session()->getFlashdata('danger_home') <> '') { ?>
                <div class="notification-danger-home">  
                    <?= session()->getFlashdata('danger_home') ?>
                </div>
           <?php     
            }
        ?>

        <?= $this->renderSection('content') ?>


    </div>

    <div id="scroll-up">
            <a href="#top"><img src="<?php base_url(); ?>/img/to_top.png" width="75px";/></a>
    </div>

    <script src="<?php echo base_url(); ?>/js/fontawesome-5.15.1.js"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.js"></script>

    <script src="<?php echo base_url(); ?>/js/zooming.js"></script>

    <script src="<?php echo base_url(); ?>/js/index_home.js"></script>

</body>

</html>