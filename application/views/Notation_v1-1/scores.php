<div class="row-fluid">
	<h1 class="hcenter">Détail des Scores</h1>
</div>

<div class="container-fluid container">
	<div class="row"> 
		<div class="col-xs-3"></div>
		<?php foreach ($les_groupes as $id_group => $group) {			 ?>
		<div class="col-xs-1"> 
			<div class="row"><img src='<?php echo base_url();?>assets/img/empty.jpg' class='img-responsive'/></div>
			<div class="row">
				<h6 class="hcenter"><?php echo $group->getLibelle()?><br/><span><?php echo $group->getScore();?> / 200</span></h6>
			</div>			
		</div>
		<?php	}// fin for group ?>
	</div>
	<?php
	//lignes pour chaque item (dont entete de catégorie)
	$prev_categorie="";
	foreach ($les_items as $id_item => $item) {
		if($item->getCategorie()->getLibelle() != $prev_categorie){
			$prev_categorie = $item->getCategorie()->getLibelle();
			?>
			<div class="row" style='background-color:<?php echo $item->getCategorie()->getHexaColor();?>'> 
				<div class="col-xs-3" >
					<h4><?php echo $item->getCategorie()->getLibelle();?></h4>
				</div>
		
		<?php // pas de fin  de categ  car on affiche que ca

		foreach ($les_groupes as $id_group => $group) {

			//mise à jour des infos de l'item avec les résultat du groupe
			if(isset ($group->getResultats()[$id_item])){
				$item_group = $group->getResultats()[$id_item];
			}else{
				$item_group = $item;
			}

			?>

		
				<div class="col-xs-1 hcenter"> 
					<?php echo $item_group->getCategorie()->getScore();?> / <?php echo $item_group->getCategorie()->getCoef();?>
				</div>		
	

			<?php
			}//fin groupes
			?>
					</div><!-- fin div row --><?php
	}//fin if de categ
	// Pas de ligne pour l'item
}//fin for item

?>