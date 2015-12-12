<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
  * Controller orienté Ressources
  * Gestion des droits selon le modèle ZYXWVLRSMEC sur 11 bits
  */
  class Tache extends CI_Controller {

      public $module = "Planning";

      /**
      * Fonction 1 : Création (C)
      * ZYXWVLRSMEC
      * 00000000001 => 1
      */
      public function creer()
      {

      }
      public function creer_action()
      {
          $nom = $_POST["nom"];
          $ressource = $_POST['ressource'];
          $item = $_POST["item"];
          $heure_debut = new DateTime($_POST["heure_debut"]);
          $heure_fin = new DateTime($_POST["heure_fin"]);

          $tache = new Task("", $nom, "", $item, "", $ressource);
          $tache->setFirstPlanning($heure_debut, $heure_fin);

          try {
            $this->TaskModel->create($tache);
      } catch (Exception $e) {
            set_user_message($e->getMessage());
      }

      $url = new Link("gantt", "Planification");
      redirect($url->getURL());
}


      /**
      * Fonction 2 : Edition (E)
      * ZYXWVLRSMEC
      * 00000000010 => 2
      */
      public function editer()
      {
      	
      }
      
      /**
      * Fonction 3 : Modification (M)
      * ZYXWVLRSMEC
      * 00000000100 => 4
      */
      public function modifier()
      {
      	
      }
      public function modifier_action()
      {
       $ressource = $_POST['ressource'];
       $item = $_POST["item"];
       $tache = new Task($idTache, "", "", $item, "", $ressource);
       if (true) {
            $tache->setFirstPlanning(new DateTime($_POST["heure_debut"]), new DateTime($_POST["heure_fin"]));
      }


      try {
            $this->TaskModel->update($tache);
      } catch (Exception $e) {
            set_user_message($e->getMessage());
      }

      $url = new Link("gantt", "Planification");
      redirect($url->getURL());
}

      /**
      * Fonction 4 : Supression (S)
      * ZYXWVLRSMEC
      * 00000001000 => 8
      */
      public function supprimer_action()
      {
            try {
                  $this->TaskModel->delete($idTache);
            } catch (Exception $e) {
                  set_user_message($e->getMessage());
            }

            $url = new Link("gantt", "Planification");
            redirect($url->getURL());
      }

      /**
      * Fonction 5 : Recherche (R)
      * ZYXWVLRSMEC
      * 00000010000 => 16
      */
      public function rechercher()
      {

      }
      public function rechercher_action()
      {

      }

      /**
      * Fonction 6 : Listing (L)
      * ZYXWVLRSMEC
      * 00000100000 => 32
      */
      public function lister()
      {

      }

      /**
      * Fonction 7 : Voir Détail (V)
      * ZYXWVLRSMEC
      * 00001000000 => 64
      */
      public function voir_detail()
      {

      }

      /**
      * Fonction 8 : Voir Détail Autre forma (W)
      * ZYXWVLRSMEC
      * 00010000000 => 128
      * le nom est à définir et le libellé est a associer dans lang_droit
      */    
      public function voir_detail_autre()
      {

      }

      /**
      * Fonction 9 : fonction personalisable 1 (X)
      * ZYXWVLRSMEC
      * 00100000000 => 256
      * le nom est à définir et le libellé est a associer dans lang_droit
      */    
      public function start_tache($idTache)
      {
        //

          $url = new Link("todoListe", "Planification");
          redirect($url->getURL());
    }

      /**
      * Fonction 10 : fonction personalisable 2 (Y)
      * ZYXWVLRSMEC
      * 01000000000 => 512
      * le nom est à définir et le libellé est a associer dans lang_droit
      */    
      public function startTache($idTache)
      {
        //

          $url = new Link("todoListe", "Planification");
          redirect($url->getURL());
    }

      /**
      * Fonction 11 : fonction personalisable 3 (Z)
      * ZYXWVLRSMEC
      * 10000000000 => 1024
      * le nom est à définir et le libellé est a associer dans lang_droit
      */    
      public function fonction_perso_Z()
      {

      }


}