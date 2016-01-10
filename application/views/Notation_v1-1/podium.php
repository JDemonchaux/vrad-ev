<?php


?>

<div class="row">
    <div class="col-sm-9">
        <div class="row main">
            <div class="col-sm-1">
                &nbsp;
            </div>
            <div class="col-sm-10">
                <div class="row row-podium  ">
                    <?php $i = 0;
                    foreach ($les_groupes as $groupe) {
                    $i++;
                    if ($i < 4) { ?>
                    <?php if ($i == 1) {
                        echo '<div class="col-sm-4 col-sm-push-4 podium">';
                    } else if ($i == 2) {
                        echo '<div class="col-sm-4 col-sm-pull-4 podium">';
                    } else {
                        echo '<div class="col-sm-4 podium">';
                    } ?>
                    <div class="no<?php echo $i; ?>">
                        <div class="logo">
                            <?php echo img_url("ecoles/" . $groupe->getEcole()->getId() . ".png", "Logo de l'école", "logoEcole"); ?>
                        </div>
                        <div class="title"><?php echo $groupe->getLibelle(); ?></div>
                        <div class="score"><?php echo $groupe->getMoyenne(); ?>/20</div>
                        <div class="score">(<?php echo $groupe->getScore(); ?>pt)</div>
                        <div class="progress ">
                            <div class="progress-bar vert" role="progressbar"
                                 aria-valuenow="<?php echo $groupe->getAvancement(); ?>"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style="width: <?php echo $groupe->getAvancement(); ?>%;">
                                            <span class="avancement">
                                                <?php echo $groupe->getAvancement(); ?>%
                                            </span>
                            </div>
                        </div>

                    </div>
                    <div class="podiumFooter">
                        <div class="place">
                            <?php
                            if ($i == 1) {
                                echo "<div class='medal n1'>".$i."</div>";
                            } elseif ($i == 2) {
                                echo "<div class='medal n2'>".$i."</div>";
                            } elseif ($i == 3) {
                                echo "<div class='medal n3'>".$i."</div>";
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                    <div class="col-xs-2 classement">
                        <div class="logo" style="max-width: 8.3rem !important">
                            <?php echo img_url("ecoles/" . $groupe->getEcole()->getId() . ".png", "Logo de l'école", "logoEcole"); ?>
                        </div>
                        <div class="title"><?php echo $groupe->getLibelle(); ?></div>
                        <div class="score"><?php echo $groupe->getMoyenne(); ?>/20</div>
                        <div class="score">(<?php echo $groupe->getScore(); ?>pt)</div>
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar"
                                 aria-valuenow="<?php echo $groupe->getAvancement(); ?>"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style="width: <?php echo $groupe->getAvancement(); ?>%;">
                                            <span class="avancement">
                                                <?php echo $groupe->getAvancement(); ?>%
                                            </span>
                            </div>
                        </div>
                    </div>
                <?php }
                } ?>

            </div>
            <div class="row classement">
                &nbsp;
            </div>
        </div>
        <div class="col-sm-1">
            &nbsp;
        </div>
    </div>
</div>
<div class="col-sm-3">
    <!-- slider -->
    <div class="carousel_sponsor_vertical container"
         data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true, "vertical": true}'>
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
