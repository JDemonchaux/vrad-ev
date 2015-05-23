<?php

/**
 * Classe de calcul de l'avancement selon le modèle de la gestion par la valeur aquise
 *
 * manageEV description.
 *
 * @version 1.0
 * @author Marie
 */
class ManageEV
{
	/**
	* calcul de l'avancemet par tache, règle 0-100%
	* @param $listItemHDoHDone
	*	$listItemHDoHDone["idItem"]
	*	$listItemHDoHDone["idItem"]["idTask"]
	*	$listItemHDoHDone["idItem"]["idTask"]["hDo"]
	*	$listItemHDoHDone["idItem"]["idTask"]["hDone"]
	*	$listItemHDoHDone["idItem"]["idTask"]["raf"] = 0;
	* @return $avancementItem["idItem"] = av%;
	*/
	public function avancementItems(array $listItemHDoHDone){
		//$avancementItems = new array();
		/*
			
		*/
		foreach ($listItemHDoHDone as $idItem => $tasks) {
			$sumDo = 0;
			$sumDone = 0;
			foreach ($tasks as $idTask => $data) {
				$sumDo = $sumDo + $data["hDo"];
				// règle d'avancemen 0-100% : on ne prend en compte l'avancement que quand le raf vaux zéro
				if($data["raf"] == 0){
					$sumDone = $sumDone + $data["hDo"];
				}
			}
			if($sumDo>0){
				$av = round((($sumDone/$sumDo)*100));
			}else{
				$av = 0;
			}
			$avancementItems[$idItem] = $av;
		}
		return $avancementItems;
	}

	/**
	* calcul de l'avancement du projet par item
	* @param $avancementItem["idItem"] = av%;
	* @return av%;
	*/
	public function avancementProject(array $avancementItems){
		$avancement = 0;
		$total = 0;
		foreach ($avancementItems as $idItem => $value) {
			$avancement = $avancement + $value;
			$total = $total + 100;
		}
		if($total>0){
			return round(($avancement/$total)*100);
		}else{
			return 0;
		}
	}

	/**
	* Calcul les intervals en heure des taches et indique le RAF
	* @param $listTask $listTask["idIask"] = $objTask;
	* @return $listItemHDoHDone
	*	$listItemHDoHDone["idItem"]
	*	$listItemHDoHDone["idItem"]["idTask"]
	*	$listItemHDoHDone["idItem"]["idTask"]["hDo"]
	*	$listItemHDoHDone["idItem"]["idTask"]["hDone"]
	*	$listItemHDoHDone["idItem"]["idTask"]["raf"] = 0;
	*/
	public function getHDoHDoneFromListItem(array $listTask){
		$listItemHDoHDone = array();
		load_library('Task');

		foreach ($listTask as $idTask => $objTask) {
			if(!$objTasj->getIsNp()){
				$listItemHDoHDone[$objTask->getItem()->getIdItem()][$idTask]["hDo"] = $objTasj->getPlanning()->getHoursToDo();
				$listItemHDoHDone[$objTask->getItem()->getIdItem()][$idTask]["hDone"] = $objTasj->getPlanning()->getHoursDone();
				$listItemHDoHDone[$objTask->getItem()->getIdItem()][$idTask]["raf"] = $objTasj->getPlanning()->getRAF();
			}

		}
		return $listItemHDoHDone;

	}
}
