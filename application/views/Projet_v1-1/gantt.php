<div class="row">
    <h3 class="text-center">Gantt du projet</h3>
</div>
<div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-2">
        <select id="ressources">
            <option value=""><i>Filtrer par une ressource</i></option>
            <?php foreach ($ressources as $unGens) { ?>
                <option value="<?php echo $unGens->getId(); ?>"><?php echo $unGens->getPrenom(); ?></option>
            <?php } ?>
        </select>
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
        <table class="gantt table table-condensed table-bordered">
            <thead>
            <tr>
                <th rowspan="2" class="text-center">Tâche</th>
                <th rowspan="2" class="text-center">Heure début</th>
                <th rowspan="2" class="text-center">Heure fin</th>
                <?php for ($i = 20; $i < 24; $i++) { ?>
                    <th colspan="4" class="text-center"><?php echo $i; ?>h</th>
                <?php } ?>
                <?php for ($i = 0; $i < 8; $i++) { ?>
                    <th colspan="4" class="text-center"><?php echo $i; ?>h</th>
                <?php } ?>
                <th rowspan="2" colspan="4" class="text-center">Actions</th>
            </tr>
            <tr>
                <?php for ($i = 20; $i < 24; $i++) { ?>
                    <th class="minute text-center">00</th>
                    <th class="minute text-center">15</th>
                    <th class="minute text-center">30</th>
                    <th class="minute text-center">45</th>
                <?php } ?>
                <?php for ($i = 0; $i < 8; $i++) { ?>
                    <th class="minute text-center">00</th>
                    <th class="minute text-center">15</th>
                    <th class="minute text-center">30</th>
                    <th class="minute text-center">45</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($taches)) {
                foreach ($taches as $tache) { ?>
                    <tr class="<?php echo $tache->getUser()->getId(); ?>">
                        <td class="cursor-help"  style="background-color: <?php echo $tache->getItem()->getCategorie()->getHexaColor();?>;" title="Item <?php echo $tache->getItem()->getIdItem();?> : <?php echo $tache->getItem()->getLibelle(); ?>"><?php echo $tache->getLibelle(); ?></td>
                        <td class="text-center dd"><?php echo $tache->getPlanning()->displayStartHourPlan("H:i"); ?></td>
                        <td class="text-center df"><?php echo $tache->getPlanning()->displayEndHourPlan("H:i"); ?></td>
                        <?php for ($i = 20; $i < 24; $i++) { ?>
                            <td data-heure="<?php echo $i; ?>" data-minute="00"></td>
                            <td data-heure="<?php echo $i; ?>" data-minute="15"></td>
                            <td data-heure="<?php echo $i; ?>" data-minute="30"></td>
                            <td data-heure="<?php echo $i; ?>" data-minute="45"></td>
                        <?php } ?>
                        <?php for ($i = 0; $i < 8; $i++) { ?>
                            <td data-heure="<?php echo $i; ?>" data-minute="00"></td>
                            <td data-heure="<?php echo $i; ?>" data-minute="15"></td>
                            <td data-heure="<?php echo $i; ?>" data-minute="30"></td>
                            <td data-heure="<?php echo $i; ?>" data-minute="45"></td>
                        <?php } ?>
                        <td class="NP text-center">
                            <?php if ($tache->getIsNp() == 1) { ?>
                                (NP)
                            <?php } ?>
                        </td>
                        <td class="modifier text-center">
                            <?php if ($tache->getPlanning()->getStartHourReal() == NULL) { ?>
                                <a href="#!" data-toggle="modal" data-target="#modifTask"
                                   onClick="modalModifTache(this)"
                                   data-href="<?php echo $form_modif_tache->getUrl() . "/" . $tache->getIdTask(); ?>"
                                   data-ressource="<?php echo $tache->getUser()->getId(); ?>"
                                   data-nom="<?php echo $tache->getLibelle(); ?>"
                                   data-item="<?php echo $tache->getItem()->getIdItem(); ?>"
                                   data-heure_debut="<?php echo $tache->getPlanning()->getStartHourPlan()->format('H:i'); ?>"
                                   data-heure_fin="<?php echo $tache->getPlanning()->getEndHourPlan()->format('H:i'); ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            <?php } else { ?>
                                <a href="#!" title="La tache est deja commencée" class="disabled">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            <?php } ?>
                        </td>
                        <td class="supprimer text-center">
                            <?php if (date('H') >= 22) { ?>
                                <?php if ($tache->getIsNp()) { ?>
                                    <?php if ($tache->getPlanning()->getStartHourReal() == NULL) { ?>
                                        <a href="#!" data-toggle="modal" data-target="#confirm-delete"
                                           onClick="modalConfirmDelete(this)"
                                           data-href="<?php echo $form_suppr_tache->getUrl() . "/" . $tache->getIdTask(); ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#!" title="La tache est deja commencée" class="disabled">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <a href="#!" title="La tache ne peut etre supprimée" class="disabled">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if ($tache->getPlanning()->getStartHourReal() == NULL) { ?>
                                    <a href="#!" data-toggle="modal" data-target="#confirm-delete"
                                       onClick="modalConfirmDelete(this)"
                                       data-href="<?php echo $form_suppr_tache->getUrl() . "/" . $tache->getIdTask(); ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td class="etat text-center">
                            <?php if ($tache->getPlanning()->getStartHourReal() !== NULL && $tache->getPlanning()->getEndHourReal() == NULL) { ?>
                                <span class="glyphicon glyphicon-time orange-text"></span>
                            <?php } elseif ($tache->getPlanning()->getStartHourReal() !== NULL && $tache->getPlanning()->getEndHourReal() !== NULL) { ?>
                                <span class="glyphicon glyphicon-check green-text"></span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-1"></div>
</div>


<!-- Modal ajout tache -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="Nouvelle tache">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo $form_ajout_tache->getUrl(); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nouvelle tâche</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom de la tâche</label>
                        <input type="text" class="form-control" id="nom" name="nom" size="45"/>
                    </div>
                    <div class="form-group">
                        <label for="ressource">Ressource</label>
                        <select id="ressource" name="ressource" class="form-control">
                            <?php foreach ($ressources as $ressource) { ?>
                                <option
                                    value="<?php echo $ressource->getId(); ?>"><?php echo $ressource->getPrenom(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="itm">Items projet</label>
                        <select id="itm" name="item" class="form-control">
                            <?php foreach ($items as $item) { ?>
                                <option
                                    value="<?php echo $item->getIdItem(); ?>"><?php echo $item->getLibelle(); ?></option>
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


<!-- modal modif tache -->
<div class="modal fade" id="modifTask" tabindex="-1" role="dialog" aria-labelledby="Modifier">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="" id="formModifTask">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nouvelle tâche</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <span id="nomTache">Nom de la tâche</span>
                    </div>
                    <div class="form-group">
                        <label for="ressource">Ressource</label>
                        <select id="ressource_modifier" name="ressource" class="form-control">
                            <?php foreach ($ressources as $ressource) { ?>
                                <option
                                    value="<?php echo $ressource->getId(); ?>"><?php echo $ressource->getPrenom(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="itm">Items projet</label>
                        <select id="itm_modifier" name="item" class="form-control">
                            <?php foreach ($items as $item) { ?>
                                <option
                                    value="<?php echo $item->getIdItem(); ?>"><?php echo $item->getLibelle(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group datetimepicker">
                        <span class="datetimepicker3">De : </span>

                        <div class="input-group date col-sm-4" id="datetimepicker3">
                            <input type="text" class="form-control" name="heure_debut" id="heure_debut"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <span class="datetimepicker4"> à : </span>

                        <div class="input-group date col-sm-4" id="datetimepicker4">
                            <input type="text" class="form-control" name="heure_fin" id="heure_fin"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onClick="clearModal()">Fermer
                    </button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal confirm suppression tache -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="Confirmation"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirmation
            </div>
            <div class="modal-body">
                voulez vous supprimer la tache ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a class="btn btn-danger btn-ok" id="btDelete">Supprimer</a>
            </div>
        </div>
    </div>
</div>