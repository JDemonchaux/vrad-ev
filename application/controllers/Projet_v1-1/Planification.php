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
    public function gantt()
    {
        // On récupère le groupe de l'utilisateur connecté
        $user = $this->session->current_user;
        $data['groupe'] = $user->getGroup();

        load_view("gantt");
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