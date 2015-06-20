<div class="col-sm-9">
    <div class="row-fluid">
        <h1 class="hcenter">
            R&eacute;sultat d'Avancement - il
            est <?php $dt = new DateTime("now", new DateTimeZone('Europe/Paris')); echo $dt->format('H') . "h" . $dt->format('i');?>
        </h1>
    </div>
    <br/>

    <div class="container-fluid container">


        <?php
        var_dump($les_groupes);
        ?>
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


