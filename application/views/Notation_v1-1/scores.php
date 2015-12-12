<?php
//lignes pour chaque item (dont entete de catégorie)
	$prev_categorie="";



echo " <table><th> </th>";
foreach ($les_groupes as $id_group => $group) {			
					echo " <th>";
					echo "<div class='col-sm-2'><img src='".base_url()."assets/img/empty.jpg' class='img-responsive'/></div>";
					echo "<br>".$group->getLibelle();
					echo "<br>".$group->getScore()."/200";
					echo "</th>";
		}// fin for group


	foreach ($les_items as $id_item => $item) {

		//ligne pour une nouvelle catégorie
		if($item->getCategorie()->getLibelle() != $prev_categorie){
			echo "<tr class='background-color:".$item->getCategorie()->getHexaColor()."'>";
			echo "<th>".$item->getCategorie()->getLibelle();
			echo "</th>";
			$prev_categorie = $item->getCategorie()->getLibelle();


		
		foreach ($les_groupes as $id_group => $group) {
			
			//mise à jour des infos de l'item avec les résultat du groupe
			if(isset ($group->getResultats()[$id_item])){
				$item_group = $group->getResultats()[$id_item];
			}else{
				$item_group = $item;
			}

			
					echo " <td>".$item_group->getCategorie()->getScore()."/".$item_group->getCategorie()->getCoef()."</td>";
		}// fin for group
		echo "</tr>";
			
	}//fin if
	// Pas de ligne pour l'item
}//fin for
echo "<table>"

?>