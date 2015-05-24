<span class="input-group-addon" id="input-group-ecole"><i class="glyphicon glyphicon-education"></i></span>
<select class="form-control" aria-describedby="input-group-ecole" name="ecole">
    <option disabled="disabled"></option>
    <?php
    foreach ($lesEcoles as $school)
    {
        echo '<option value="'.$school->getId().'">'.$school->getLibelle().'</option>';
    }
    
    ?>
</select>
<div class="input-group-btn">
    <div class="input-group-btn">
        <button type="button" class="btn btn-default" id="ajouterEcole" data-toogle="modal" data-target="#modalAjouterGroupe">
            Nouvelle
        </button>
    </div>
</div>