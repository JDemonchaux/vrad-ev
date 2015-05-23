<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resultats extends CI_Controller {

      public $module = "Notation";

      public function __construct(){
            parent::__construct();
            
            load_library("Classement");
            load_model("GroupModel","User");
      }

      public function index()
      {
            $this->home();
      }

      public function home()
      {
            $les_groupes = $this->GroupModel->readAllGroup();
            $this->classement = new Classement($les_groupes);
            $this->classement->calcul(Classement::$AVANCEMENT_ON);
            $this->classement->orderByAvancement();

            
            $data = array(
                  'les_groupes' => $this->classement->getLesGroupes(),
                  'heure' => null //TODO
                  );

            load_view("home",$data);

      }

      public function podium()
      {
            $les_groupes = $this->GroupModel->readAllGroup();
            $this->classement = new Classement($les_groupes);
            $this->classement->calcul(Classement::$AVANCEMENT_ON,Classement::$SCORE_ON);
            $this->classement->orderByScores();
            
            $data = array(
                  'les_groupes' => $this->classement->getLesGroupes(),
                  );

            load_view("podium",$data);

      }

      public function scores()
      {
            $les_groupes = $this->GroupModel->readAllGroup();
            $this->classement = new Classement($les_groupes);
            $this->classement->calcul(Classement::$AVANCEMENT_OFF,Classement::$SCORE_ON,Classement::$DETAIL_OFF,Classement::$DETAIL_ON);
            $this->classement->orderByScores();
            
            $data = array(
                  'les_groupes' => $this->classement->getLesGroupes(),
                  );

            load_view("scores",$data);

      }

}

