<div class="col-sm-9">
    <div class="row-fluid">
        <h1 class="hcenter">
            R&eacute;sultat d'Avancement - il
            est <?php echo $heure; ?>
        </h1>
    </div>
    <br/>

    <div class="container-fluid container">
        <?php foreach ($les_groupes as $groupe) { ?>
            <div class="row vertical-center">
                <div class="col-sm-2 image">
                    <?php echo img_url("ecoles/".$groupe->getEcole()->getId().".png", "Logo de l'école", "img-responsive");?>
                </div>
                <div class="col-sm-2">
                    <?php echo $groupe->getLibelle(); ?>
                </div>
                <div class="col-sm-4">
                    <div class="progress">
                        <div class="progress-bar vert" role="progressbar" aria-valuenow="<?php echo $groupe->getAvancement() ;?>" aria-valuemin="0"
                             aria-valuemax="100" style="width: <?php echo $groupe->getAvancement(); ?>%;">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <?php echo $groupe->getAvancement(); ?> %
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="col-sm-3">
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


