<style>
    .small-padding {
        padding-right: 5px;
        padding-left: 5px;
    }

    .no-padding {
        padding-right: 0px;
        padding-left: 0px;
    }

    .small-input {
        height: 25px;
    }
</style>

<?php
$URL = $action->getURL();
//id_groupe
?>
<form action='<?php echo $URL; ?>' method='post'>


    <div class="row-fluid">
        <h1 class="hcenter">
            <?php
            if ($only_one) {
                $groupe = $les_groupes[$id_groupe];
                //echo $group->getLibelle()." - ".$group->getAvancement()."% - ".$group->getScore()."/200";
                ?>
                <input type='hidden' name='id_groupe' value='<?php echo $groupe->getId(); ?>'/>
                <div class="row vertical-center">
                    <div class="col-sm-2 image">
                        <?php echo img_url("ecoles/".$groupe->getEcole()->getId().".png", "Logo de l'école", "img-responsive");?>
                    </div>
                    <div class="col-sm-2">
                        <?php echo $groupe->getLibelle(); ?>
                    </div>
                    <div class="col-sm-4">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"
                                 aria-valuenow="<?php echo $groupe->getAvancement(); ?>" aria-valuemin="0"
                                 aria-valuemax="100" style="width: <?php echo $groupe->getAvancement(); ?>%;">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <?php echo $groupe->getAvancement(); ?> %
                    </div>
                    <div class="col-sm-2">
                        <?php echo $groupe->getScore(); ?> / 200
                    </div>
                </div>
                <?php

            } else {
                echo "Harmonisation";
            }
            ?>

        </h1>
    </div>

    <div class="container-fluid container">

        <input type='submit' value='Valider' class="btn btn-default"/>

        <!-- entete -->
        <div class="row ">

            <?php if ($only_one) { ?>

                <div class="col-xs-4"></div>
                <div class="col-xs-2"><h4 class="hcenter">VA %</h4></div>
                <div class="col-xs-2"><h4 class="hcenter">note</h4></div>
                <div class="col-xs-4"><h4 class="hcenter">Commentaire</h4></div>
            <?php } else {
                ?>
                <div class="col-xs-3"></div>
                <?php
                foreach ($les_groupes as $id_group => $group) {
                    ?>
                    <div class="col-xs-1">
                        <div class="row">
                            <?php echo img_url("ecoles/".$group->getEcole()->getId().".png", "Logo de l'école", "img-responsive");?>
                        </div>
                        <div class="row">
                            <h6 class="hcenter"><?php echo $group->getLibelle() ?>
                                <br/><span><?php echo $group->getScore(); ?> / 200</span></h6>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <!-- fin row entete-->


        <!-- remplissage -->
        <?php
        //lignes pour chaque item (dont entete de catégorie)
        $prev_categorie = "";
        foreach ($les_items as $id_item => $item) {

        //ligne pour une nouvelle catégorie (avant l'item ) ------------------------------------
        if ($item->getCategorie()->getLibelle() != $prev_categorie) {

            $score = "";
            if ($only_one) {
                //affichage du score du groupe pour la categ
                $key = array_keys($les_groupes);
                $item_group = $les_groupes[$key[0]]->getResultats()[$id_item];
                $score = " (" . $item_group->getCategorie()->getScore() . "/" . $item_group->getCategorie()->getCoef() . ")";
            }// fin if only_one

            ?>

            <div class="row " style="margin-bottom: 1rem; margin-top:1rem; background-color: <?php echo $item->getCategorie()->getHexaColor();?>;">
                <div class="col-xs-4">
                    <h3>
                        <?php echo $item->getCategorie()->getLibelle(); ?>
                    </h3>
                </div>
                <div class="col-xs-2">
                </div>
                <div class="col-xs-2 hcenter">
                    <h3><?php echo $score; ?></h3>
                </div>
                <div class="col-xs-4">
                </div>
            </div>
            <?php
            $prev_categorie = $item->getCategorie()->getLibelle();
        }// fin si nouvelle categorie ---------------------------------------------------------


        //ligne pour un item
        ?>
        <div class="row"> <!-- debut row de item-->
            <?php if ($only_one){ ?>
            <div class="col-xs-4">
                <?php }else { ?>
                <div class="col-xs-3">
                    <?php } // fin if only_one ?>
                    <div class="row">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-11">
                            <?php echo $item->getLibelle(); ?>
                        </div>
                    </div>
                </div>

                <?php
                foreach ($les_groupes as $id_group => $group) {

                //mise à jour des infos de l'item avec les résultat du groupe
                if (isset ($group->getResultats()[$id_item])) {
                    $item_group = $group->getResultats()[$id_item];
                } else {
                    $item_group = $item;
                }

                //si item planifiable et avancement à 0 on ne peut pas noter
                $disable = "";
                if (!$item_group->isEvaluable()) {
                    $disable = "DISABLED";
                }

                //Construction du formulaire avec les saisies précédentes
                $val = $item_group->getNotation()->getNote();
                $valcom = $item_group->getNotation()->getCommentaire();
                $name = "g" . $group->getId() . "-i" . $id_item . "";
                $note_name = "N_" . $name;
                $com_name = "C_" . $name;

                //affichage de l'avancement pour l'item
                $style = "small-input";
                if ($only_one){
                $style = "";
                ?>
                <div class="col-xs-2 hcenter"><?php echo $item_group->displayAvancement(); ?></div>
                <div class="col-xs-2 hcenter">
                    <?php }else{ ?>
                    <div class="col-xs-1">
                        <input type='hidden' name='<?php echo $com_name; ?>' value='<?php echo $valcom; ?>'/>
                        <?php } // fin if only_one ?>
                        <div class="row">
                            <div class="col-xs-8 small-padding">
                                <input class='form-control small-padding <?php echo $style; ?>' type='text' size='3'
                                       name='<?php echo $note_name; ?>'
                                       value='<?php echo $val; ?>' <?php echo $disable; ?> />
                            </div>
                            <div class="col-xs-4 small-padding">/<?php echo $item_group->getCoef(); ?></div>
                        </div>
                    </div>
                    <?php // fin if only_one

                    if ($only_one) { ?>
                        <div class="col-xs-4">
                            <textarea placeholder="truc" class='form-control' size='20'
                                      name='<?php echo $com_name; ?>' <?php echo $disable; ?> />
                            <?php echo $valcom; ?>
                            </textarea>
                        </div>
                        <?php
                    }// fin if only_one


                    }//fin for groupes
                    ?>
                </div>
                <!-- fin row de item -->

                <?php

                }//fin for items

                //fin du formulaire
                echo "<input type='submit' value='Valider' class='btn btn-default'/>";
                echo "</form >";
                ?>
            </div>
        </div>
    </div><!-- fin du contenaire fluid-->
</form>