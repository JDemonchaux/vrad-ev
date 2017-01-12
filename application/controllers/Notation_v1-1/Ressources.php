<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Ressources extends CI_Controller {

      public $module = "Notation";

      public function __construct(){
            parent::__construct();

      }

    /**
     * Service A :
     * KJIHGFEDCBA
     * 00000000001 => 1
     */
      public function listeItem()
      {
            load_model("ItemModel","Notation");
            $data["les_items"] = $this->ItemModel->readAll();
            load_view("liste_item", $data);
      }

    /**
     * Service B :
     * KJIHGFEDCBA
     * 00000000010 => 2
     */
      public function importerItem()
      {
            //TODO, fait en bdd directeement pour l'instant 
            //avec le fichier xsl qui gènere le script sql
            $data["message"] = "Merci d'utiliser le fichier XSL qui génère le script SQL a importer en base";
            load_view("no_view", $data);
      }

    /**
     * Service C :
     * KJIHGFEDCBA
     * 00000000100 => 4
     */
      public function validerInscriptions(){
        $valideAccount_uri = new Link ("validerInscriptions_action", "Ressources");
        $data = array(
            'form_valideAccount_uri' => $valideAccount_uri->getURL(),
        );

             load_model("UserModel","User");
             $data["les_users"] = $this->UserModel->readAll(); 
             load_view("liste_user", $data);
      }

          /**
     * Service C :
     * KJIHGFEDCBA
     * 00000000100 => 4
     */
      public function validerInscriptions_action(){
        //do action
            load_model("UserModel","User");
            $les_users = $this->UserModel->readAll(); 
            foreach ($les_users as $id_user => $user) {
                  if(isset($_POST["CBvalid_$id_user"])) {
                        $user->setAccountValid(1);
                  }else{
                       $user->setAccountValid(0); 
                  }
                  $this->UserModel->update($user);
            }

        // relaod : 
        $this->validerInscriptions();
      }


    /**
     * Service D :
     * KJIHGFEDCBA
     * 00000001000 => 8
     */
      public function diffuserResultats(){
            $diffuserResultats_uri = new Link ("diffuserResultats_action", "Ressources");
              $data = array(
                  'form_diffuserResultats_uri' => $diffuserResultats_uri->getURL(),
              );

              if($this->is_PodiumActif()){
                  $data["message"] = "Les membres ont actuellement acces au podium";
            }else{
                  $data["message"] = "Les membres n'ont pas encore acces au podium";
            }
             
            
            load_view("set_resultats", $data);
      }

//todo créer un controller rien que pour gestion podim qui irai faire la requete une seule fois dans le constructeur ??
      // avec droit actuel et droit voir resultat en attribut
      private function is_PodiumActif(){
             //chech if resultat sont actif chez membres, sinon changer la valeur bitbach avec un && ??
              load_model("RightModel","User");
              $droitActuel = $this->RightModel->getSpecificDroits("Notation","Resultats","membre");
var_dump($droitActuel);
              $droitVoirResultat = $this->config->item('droits')["Notation"]['Resultats']["podium"];
var_dump($droitVoirResultat);
              //BitBashing : &logic entre la valeur de action demandé et les droit utilisateur pour ce controller
            if ($droitVoirResultat & $droitActuel) {

            return TRUE;
                
            } else {
                return FALSE;
               
            }
      }

    /**
     * Service D :
     * KJIHGFEDCBA
     * 00000001000 => 8
     */
      public function diffuserResultats_action(){
        //do action
                      load_model("RightModel","User");
              $droitActuel = $this->RightModel->getSpecificDroits("Notation","Resultats","membre");

              $droitVoirResultat = $this->config->item('droits')["Notation"]['Resultats']["podium"];

         if($this->is_PodiumActif()){
                  // deactiver le droit
                  $nouveauDroit = $droitVoirResultat ^ $droitActuel ; // ou exclusif logic (pour desactiver si actif!)
            }else{
                 // activer le droit 
                  $nouveauDroit =  $droitActuel | $droitVoirResultat ; // ou logic (pour activer)
            }
            //todo : changer pour un update de l'objet right (mais pour l'instant les droits sont gérés en tableau...)
            $this->RightModel->setSpecificDroits("Notation","Resultats","membre",decbin($nouveauDroit));

        // relaod : 
        $this->diffuserResultats();
      }

      
}
