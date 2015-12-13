<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation extends CI_Controller {

  public $module = "Notation";


  public function __construct(){
    parent::__construct();

    load_library("Classement");
    load_model("ItemModel");
    load_model("GroupModel","User");
  }

    /**
     * Service A :
     * KJIHGFEDCBA
     * 00000000001 => 1
     */
    public function index()
    {
      $this->harmonisation();
    }

    /**
     * Service A :
     * KJIHGFEDCBA
     * 00000000001 => 1
     */
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
      'action' => new Link("harmonisation_action", "Evaluation")
      );

     load_view("form_notation",$data);
   }

    /**
     * Service A :
     * KJIHGFEDCBA
     * 00000000001 => 1
     */
      //ou pas en Ajax ca serait bien... non? --> oui mais plus tard alors !
    public function harmonisation_action()
    {
      $list_item = $this->ItemModel->readAll();
      $les_groupes = $this->GroupModel->readAllGroup();
      foreach ($les_groupes as $id_groupe => $groupe) {
       $this->saveResultOneGroup($id_groupe,$list_item,TRUE);
     }
     $url = new Link("harmonisation", "Evaluation");
     redirect($url->getURL());
   }

    /**
     * Service B :
     * KJIHGFEDCBA
     * 00000000010 => 2
     */
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
      'action' => new Link("noterGroupe_action", "Evaluation")
      );

     load_view("form_notation",$data);

   }

    /**
     * Service B :
     * KJIHGFEDCBA
     * 00000000010 => 2
     */
		//ou pas en Ajax ca serait bien... non? --> oui mais plus tard alors !
    public function noterGroupe_action()
    {
     $list_item = $this->ItemModel->readAll();
     $this->saveResultOneGroup($_POST["id_groupe"],$list_item,TRUE);
     $url = new Link("noterGroupe/".$_POST["id_groupe"], "Evaluation");
     redirect($url->getURL());

   }



// --- PRIVATE ---------------------------------------------------------------------

// attention si detail pas a true alors comme annuel et remplace on perds les commentaires...
   private function saveResultOneGroup($id_groupe,$list_item,$detail=FALSE){
    $groupe = new Group($id_groupe);
    $result = array();
    foreach ($list_item as $idItem => $item) {
     $name = "g".$groupe->getId()."-i".$idItem."";
     $N_name = "N_".$name;
            //gestion des DISABLED

     if(isset($_POST["$N_name"])){
      $item->getNotation()->setNote($_POST["$N_name"]);
      if($detail){
        $C_name = "C_".$name;
        $item->getNotation()->setCommentaire($_POST["$C_name"]);
      }
      $result[$idItem] = $item;
    }
  }

  $groupe->setResultats($result);
  $this->GroupModel->saveNotes($groupe);
}



}
