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
                    <div class="col-sm-4">
                        <?php if (isset($les_groupes[2])) { ?>
                            <div class="no3">
                                <div class="title"><?php echo $les_groupes[2]->getLibelle(); ?></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow="<?php echo $les_groupes[2]->getAvancement(); ?>"
                                         aria-valuemin="0" aria-valuemax="100"
                                         style="width: <?php echo $les_groupes[2]->getAvancement(); ?>%;">
                                            <span class="avancement">
                                                <?php echo $les_groupes[2]->getAvancement(); ?>%
                                            </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-4">
                        <?php if (isset($les_groupes[0])) { ?>
                            <div class="no1">
                                <div class="title"><?php echo $les_groupes[0]->getLibelle(); ?></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow="<?php echo $les_groupes[0]->getAvancement(); ?>"
                                         aria-valuemin="0" aria-valuemax="100"
                                         style="width: <?php echo $les_groupes[0]->getAvancement(); ?>%;">
                                            <span class="avancement">
                                                <?php echo $les_groupes[0]->getAvancement(); ?>%
                                            </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-4 2eme">
                        <?php if (isset($les_groupes[1])) { ?>
                            <div class="no2">
                                <div class="title"><?php echo $les_groupes[1]->getLibelle(); ?></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow="<?php echo $les_groupes[1]->getAvancement(); ?>"
                                         aria-valuemin="0" aria-valuemax="100"
                                         style="width: <?php echo $les_groupes[1]->getAvancement(); ?>%;">
                                            <span class="avancement">
                                                <?php echo $les_groupes[1]->getAvancement(); ?>%
                                            </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
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
