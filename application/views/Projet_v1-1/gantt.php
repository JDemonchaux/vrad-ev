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

    </div>
</div>