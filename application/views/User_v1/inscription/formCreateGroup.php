<div class="col-lg-12">
    <div class="modal fade" id="modalAjouterGroupe" tabindex="-1" role="dialog" aria-labelledby="modalAjouterGroupe" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cr&eacute;er un groupe de projet</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $form_groupe_uri->getUrl(); ?>" method="post" id="formAjoutGroupe" data-toogle="validator">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="nomGroupe">Nom du groupe :</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="input-group-nomGroupe"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" name="nomGroupe" id="nomGroupe" aria-describedby="nomGroupe" class="form-control"  required/>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="ecole">Ecole :</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group selectSchool">
                                        <span class="input-group-addon" id="input-group-ecole"><i class="glyphicon glyphicon-education"></i></span>
                                        <select class="form-control" aria-describedby="input-group-ecole" name="ecole">
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
                    </form>
                    <br />
                    <!-- formulaire cach� d'ajout d'�cole -->

                
<?php load_simple_view("/inscription/formCreateSchool"); ?>
                   

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-primary" value="Enregistrer" id="sendFormAjoutGroupe" />
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

