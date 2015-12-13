<div class="row-fluid">
    <h1 class="hcenter">
        <h1 class="hcenter">ToDO Liste de <?php echo $nomAffiche; ?></h1>

    </h1>
    <?php //var_dump($tasks);?>
</div>

<br/>

<div class="container-fluid container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered tableToDoList">
                <thead>
                <tr>
                    <th rowspan="2">Etat</th>
                    <th rowspan="2">Item</th>
                    <th rowspan="2">Prio</th>
                    <th rowspan="2">Tache</th>
                    <th colspan="2">Planifié</th>
                    <th colspan="2">Réel</th>
                </tr>
                <tr>
                    <th>Heure Début</th>
                    <th>Heure Fin</th>
                    <th>Heure Début</th>
                    <th>Heure Fin</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($les_taches as $tache) { ?>
                    <tr class="text-center">
                        <td><?php echo $tache->displayIconeEtat(); ?></td>
                        <td <?php echo 'style="background-color: ' . $tache->getItem()->getCategorie()->gethexaColor() . '"'; ?>>
                            <?php echo $tache->getItem()->getLibelle(); ?>
                        </td>
                        <td><?php echo $tache->getItem()->getPriority(); ?></td>
                        <td><?php echo $tache->getLibelle(); ?></td>
                        <td><?php echo $tache->getPlanning()->displayStartHourPlan("H:i"); ?></td>
                        <td><?php echo $tache->getPlanning()->displayEndHourPlan("H:i"); ?></td>
                        <td>
                            <?php if (is_null($tache->getEtat())) { //pas commencée ?>
                                <?php $URL = $URL_start->getURL() . "/" . $tache->getIdTask(); ?>
                                <form action="<?php echo $URL; ?>" method="POST"
                                      id="formStartT<?php echo $tache->getIdTask(); ?>">
                                    <button type="submit" class="btn btn-success">Commencer</button>
                                </form>
                            <?php } else {
                                echo $tache->getPlanning()->displayStartHourReal("H:i");
                            } ?>
                        </td>
                        <td> <?php
                            if ($tache->getEtat() == 1) { //pas commencée
                                $URL = $URL_stop->getURL() . "/" . $tache->getIdTask();
                                ?>
                                <form action="<?php echo $URL; ?>" method="POST"
                                      id="formStopT<?php echo $tache->getIdTask(); ?>">

                                    <button type="submit" class="btn btn-danger">Terminer</button>
                                </form>
                            <?php } else {
                                echo $tache->getPlanning()->displayEndHourReal("H:i");
                            } ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <!--    <div class="row">-->
    <!--        <div class="col-xs-1"><h4>Etat</h4></div>-->
    <!--        <div class="col-xs-6">-->
    <!--            <div class="row">-->
    <!--                <div class="col-xs-4"><h4>Item</h4></div>-->
    <!--                <div class="col-xs-2"><h4>Prio</h4></div>-->
    <!--                <div class="col-xs-6"><h4>Task</h4></div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-xs-5">-->
    <!--            <div class="row">-->
    <!--                <div class="col-xs-6 hcenter"><h4>planifié</h4></div>-->
    <!--                <div class="col-xs-6 hcenter"><h4>Réel</h4></div>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                <div class="col-xs-3 hcenter"><h5>Heure Debut</div>-->
    <!--                <div class="col-xs-3 hcenter"><h5>Heure Fin</h5></div>-->
    <!--                <div class="col-xs-3 hcenter"><h5>Heure Debut</h5></div>-->
    <!--                <div class="col-xs-3 hcenter"><h5>Heure Fin</h5></div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    --><?php //foreach ($les_taches as $tache) { ?>
    <!--        <div class="row">-->
    <!--            <div class="col-xs-1"> --><?php //echo $tache->displayIconeEtat(); ?><!-- </div>-->
    <!--            <div class="col-xs-6">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-xs-4">--><?php //echo $tache->getItem()->getLibelle(); ?><!-- </div>-->
    <!--                    <div class="col-xs-2">--><?php //echo $tache->getItem()->getPriority(); ?><!-- </div>-->
    <!--                    <div class="col-xs-6">--><?php //echo $tache->getLibelle(); ?><!--</div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-xs-5">-->
    <!--                <div class="row">-->
    <!--                    <div-->
    <!--                        class="col-xs-3 hcenter">-->
    <?php //echo $tache->getPlanning()->displayStartHourPlan("H:i"); ?><!--</div>-->
    <!--                    <div class="col-xs-3 hcenter">-->
    <?php //echo $tache->getPlanning()->displayEndHourPlan("H:i"); ?><!--</div>-->
    <!--                    <div class="col-xs-3 hcenter">-->
    <!--                        --><?php //if (is_null($tache->getEtat())) { //pas commencée ?>
    <!--                            --><?php //$URL = $URL_start->getURL() . "/" . $tache->getIdTask(); ?>
    <!--                            <form action="--><?php //echo $URL; ?><!--" method="POST"-->
    <!--                                  id="formStartT--><?php //echo $tache->getIdTask(); ?><!--">-->
    <!--                                <button type="submit" class="btn btn-success">Commencer</button>-->
    <!--                            </form>-->
    <!--                        --><?php //} else {
    //                            echo $tache->getPlanning()->displayStartHourReal("H:i");
    //                        } ?>
    <!--                    </div>-->
    <!--                    <div class="col-xs-3 hcenter">-->
    <!--                        --><?php
    //                        if ($tache->getEtat() == 1) { //pas commencée
    //                            $URL = $URL_stop->getURL() . "/" . $tache->getIdTask();
    //                            ?>
    <!--                            <form action="--><?php //echo $URL; ?><!--" method="POST"-->
    <!--                                  id="formStopT--><?php //echo $tache->getIdTask(); ?><!--">-->
    <!---->
    <!--                                <button type="submit" class="btn btn-danger">Terminer</button>-->
    <!--                            </form>-->
    <!--                        --><?php //} else {
    //                            echo $tache->getPlanning()->displayEndHourReal("H:i");
    //                        } ?>
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    --><?php //} ?>
</div>