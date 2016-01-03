<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Ressources extends CI_Controller {

      public $module = "Notation";

      public function __construct(){
            parent::__construct();
            
            load_model("ItemModel");

      }

      public function listeItem()
      {
            var_dump($this->ItemModel->readAll());
      }

      public function importerItem()
      {
            
      }

      public function diffuserResultats(){

      }

      public function validerInscriptions(){
            
      }
}
