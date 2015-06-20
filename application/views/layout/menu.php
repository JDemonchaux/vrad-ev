<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Mon projet</a></li>
                <li><a href="#!">Ressources</a></li>
                <li><a href="#!">R&eacute;sultats</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php
                // Récupèration de l'heure
                $dt = new DateTime("now", new DateTimeZone('Europe/Paris'));
                echo "<p class='navbar-text'>Il est : " . $dt->format('H') . "h" . $dt->format('i');
                ?>
                <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
                <li><a href="<?php echo base_url() . "User_v1/Connexion/logout"; ?>"><i
                            class="glyphicon glyphicon-off"></i></a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>