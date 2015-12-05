<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller orienté Service
 * Gestion des droits sans modèle sur 11 bits
 * par ordre de fréquence d'utilisation
 */
class Planification extends CI_Controller
{

    public $module = "Projet";

    /**
     * NOT TODO ! : ne jamais utiliser la fonction index :
     * toujours spécifier l'action par defaut dans route
     * sinon la gestion des droit ne peux être résolue
     */
    //public function index(){
    //      $this->gantt();
    //}

    /**
     * Service A :
     * KJIHGFEDCBA
     * 00000000001 => 1
     */
    public function gantt($id_group=1)
    {
        // On récupère le groupe de l'utilisateur connecté  si c'est un member, si c'est un jury...
        $user = $_SESSION['current_user'];
        if($user->getRole()=="membre"){
            $data['groupe'] = $user->getGroupe();
        }else{
            if(!isset($id_group)){$id_group=1;}//toto a enlever lorsque le menu proposera de choisir le groupe à consulter pour le jury
            $data['groupe']=$id_group;
        }

        load_view("gantt", $data);
    }

    /**
     * Service B :
     * KJIHGFEDCBA
     * 00000000010 => 2
     */
    public function todoListe()
    {

    }
}