<?php

/**
 *
 * @version 1.0
 * @author Marie.Barbier.work@gmail.com
 */
class Classement
{

	private  $les_groupes; // Array of Group Object

	public static  $AVANCEMENT_ON = TRUE;
	public static  $AVANCEMENT_OFF = FALSE;
	public static  $SCORE_ON = TRUE;
	public static  $SCORE_OFF = FALSE;
	public static  $DETAIL_ON = TRUE;
	public static  $DETAIL_OFF = FALSE;

	public function __construct( $les_groupes=array()){
		$this->les_groupes = $les_groupes;
		$this->CI = get_instance(); 
		load_library("Group","User");
		load_model("TaskModel","Projet");
		load_model("ItemModel","Notation");

	}

	public function getLesGroupes(){
		return $this->les_groupes;
	}

	public function setLesGroupes($les_groupes){
		$this->les_groupes = $les_groupes;
	}

	/**
	* @author Jerome.Demonchaux@gmail.com
	*/
	public function orderByScores(){
//		$groupes_by_scores = array();
//		foreach ($this->les_groupes as $key => $groupe) {
//			$groupes_by_scores[$groupe->getScore()] = $groupe; //et si deux scores ex-equos???
//		}
		//$this->les_groupes = array_multisort($groupes_by_scores);//TODO à verif

		$les_groupes_tries = array();

		$count = 0;
		foreach($this->les_groupes as $groupe) {
			$les_groupes_tries[$count] = $groupe;
			$count++;
		}
		$taille = count($les_groupes_tries) - 1;

		for ($i = 0; $i < $taille; $i++) {
			for ($j = $taille-1; $j >= $i; $j--) {
				if($les_groupes_tries[$j+1]->getScore() > $les_groupes_tries[$j]->getScore())
				{
					$temp = $les_groupes_tries[$j+1];
					$les_groupes_tries[$j+1] = $les_groupes_tries[$j];
					$les_groupes_tries[$j] = $temp;
				}
			}
		}

		$this->les_groupes = $les_groupes_tries;

	}

	/**
	* @author Jerome.Demonchaux@gmail.com
	*/
	public function orderByMoyenne(){

		$les_groupes_tries = array();

		$count = 0;
		foreach($this->les_groupes as $groupe) {
			$les_groupes_tries[$count] = $groupe;
			$count++;
		}
		$taille = count($les_groupes_tries) - 1;

		for ($i = 0; $i < $taille; $i++) {
			for ($j = $taille-1; $j >= $i; $j--) {
				if($les_groupes_tries[$j+1]->getMoyenne() > $les_groupes_tries[$j]->getMoyenne())
				{
					$temp = $les_groupes_tries[$j+1];
					$les_groupes_tries[$j+1] = $les_groupes_tries[$j];
					$les_groupes_tries[$j] = $temp;
				}
			}
		}

		$this->les_groupes = $les_groupes_tries;

	}

	/**
	* @author Jerome.Demonchaux@gmail.com
	*/
	public function orderByAvancement(){
		$les_groupes_tries = array();

		$count = 0;
		foreach($this->les_groupes as $groupe) {
			$les_groupes_tries[$count] = $groupe;
			$count++;
		}
		$taille = count($les_groupes_tries) - 1;

		for ($i = 0; $i < $taille; $i++) {
			for ($j = $taille-1; $j >= $i; $j--) {
				if($les_groupes_tries[$j+1]->getAvancement() > $les_groupes_tries[$j]->getAvancement())
				{
					$temp = $les_groupes_tries[$j+1];
					$les_groupes_tries[$j+1] = $les_groupes_tries[$j];
					$les_groupes_tries[$j] = $temp;
				}
			}
		}

		$this->les_groupes = $les_groupes_tries;
	}

	public function orderByGroupesNames(){
		$groupes_by_id = array();
		foreach ($this->les_groupes as $key => $groupe) {
			$groupes_by_id[$groupe->getAvancement()] = $groupe;
		}
		//$this->les_groupes = array_multisort($groupes_by_id);//TODO a verif
	}

	/**
	* Une seule méthode pour limiter les boucles intempestives
	* with_total_avancement = pas de boucle
	* with_total_note = 1 boucle item
	* with_detail_avancement = 1 boucle item
	* with_detail_note = 2 boucles item
	* si with_total_note && with_detail_avancement --> 1 seule boucle item
	* si toutes les options à TRUE : alors que 2 boucles item
	* @author Marie.Barbier.work@gmail.com
	*/
	public function calcul($with_total_avancement,$with_total_note=FALSE,$with_detail_avancement=FALSE,$with_detail_note=FALSE)
	{
		//boucle groupe
		foreach ($this->les_groupes as $key => $groupe) {
			$avancement =0;
			$item_list = array();
			$item_full_list = array();
			$categ_lib='';
			$categs = array();
			$somme = 0;
			$totalMoyenne = 0;
			load_library("ManageEv","Projet");
			$manageEv = new ManageEv();

			$item_full_list = $this->CI->ItemModel->readAll();

			if($with_total_avancement){
				
			$task_list = $this->CI->TaskModel->readAllByGroup($groupe->getId());
			$list_item_H = $manageEv->getHDoHDoneFromListItem($task_list);
			$list_avancement_item = $manageEv->avancementItems($list_item_H,$item_full_list);
			$avancement = $manageEv->avancementProject($list_avancement_item);
			}

			/*
			echo "<pre>";
			var_dump($list_avancement_item);
			echo "</pre>";
			die;
			*/

			if($with_total_note || $with_detail_avancement || $with_detail_note){

				//préparation de la boucle 1
				
				if($with_total_note){
					$item_list_scored = $this->CI->ItemModel->readAllByGroup($groupe->getId());
					//$item_list = array_merge($item_full_list,$item_list_scored);//TODO à verif!!!
					foreach ($item_full_list as $id_item => $item) {
						if(isset ($item_list_scored[$id_item])){
							$item_list[$id_item]  = $item_list_scored[$id_item];
						}else{
							$item_list[$id_item] = $item;
						}
					}
				}else{
					$item_list = $item_full_list;
				}

				//boucle item 1
				foreach ($item_list as $id_item => $item) {
					
					//note totale
					if ($with_total_note){
						if($groupe->getNiveau() >= $item->getNiveau()){
							$totalMoyenne = $totalMoyenne + $item->getCoef();
							$somme = $somme + $item->getNotation()->getNote();
						}
					}

					//MAJ avancement item
					if($with_detail_avancement){
						if(isset($list_avancement_item[$id_item])){	
							$item->setAvancement($list_avancement_item[$id_item]);
							$item_list[$id_item] = $item;
						}
					}

					//calcul des points obtenus par categ
					if($with_detail_note){
						if($item->getCategorie()->getLibelle()!=$categ_lib){
							$categ_lib=$item->getCategorie()->getLibelle();
							$total = 0;
							$score = 0;
						}
						if($groupe->getNiveau() >= $item->getNiveau()){
						$total = $total + $item->getCoef();
						$score = $score + $item->getNotation()->getNote();
						}
						$item->getCategorie()->setScore($score);
						$item->getCategorie()->setCoef($total);

						//pour utilisation dans boucle 2
						$categs[$item->getCategorie()->getId()] = $item->getCategorie();
					}


				}
			}

			//boucle item 2
			if($with_detail_note){
				//MAJ des points obtenus par categ
				foreach ($item_list as $id_item => $item) {
					$item->setCategorie($categs[$item->getCategorie()->getId()]);
					$item_list[$id_item] = $item;
				}
			}
			
			
			$groupe->setScore($somme);
				if($totalMoyenne>0){
					$groupe->setMoyenne(round(($somme/$totalMoyenne)*20,2));
				}else{
					$groupe->setMoyenne(0);
				}

			$groupe->setAvancement($avancement);
			//MAJ de la liste
			if (isset($item_list)){
				$groupe->setResultats($item_list);
			}

	/*
			echo "<pre>";
			var_dump($groupe->getResultats());
			echo "</pre>";
			die;
			
*/
			$this->les_groupes[$key]=$groupe;

/*
			echo "<pre>";
			var_dump($this->les_groupes[$key]->getResultats());
			echo "</pre>";
			die;
			*/

		}

	}

	



}