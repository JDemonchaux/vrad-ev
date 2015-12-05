<div class="row">
    <h3 class="text-center">Gantt du projet</h3>
</div>
<div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-2">
        <input list="ressources" type="text" id="filtre_ressource" placeholder="Filtrer pour une ressource"
               style="width: 100%;">
        <datalist id="ressources">
            <option value="pelo 1">
            <option value="pelo 2">
            <option value="pelo 3">
        </datalist>
    </div>
    <div class="col-sm-7">
        <span class="text-center"> <?php echo $groupe->getLibelle(); ?></span>

        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $groupe->getAvancement(); ?>"
                 aria-valuemin="0"
                 aria-valuemax="100" style="width: <?php echo $groupe->getAvancement(); ?>%;">
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <button type="button" class="btn btn-default ajouterTache" data-toggle="modal" data-target="#addTask">Ajouter
            une tâche
        </button>
    </div>
</div>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <table class="gantt table">
            <thead>
            <tr>
                <th>Tâche</th>
                <th>Heure début</th>
                <th>Heure fin</th>
                <?php for ($i = 20; $i < 24; $i++) { ?>
                    <th><?php echo $i; ?>h</th>
                <?php } ?>
                <?php for ($i = 0; $i < 9; $i++) { ?>
                    <th><?php echo $i; ?>h</th>
                <?php } ?>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php if (isset($rows)) { foreach($rows as $row) { ?>
                    <tr>
                        <td></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-1"></div>
</div>


<!-- Modal ajout tache -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="Nouvelle tache">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo $form_ajout_tache->getUrl();?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nouvelle tâche</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom de la tâche</label>
                        <input type="text" class="form-control" id="nom" name="nom"/>
                    </div>
                    <div class="form-group">
                        <label for="ressource">Ressource</label>
                        <select id="ressource" name="ressource" class="form-control">
                            <?php foreach($ressources as $ressource) {?>
                                <option value="<?php echo $ressource->getId(); ?>"><?php echo $ressource->getPrenom(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="itm">Items projet</label>
                        <select id="itm" name="item" class="form-control">
                            <?php foreach($items as $item) {?>
                                <option value="<?php echo $item->getIdItem(); ?>"><?php echo $item->getLibelle(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group datetimepicker">
                        <span>De : </span>
                        <div class='input-group date col-sm-4' id='datetimepicker1'>
                            <input type='text' class="form-control" name="heure_debut"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <span> à : </span>
                        <div class='input-group date col-sm-4' id='datetimepicker2'>
                            <input type='text' class="form-control" name="heure_fin"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
            </form>
        </div>
    </div>
</div>