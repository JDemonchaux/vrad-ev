    <div class="row-fluid">
        <h1 class="hcenter titre">Bienvenue</h1>
    </div>
<br />
<div class="container">
    <div class="col-lg-8">
        <form class="col-lg-12" action="<?php echo $form_jury_uri->getUrl(); ?>" method="POST" id="formulaireInscriptionJury">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="hcenter">S'inscrire comme jury</h3>
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
                                    <input type="text" id="nom" name="nom" class="form-control" aria-describedby="input-group-nom" />
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
                                    <input type="text" id="prenom" name="prenom" class="form-control" aria-describedby="input-group-prenom" />
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
                                    <input type="email" id="email" name="email" class="form-control" aria-describedby="input-group-email" />
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
                                    <input type="password" id="password" name="password" class="form-control" aria-describedby="input-group-password" />
                                </div>
                                <?php echo form_error("password", '<div class="alert alert-danger contact-warning">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="specialite">Sp&eacute;cialit&eacute; : </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon" id="input-group-specialite"><i class="glyphicon glyphicon-book"></i></span>
                                    <select class="form-control" aria-describedby="input-group-specialite" name="specialite">
                                        <option>PHP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="represente">Repr&eacute;senter :</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon" id="input-group-represente"><i class="glyphicon glyphicon-education"></i></span>
                                    <select class="form-control" aria-describedby="input-group-represente" id="represente" name="ecole">
                                        <option disabled="disabled"></option>
                                        <?php
                                        foreach ($lesEcoles as $school)
                                        {
                                            echo '<option value="'.$school->getId().'">'.$school->getLibelle().'</option>';
                                        }

                                        ?>
                                    </select>
                                    <div class="input-group-btn">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default" id="ajouterEcole" data-toogle="modal" data-target="#modalAjouterGroupe">
                                                Nouvelle
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer hcenter">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>
    </div>
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

<div class="col-lg-12">
    <form action="<?php echo $form_school_uri->getUrl(); ?>" method="POST" id="formAjouterEcole">
        <div class="modal fade" id="modalAjouterEcole" tabindex="-1" role="dialog" aria-labelledby="modalAjouterGroupe" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="panel-title">Ajouter une &eacute;cole</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="nomEcole">Nom :</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-nomEcole"><i class="glyphicon glyphicon-education"></i></span>
                                        <input type="text" name="nomEcole" id="nomEcole" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="logo">Logo :</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" readonly class="form-control" id="inputFileRO" />
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">Parcourir
                                                <input type="file">
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="ville">Ville :</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-ville"><i class="glyphicon glyphicon-home"></i></span>
                                        <input type="text" name="ville" id="ville" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer hcenter">
                        <button class="btn btn-default" type="button" onclick="return false;" data-dismiss="modal">Fermer</button>
                        <button class="btn btn-primary" type="submit" onclick="return false;" id="sendFormAjouterEcoleJury">Enregistrer l'&eacute;cole</button>&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
