<?php

	if($only_one){
		$group = $les_groupes[$id_groupe];
		echo "<h1>".$group->getLibelle()." - ".$group->getAvancement()."% - ".$group->getScore()."/200 </h1>";
	}

	//début du formulaire
	echo "<form action='$action' method='post'>";
		echo "<input type='submit' value='Valider'/>";

	//début de la grille de notation
	echo "<table>";
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
			echo "<th colspan='3'>";
			echo $group->getLibelle();
			echo "</th>";
		}
		$nb_columns = $nb_columns + sizeof($les_groupes)*3;
	}
	echo "</tr>";

	//lignes pour chaque item (dont entete de catégorie)
	$prev_categorie="";
	foreach ($les_items as $id_item => $item) {

		//ligne pour une nouvelle catégorie
		if($item->getCategorie()->getLibelle() != $prev_categorie){
			echo "<tr>";
			echo "<th colspan='$nb_columns'>".$item->getCategorie()->getLibelle();
			if($only_one){
					//affichage du score du groupe pour la categ
					$key=array_keys($les_groupes);
					$item_group = $les_groupes[$key[0]]->getResultats()[$id_item];
					echo " (".$item_group->getCategorie()->getScore()."/".$item_group->getCategorie()->getCoef().")";
				}
			echo "</th></tr>";
			$prev_categorie = $item->getCategorie()->getLibelle();
		}

		//ligne pour l'item
		echo "<tr>";
		echo "<td colspan='2'>".$item->getLibelle()."</td>";
		
		foreach ($les_groupes as $id_group => $group) {
			
			//mise à jour des infos de l'item avec les résultat du groupe
			if(isset ($group->getResultats()[$id_item])){
				$item_group = $group->getResultats()[$id_item];
			}else{
				$item_group = $item;
			}
		
		


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
			echo "<input class='form-control'  type='text' size ='3' name='N_$name' value='$val'  $disable />";
			echo "</td>";
			echo "<td>&nbsp;/&nbsp;".$item_group->getCoef()."</td>";

			//commentaire
			if($only_one){
				echo "<td colspan='2'> ";
				echo "<textarea class='form-control' size ='20' name='C_$name'  $disable />$valcom</textarea>";
				echo "</td>";	
			}else{
				echo "<td><input type='hidden'  name='C_$name'  value='$valcom' /></td>";
			}
			
		}
		echo "</tr>"; //fin ligne et fin boucle
	}
	echo "</table>";
	echo "<input type='submit' value='Valider'/>";
	echo "</form >";
?>