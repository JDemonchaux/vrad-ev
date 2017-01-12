<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Mon projet <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo construct_full_url("Planification", "gantt", "Projet"); ?>">Planification</a>
                        </li>
                        <li><a href="#!">Ma ToDo Liste</a></li>
                    </ul>
                </li>
                <li><a href="#!">Ressources</a></li>
                <li><a href="#!">R&eacute;sultats</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php
                // R�cup�ration de l'heure
                $dt = new DateTime("now", new DateTimeZone('Europe/Paris'));
                echo "<p class='navbar-text'>Il est : " . $dt->format('H') . "h" . $dt->format('i');
                ?>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php
                            $ci = get_instance();
                            $user = $ci->session->current_user;
                            echo $user->getNom();
                            ?>
                        </li>
                    </ul>
                </li>
                <li><a href="<?php echo construct_full_url("Connexion", "logout", "User") ?>"><i
                            class="glyphicon glyphicon-off"></i></a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>