    <div class="row-fluid">
        <h1 class="hcenter titre">Bienvenue</h1>
    </div>
<br />
<div class="container">
    <div class="col-lg-8">
        <form class="col-lg-12" action="<?php echo $form_participant_uri->getURL(); ?>" method="post" id="formulaireInscriptionParticipant" data-toogle="validator" role="form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="hcenter"><?php echo $form_participant_uri->getActionName(); ?></h3>
                </div>
                <br />
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="nom">Nom : </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-nom"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="nom" name="nom" class="form-control" aria-describedby="input-group-nom" required />
                                    </div>
                                    <?php echo form_error("nom", '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="prenom">Prenom : </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-prenom"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="prenom" name="prenom" class="form-control" aria-describedby="input-group-prenom" required />
                                    </div>
                                    <?php echo form_error("prenom", '<div class="alert alert-danger contact-warning">', '</div>'); ?>                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="email">Email (login) : </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-email">@</span>
                                        <input type="email" id="email" name="email" class="form-control" aria-describedby="input-group-email" required />
                                    </div>
                                    <?php echo form_error("email", '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="password">Mot de passe : </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-password"><i class="glyphicon glyphicon-asterisk"></i></span>
                                        <input type="password" id="password" name="password" class="form-control" aria-describedby="input-group-password" required />
                                    </div>
                                    <?php echo form_error("password", '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="classe">Classe : </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-classe"><i class="glyphicon glyphicon-education"></i></span>
                                        <select class="form-control" aria-describedby="input-group-classe" name="classe" required>
                                            <option disabled="disabled"></option>
                                            <?php
                                            foreach ($lesClasses as $classe)
                                            {            
                                                echo '<option value="'.$classe->getId().'">'.$classe->getLibelle().'</option>';
                                            }
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="rejoindreGroup">Groupe :</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-rejoindre"><i class="glyphicon glyphicon-user"></i></span>
                                        <select class="form-control" aria-describedby="input-group-rejoindre" name="groupe" required>
                                            <option disabled="disabled"></option>
                                            <?php
                                            foreach ($lesGroupes as $groupe)
                                            {
                                                echo '<option value="'.$groupe->getId().'">'.$groupe->getLibelle().'</option>';
                                            }
                                            ?>
                                        </select>
                                        <!--
                                        <div class="input-group-btn">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default" id="ajouterGroupe" data-toogle="modal" data-target="#modalAjouterGroupe">
                                                    Nouveau
                                                </button>
                                            </div>
                                        </div>
                                    -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer hcenter">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <input type="submit" class="btn btn-primary" id="sendForm" value="Valider" />
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4">
        <!-- slider -->
        <div class="carousel_sponsor_vertical container" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": false, "vertical": true}'>
            <?php        
            if (isset($images)) {
                foreach ($images as $image)
                {
                    echo '<div class="col-lg-4">';
                    echo '<div class="vcenter_slider">';
                    echo '<img src="'.base_url().$image.'" class="imgItem"/>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

</div>

<!-- formulaire d'ajout d'un groupe -->
<?php load_simple_view("inscription/formCreateGroup"); ?>
