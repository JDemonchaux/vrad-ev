<div class="container">
    <div class="row-fluid">
        <h1 class="hcenter titre">Bienvenue</h1>
    </div>
    <br/>

    <div class="container-fluid container">
        <div class="row-fluid">
            <div class="col-md-6">
                <div class="panel panel-default panel-home">
                    <div class="panel-heading vert white-text">
                        <h4>Vous n'etes pas encore inscrit ?</h4>
                    </div>
                    <div class="panel-body">
                        <p class="block-noir"></p>

                        <p class="block-noir"></p>

                        <p class="block-noir"></p>

                        <p class="block-noir"></p>
                        <br/>

                        <p class="hcenter">
                            <a href="<?php echo $form_inscriptionMembre_uri; ?>">
                                <button class="btn rouge white-text">S'inscrire en participant</button>
                            </a>
                        </p>
                        <p class="hcenter">
                            <a href="<?php echo $form_inscriptionJury_uri; ?>">
                                <button class="btn rouge white-text">S'inscrire en Jury</button>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default panel-home">
                    <div class="panel-heading vert white-text">
                        <h4>Connectez-vous</h4>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo $form_connexion_uri; ?>" method="POST" class="formHome">
                            <br/>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" type="email" required/>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control" required/>
                            </div>
                            <br/>

                            <div class="hcenter">
                                <button type="submit" class="btn rouge white-text">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- slider -->
            <div class="carousel_sponsor_vertical container"
                 data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true}'>
                <?php
                if (isset($images)) {
                    foreach ($images as $image) {
                        echo '<div class="col-lg-4">';
                        echo '<div class="vcenter_slider">';
                        echo '<img src="' . base_url() . $image . '" class="imgItem"/>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>