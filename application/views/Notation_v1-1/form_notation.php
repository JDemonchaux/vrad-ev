<?php

	if($only_one){
		$group = $les_groupes[$id_groupe];
		echo "<h1>".$group->getLibelle()." - ".$group->getAvancement()."% - ".$group->getScore()."/200 </h1>";
	}

	//début du formulaire
	echo "<form action='$action' method='post'>";
		echo "<input type='submit' value='Valider'/>";

	//début de la grille de notation
	echo "<table >";
	echo "<tr>";
	echo "<th colspan='2'>Categorie / Item</th>";
	$nb_columns = 2 ;

	if($only_one){
		//entete pour 1 groupe
		echo "<th>Progression</th>";

		echo "<th colspan='2'>";
		echo "Note";
		echo "</th>";

		echo "<th colspan='2'>";
		echo "Commentaire";
		echo "</th>";

		$nb_columns = $nb_columns + 5;
	}else{
		//entete pour chaque groupe
		foreach ($les_groupes as $id_group => $group) {
			echo "<th colspan='2'>";
			echo $group->getLibelle();
			echo "</th>";
		}
		$nb_columns = $nb_columns + sizeof($les_groupes)*2;
	}
	echo "</tr>";

	//lignes pour chaque item (dont entete de catégorie)
	$categorie="";
	foreach ($les_items as $id_item => $item) {
		
		foreach ($les_groupes as $id_group => $group) {
			
			//mise à jour des infos de l'item avec les résultat du groupe
			if(isset ($group->getResultats()[$id_item])){
				$item_group = $group->getResultats()[$id_item];
			}else{
				$item_group = $item;
			}
		
		//ligne pour la catégorie
		if($item_group->getCategorie()->getLibelle() != $categorie){
			echo "<tr>";
			echo "<th colspan='$nb_columns'>".$item_group->getCategorie()->getLibelle().
					" (".$item_group->getCategorie()->getScore()."/".$item_group->getCategorie()->getCoef().")</td>";
			echo "</tr>";
			$categorie = $item_group->getCategorie()->getLibelle();
		}

		//ligne pour l'item
		echo "<tr>";
		echo "<td colspan='2'>".$item_group->getLibelle()."</td>";


			//affichage de l'avancement pour l'item
			if($only_one){
				if($item_group->getLivrable()==0){
					echo "<td >"."N/A"."</td>";
				}else{
					echo "<td >".$item->getAvancement()."%</td>";
				}
			}

			//si item planifiable et avancement à 0 on ne peut pas noter
			$disable = "";
			if($item_group->getAvancement()==0 && $item_group->getLivrable()==1){
				$disable = "DISABLED";
			}

			//Construction du formulaire avec les saisies précédentes
			$val = $item_group->getNotation()->getNote();
			$valcom = $item_group->getNotation()->getCommentaire();
			$name = "g_".$group->getId()."|i_".$id_item."";

			//note
			echo "<td>";
			echo "<input class='form-control'  type='text' size ='3' name='n_$name' value='$val'  $disable />";
			echo "</td>";
			echo "<td>&nbsp;/&nbsp;".$item_group->getCoef()."</td>";

			//commentaire
			if($only_one){
				echo "<td colspan='2'> ";
				echo "<textarea class='form-control' size ='20' name='c_$name'  $disable />$valcom</textarea>";
				echo "</td>";	
			}else{
				echo "<input type='hidden'  name='c_$name'  value='$valcom' />";
			}
			
		}
		echo "</tr>"; //fin ligne et fin boucle
	}
	echo "</table>";
	echo "<input type='submit' value='Valider'/>";
	echo "</form >";
?>