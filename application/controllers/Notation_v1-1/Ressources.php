<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Ressources extends CI_Controller {

      public $module = "Notation";

      public function __construct(){
            parent::__construct();
            
            load_model("ItemModel","Notation");

      }

      public function listeItem()
      {
            $data["les_items"] = $this->ItemModel->readAll();
            load_view("liste_item", $data);
      }

      public function importerItem()
      {
            //TODO, fait en bdd directeement pour l'instant 
            //avec le fichier xsl qui gènere le script sql
      }

      public function diffuserResultats(){
            //TODO, fait en bdd directeement pour l'instant
      }

      public function validerInscriptions(){
             //TODO, fait en bdd directeement pour l'instant
      }
}
