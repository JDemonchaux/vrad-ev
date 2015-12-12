<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Evaluation extends CI_Controller {

      public $module = "Notation";

    
      public function __construct(){
            parent::__construct();
            
            load_library("Classement");
            load_model("ItemModel");
            load_model("GroupModel","User");
      }

      public function index()
      {
            $this->harmonisation();
      }

      public function harmonisation()
      {
      		//charger les notes par groupes pour pré-remplir le formulaire
      	$les_groupes = $this->GroupModel->readAllGroup();
            $this->classement = new Classement($les_groupes);
            $this->classement->calcul(Classement::$AVANCEMENT_ON,Classement::$SCORE_ON,Classement::$DETAIL_ON);
            $this->classement->orderByGroupesNames();

            //envoie au formulaire
            $data = array(
                  'les_groupes' => $this->classement->getLesGroupes(),
                  'les_items' => $this->ItemModel->readAll(),
                  'only_one' => FALSE,
                  'action' => "url"
                  );

            load_view("form_notation",$data);
      }

      //ou pas en Ajax ca serait bien... non?
       public function harmonisation_action()
      {
      		$list_item = $this->ItemModel->readAll();
      		//traitement du formulaire
      		foreach ($les_groupes as $id_groupe) {
      			saveResultOneGroup($id_groupe,$list_item);
      		}
      }

      public function noterGroupe($id_groupe)
      {
      	//charger les notes du groupe pour pré-remplir le formulaire
      	$groupe = $this->GroupModel->readOneGroup($id_groupe);
      	$les_groupes = array($id_groupe => $groupe);
            $this->classement = new Classement($les_groupes);
            $this->classement->calcul(Classement::$AVANCEMENT_ON,Classement::$SCORE_ON,Classement::$DETAIL_ON,Classement::$DETAIL_ON);

            //envoie au formulaire
            $data = array(
                  'les_groupes' => $this->classement->getLesGroupes(),
                  'id_groupe' => $id_groupe,
                  'les_items' => $this->ItemModel->readAll(),
                  'only_one' => TRUE,
                  'action' => "url"
                  );

            load_view("form_notation",$data);

	}

		//ou pas en Ajax ca serait bien... non?
	public function noterGroupe_action()
      {
			$list_item = $this->ItemModel->readAll();
			saveResultOneGroup($id_groupe,$list_item,TRUE);

      }

      private function saveResultOneGroup($id_groupe,$list_item,$detail=FALSE){
      		$groupe = new Group($id_groupe);
      		$result = $list_item;
      		foreach ($result as $idItem => $item) {
      			$item->getNotation()->setNote = $note;//todo recup la note au format : $name = "N_g_".$group->getId()."|i_".$id_item."";
      			if($detail){
      				$item->getNotation()->setCommentaire = $commentaire; // todo recup le comment au format : $name = "C_g_".$group->getId()."|i_".$id_item."";
      			}
      		}
      		$groupe->setResulats($result);
			$this->GroupModel->saveNotes($groupe);
      }



}
