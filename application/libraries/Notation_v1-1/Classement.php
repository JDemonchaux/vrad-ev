<?php

/**
 *
 * @version 1.0
 * @author Marie
 */
class Classement
{

	private  $les_groupes;
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
		load_model("ItemModel");

	}

	public function getLesGroupes(){
		return $this->les_groupes;
	}

	public function setLesGroupes($les_groupes){
		$this->les_groupes = $les_groupes;
	}

	public function orderByScores(){
		$groupes_by_scores = array();
		foreach ($this->les_groupes as $key => $groupe) {
			$groupes_by_scores[$groupe->getScore()] = $groupe; //et si deux scores ex-equos???
		}
		//$this->les_groupes = array_multisort($groupes_by_scores);//TODO a verif
	}

	public function orderByAvancement(){
		$groupes_by_avancement = array();
		foreach ($this->les_groupes as $key => $groupe) {
			$groupes_by_avancement[$groupe->getAvancement()] = $groupe; //et si deux av ex-equos???
		}
		//$this->les_groupes = array_multisort($groupes_by_avancement);//TODO a verif
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
			load_library("ManageEv","Projet");
			$manageEv = new ManageEv();


			if($with_total_avancement){
				$task_list = $this->CI->TaskModel->readAllByGroup($groupe->getId());
				$list_item_H = $manageEv->getHDoHDoneFromListItem($task_list);
				$list_avancement_item = $manageEv->avancementItems($list_item_H);
				$avancement = $manageEv->avancementProject($list_avancement_item);
			}

			if($with_total_note || $with_detail_avancement || $with_detail_note){

				//préparation de la boucle 1
				$item_full_list = $this->CI->ItemModel->readAll();
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
						$somme = $somme + $item->getNotation()->getNote();
					}

					//MAJ avancement item
					if($with_detail_avancement){
						if(isset($list_avancement_item[$id_item])){	
							$item->setAvancement($list_avancement_item[$id_item]);
							$item_list[$id_item] = $item;
						}
					}

					//calcul des points obtenus pas categ
					if($with_detail_note){
						if($item->getCategorie()->getLibelle()!=$categ_lib){
							$categ_lib=$item->getCategorie()->getLibelle();
							$total = 0;
							$score = 0;
						}
						$total = $total + $item->getCoef();
						$score = $score + $item->getNotation()->getNote();
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
			$groupe->setAvancement($avancement);
			if (isset($item_list)){
				$groupe->setResultats($item_list);
			}

			$this->les_groupes[$key]=$groupe;
		}

	}

	



}