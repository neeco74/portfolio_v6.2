<header>

    <div class="header-horizontal">

        <div class="header-horizontal-block">

            <div class="header-horizontal-icone">
                <a href="" class="btn-title"><i class="fas fa-bars"></i></a>
            </div>

            <h2 class="header-horizontal-titre"><a class="a-standard" href="<?php echo base_url(); ?>">Nicolas Olagnon</a></h2>

        </div>

    </div>


    <div class="header-vertical">

        <div class="header-container">

            <div class="header-titre flex-center">
                <div class="margin-text-animate-center">
                    <h2>
                        <p class="animate-text"><i class="fas fa-code margin-r-5"></i> Nicolas Olagnon</p>
                    </h2>
                </div>
            </div>

            <div class="header-photo">
                <img class="photo-profil rounded" src="<?php echo base_url(); ?>/img/photo_profil.jpg" alt="image" width="150px" ;>

            </div>

            <div class="header-intro">
                <p>Bonjour<?php if ($_SESSION["authPortfolio"]->id_user != null) echo ' ' . $_SESSION["authPortfolio"]->prenom . ' ' . $_SESSION["authPortfolio"]->nom; ?>,<br />je suis Nicolas Olagnon, développeur web français de 27 ans. Bienvenue sur mon site web personnel.</p>

            </div>


            <div class="separateur-nav none-mq"></div>


            <div class="header-nav">

                <nav>

                    <ul>
                        <li><a href="<?php echo base_url(); ?>/home" class="nav-link"><span class="icone-nav"><i class="fas fa-user"></i></span>A propos</a></li>
                        <li><a href="<?php echo base_url(); ?>/portfolio" class="nav-link"><span class="icone-nav"><i class="fas fa-laptop-code"></i></span>Portfolio</a></li>
                        <li><a href="<?php echo base_url(); ?>/cv" class="nav-link"><span class="icone-nav"><i class="fas fa-file-alt"></i></span>CV</a></li>
                        <li><a href="<?php echo base_url(); ?>/blog" class="nav-link"><span class="icone-nav"><i class="fas fa-blog"></i></span>Blog</a></li>
                        <li><a href="https://github.com/neeco74" target="_blank" class="nav-link"><span class="icone-nav"><i class="fab fa-github"></i></span>Github</a></li>
                        <li><a href="<?php echo base_url(); ?>/contact" class="nav-link"><span class="icone-nav"><i class="fas fa-paper-plane"></i></span>Contact</a></li>
                    </ul>

                </nav>

            </div>


            <div class="separateur-nav"></div>


            <div class="header-nav">

                <nav>

                    <ul>
                        <?php if ($_SESSION['authPortfolio']->role == "admin") { ?>
                            <li><a href="<?php echo base_url(); ?>/admin" class="nav-link"><span class="icone-nav"><i class="fas fa-lock"></i></span>Admin</a></li>
                        <?php
                        } else { ?>
                            <li><a href="<?php echo base_url(); ?>/profile" class="nav-link"><span class="icone-nav"><i class="fas fa-user"></i></span>Profil</a></li>
                        <?php
                        }
                        ?>

                        <li><a href="<?php echo base_url(); ?>/logout" class="nav-link"><span class="icone-nav"><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
                    </ul>



                </nav>

            </div>

            
            <div class="separateur-nav"></div>


            <div class="header-love text-center">
                Portfolio 6.2<br><br>
                Made with <i class="fas fa-heart icone-heart"></i> from scratch with CodeIgniter 4.1.9<br>
                No Bootstrap<br>
                Responsive optimisé pour 1920 x 1080



            </div>

        </div>
    </div>

</header>