<nav class="navbar navbar-default navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand white-text" href="#"><strong>Nuit de l'Info <i><span class="rouge-text">#3</span></i></strong></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
                <?php
                foreach ($menu as $rubrique)
                {
                ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo $rubrique->getName(); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($rubrique->getItem() as $item)
                        {
                        $URL = $item->getURL();
                        $les_sub = $item->getSubItem();
                        if (!empty($les_sub)){
                        ?>
                        <li><a href="#"><?php echo $item->getName(); ?></a>
                            <ul> <?php
                                foreach ($les_sub as $key => $value) {
                                    ?>
                                    <li>
                                        <a href="<?php echo $URL->getURL() . '/' . $key; ?>"><?php echo $value->getLibelle(); ?></a>
                                    </li>
                                <?php }
                                echo "</ul>";
                                }else{
                                ?>
                                <li><a href="<?php echo $URL->getURL(); ?>"><?php echo $item->getName(); ?></a>
                                    <?php
                                    }
                                    ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php

                        }
                        ?>


                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        // R�cup�ration de l'heure
                        $dt = new DateTime("now", new DateTimeZone('Europe/Paris'));
                        echo "<p class='navbar-text'>Il est : " . $dt->format('H') . "h" . $dt->format('i');
                        $ci = get_instance();
                        $user = $ci->session->current_user;
                        ?>
                        <li class="dropdown">
                            <a>
                                <i class="glyphicon glyphicon-user"></i>
                                <?php echo $user->getPrenom() . " " . $user->getNom(); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    Pas d'actions possibles
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