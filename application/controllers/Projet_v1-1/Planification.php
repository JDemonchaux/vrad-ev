<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller orienté Service
 * Gestion des droits sans modèle sur 11 bits
 * par ordre de fréquence d'utilisation
 */
class Planification extends CI_Controller
{

    public $module = "Projet";

    public function __construct()
    {
        parent::__construct();
        load_library("Notation", "Notation");
        load_library("Categorie", "Notation");
        load_library("Item", "Notation");
        load_library("Task", "Projet");
        load_library("Classement", "Notation");

        load_model("UserModel", "User");
        load_model("GroupModel", "User");
        load_model("ItemModel", "Notation");
        load_model("TaskModel", "Projet");
    }

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
    public function gantt($id_group = 1)
    {
        // On récupère le groupe de l'utilisateur connecté  si c'est un member, si c'est un jury...
        $user = $_SESSION['current_user'];
        if ($user->getRole() == "membre") {
            $data['groupe'] = $user->getGroupe();
        } else {
            $data['groupe'] = $this->GroupModel->readOneGroup($id_group);
        }

        $this->classement = new Classement( array($data['groupe']->getId() => $data['groupe']) );
        $this->classement->calcul(Classement::$AVANCEMENT_ON,Classement::$SCORE_OFF,Classement::$DETAIL_OFF,Classement::$DETAIL_OFF);
        $data['groupe'] = $this->classement->getLesGroupes()[$id_group];


        $data['ressources'] = $this->UserModel->getMembres($data['groupe']->getId());
        $data['items'] = $this->ItemModel->readAll();
        $data['form_ajout_tache'] = new Link("creer_action", "Tache");
        $data['form_modif_tache'] = new Link("modifier_action", "Tache");
        $data['form_suppr_tache'] = new Link("supprimer_action", "Tache");
        $data['taches'] = $this->TaskModel->readAllByGroup($data['groupe']->getId());
        load_view("gantt", $data);
    }

    /**
     * Service B :
     * KJIHGFEDCBA
     * 00000000010 => 2
     */
    public function todoListe()
    {
        $data = array();
        $user = $_SESSION['current_user'];
        $data['nomAffiche'] = $user->getPrenom() . " " . $user->getNom();
        $data['les_taches'] = $this->TaskModel->readAllByUser($user->getId());
        $data['URL_start'] = new Link("start", "Tache");;
        $data['URL_stop'] = new Link("stop", "Tache");;

        load_view("todoliste", $data);
    }


}