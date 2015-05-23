<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Tests_ManageEV extends CI_Controller {

      public $module = "Planning";

      public function index()
      {
      	$this->load->library('unit_test');

      	$this->testPlanification();
    	
      	//$this->testManageEVavancementItems();

      	//$this->testManageAvancementProjects();

            $data = array("report"=>$this->unit->report());
            load_view("report",$data,"Tests");
      }

      private function testPlanification(){
      	load_library('Schedule');
      	
      	$dateDebutPlan = new DateTime();
      	$dateDebutPlan->setDate(2015,01,23);
      	$dateDebutPlan->setTime(20,00);

      	$dateFinPlan = new DateTime();
      	$dateFinPlan->setDate(2015,01,23);
      	$dateFinPlan->setTime(22,00);

      	$dateDebutReel = new DateTime();
      	$dateDebutReel->setDate(2015,01,23);
      	$dateDebutReel->setTime(20,15);

      	$dateFinReel = new DateTime();
      	$dateFinReel->setDate(2015,01,23);
      	$dateFinReel->setTime(21,45);
    

	$planif = new Schedule($dateDebutPlan,$dateFinPlan,$dateDebutReel,$dateFinReel);
      	$oraclePlan = 2;
      	$resultPlan = $planif->getHoursToDo();
      	$this->unit->run( $resultPlan , $oraclePlan , "Planif 1 - Plan," , "Plan same day : oracle = $oraclePlan > res = $resultPlan");
      	$oracleReel = 1.5;
      	$resultReel = $planif->getHoursDone();
      	$this->unit->run( $resultReel , $oracleReel , "Planif 1 - Real" , "Real same day : oracle = $oracleReel > res = $resultReel");


      	$dateDebutPlan = new DateTime();
      	$dateDebutPlan->setDate(2015,01,23);
      	$dateDebutPlan->setTime(23,00);

      	$dateFinPlan = new DateTime();
      	$dateFinPlan->setDate(2015,01,24);
      	$dateFinPlan->setTime(1,00);

      	$dateDebutReel = new DateTime();
      	$dateDebutReel->setDate(2015,01,23);
      	$dateDebutReel->setTime(23,15);

      	$dateFinReel = new DateTime();
      	$dateFinReel->setDate(2015,01,24);
      	$dateFinReel->setTime(0,45);
    

	$planif = new Schedule($dateDebutPlan,$dateFinPlan,$dateDebutReel,$dateFinReel);
      	$oraclePlan = 2;
      	$resultPlan = $planif->getHoursToDo();
      	$this->unit->run( $resultPlan , $oraclePlan , "Planif 2 - Plan," , "Plan NO same day : oracle = $oraclePlan > res = $resultPlan");
      	$oracleReel = 1.5;
      	$resultReel = $planif->getHoursDone();
      	$this->unit->run( $resultReel , $oracleReel , "Planif 2 - Real" , "Real NO same day : oracle = $oracleReel > res = $resultReel");
      }

      private function testManageEVavancementItems(){

      	load_library('ManageEV');
      	$mangeEV = new ManageEV();

      	/*
      	Exemple planification item 2 : tache 1 : 2h, tache 2 : 2h tache 3 : 1h. la tâche 1 est terminée, la tache 2 est en cours, la tache 3 n’est pas encore commencée. Soit au total 2h de terminé sur 5h au total : 2/5 = 40%. 
      	Dans tous les cas, la charge utilisée pour le calcul est la charge planifiée et non la charge utilisée. Que la tache 1 est pris en réalité 1h et demie ou 2h et demie, on utilisera sa charge planifiée de 2h pour le calcul de l’avancement. De plus les taches identifiées comme « non planifiées en initiale » (NP) ne doivent pas être prises en compte dans le calcul.
      	*/

		//$listItemHDoHDone[] = new array();


		$listItemHDoHDone[2][1]["hDo"] = 2;
		$listItemHDoHDone[2][1]["hDone"] = 2.5;
		$listItemHDoHDone[2][1]["raf"] = 0;

		$listItemHDoHDone[2][2]["hDo"] = 2;
		$listItemHDoHDone[2][2]["hDone"] = 1;
		$listItemHDoHDone[2][2]["raf"] = 1;

		$listItemHDoHDone[2][3]["hDo"] = 1;
		$listItemHDoHDone[2][3]["hDone"] = 0;
		$listItemHDoHDone[2][3]["raf"] = 1;


      	//$avancementItemsOracle = new  array();
      	$avancementItemsOracle[2] = 40;

      	$result = $mangeEV->avancementItems($listItemHDoHDone) ;
      	$this->unit->run( $result , $avancementItemsOracle , "avancementItems - 1" , "1 item");

      }

      private function testManageAvancementProjects(){

            load_library('ManageEV');
      	$mangeEV = new ManageEV();

      	/*
      	Exemple : item1 80% ; item 2 : 40% ; item 3 : 20% item 4 et item 5 : 0%
		soit 140/500 = 28% d’avancement
		*/

		$avancementItems[1] = 80;
		$avancementItems[2] = 40;
		$avancementItems[3] = 20;
		$avancementItems[4] = 0;
		$avancementItems[5] = 0;

		$oracle = 28;

      	$result = $mangeEV->avancementProject($avancementItems) ;

      	$this->unit->run( $result , $oracle , "avancementProjet - 1" , "5 items : 140/500 = 28 > $result");

      	$avancementItems[1] = 80;
		$avancementItems[2] = 40;
		$avancementItems[3] = 22;
		$avancementItems[4] = 0;
		$avancementItems[5] = 0;

		$oracle = 28;

      	$result = $mangeEV->avancementProject($avancementItems) ;

      	$this->unit->run( $result , $oracle , "avancementProjet - 1" , "5 items : 142/500 = 28,4 : 28 > $result");

      	$avancementItems[1] = 80;
		$avancementItems[2] = 40;
		$avancementItems[3] = 24;
		$avancementItems[4] = 0;
		$avancementItems[5] = 0;

		$oracle = 29;

      	$result = $mangeEV->avancementProject($avancementItems) ;

      	$this->unit->run( $result , $oracle , "avancementProjet - 1" , "5 items : 148/500 = 28,8 : 29 > $result");

      }

	}