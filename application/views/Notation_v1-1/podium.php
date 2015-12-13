<?php
//var_dump($les_groupes);
?>

<div class="row">
    <div class="col-sm-9">
        <div class="row main">
            <div class="col-sm-1">
                &nbsp;
            </div>
            <div class="col-sm-10">
                <div class="row podium">
                    <?php $i = 0;
                    foreach ($les_groupes as $groupe) {
                    $i++;
                    if ($i < 4) { ?>
                    <?php if ($i == 1) {
                        echo '<div class="col-sm-4 col-sm-push-4">';
                    } else if ($i == 2) {
                        echo '<div class="col-sm-4 col-sm-pull-4" >';
                    } else {
                        echo '<div class="col-sm-4">';
                    } ?>
                    <div class="no<?php echo $i; ?>">
                        <div class="title"><?php echo $groupe->getLibelle(); ?></div>
                        <div class="score"><?php echo $groupe->getScore(); ?>/200</div>
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
