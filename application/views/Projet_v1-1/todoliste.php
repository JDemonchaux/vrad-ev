
<div class="row-fluid">
	<h1 class="hcenter">
		<h1 class="hcenter">ToDO Liste de <?php echo $nomAffiche;?></h1>

	</h1>
	<?php //var_dump($tasks);?>
</div>
<br/>

<div class="container-fluid container">
	<div class="row"> 
		<div class="col-xs-1">Etat</div>
		<div class="col-xs-5">
			<div class="row">
				<div class="col-xs-4">Item</div>
				<div class="col-xs-1">Prio</div>
				<div class="col-xs-7">Task</div>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="row">
				<div class="col-xs-3">Heure Debut planifiée</div>
				<div class="col-xs-3">Heure Fin planifiée</div>
				<div class="col-xs-3">Heure Debut réelle</div>
				<div class="col-xs-3">Heure Fin réelle</div>
			</div>
		</div>
	</div>
	<?php 
	foreach ($les_taches as $tache) { 

		?>
		<div class="row"> 
			<div class="col-xs-1"> <?php echo $tache->displayIconeEtat();?> </div>
			<div class="col-xs-5">
				<div class="row">
					<div class="col-xs-4"><?php echo $tache->getItem()->getLibelle();?> </div>
					<div class="col-xs-4"><?php echo $tache->getItem()->getPriority();?> </div>
					<div class="col-xs-4"><?php echo $tache->getLibelle();?></div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-3"><?php echo $tache->getPlanning()->displayStartHourPlan("H:i");?></div>
					<div class="col-xs-3"><?php echo $tache->getPlanning()->displayEndHourPlan("H:i");?></div>
					<div class="col-xs-3">
						<?php 
						if(is_null($tache->getEtat())){ //pas commencée
							echo "Btn Start"; //$data['URL_start']."/".$tache->getId()
						} else{
							echo $tache->getPlanning()->displayStartHourReal("H:i");
						}
						
						?>
					</div>
					<div class="col-xs-3">
						<?php 
						if($tache->getEtat()==1 ){ //pas commencée
							echo "Btn Stop"; //$data['URL_stop']."/".$tache->getId()
						} else{
							echo $tache->getPlanning()->displayEndHourReal("H:i");
						}
						
						?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>


	</div>


</div>
