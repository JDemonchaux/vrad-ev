<form class="row col-lg-offset-1 formEcole" action="<?php echo $form_school_uri->getUrl(); ?>" method="post" id="formAjoutEcole">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Ajouter une &eacute;cole</h4>
        </div>
        <div class="panel-body">
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
                                                        <input type="file" name="logoEcole">
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
        <div class="panel-footer hcenter">
            <button class="btn btn-default" type="button" onclick="return false;" id="fermerAjoutEcole">Fermer</button>
            <input class="btn btn-primary" type="submit" onclick="return false;" id="sendFormAjouterEcole" />
        </div>
    </div>
</form>
