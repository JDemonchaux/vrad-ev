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
        $data['ressources'] = $this->UserModel->getMembres($data['groupe']->getId());
        $data['items'] = $this->ItemModel->readAll();
        $data['form_ajout_tache'] = new Link("ajouterTache", "Planification");
        $data['form_modif_tache'] = new Link("modifierTache", "Planification");
        $data['form_suppr_tache'] = new Link("supprimerTache", "Planification");
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


    /**
     * Service C :
     * KJIHGFEDCBA
     * 00000000100 => 4
     */
    public function ajouterTache()
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
     * Service D :
     * KJIHGFEDCBA
     * 00000001000 => 8
     */
    public function modifierTache($idTache)
    {
        $ressource = new User('', '', $_POST['ressource']);
        $item = new Item($_POST["item"]);
        $tache = new Task($idTache, "", "", $item, "", $ressource);

        $dd = $_POST["heure_debut"];
        $mdd = substr($dd, 0, 2);
        $mdf = substr($dd, 3, 2);
        $df = $_POST["heure_fin"];
        $mfd = substr($df, 0, 2);
        $mff = substr($df, 3, 2);
        $date_debut = new DateTime($_POST["heure_debut"]);
        $date_fin = new DateTime($_POST["heure_fin"]);

        if (date('H') > 0 && date('H') <= 8) {
            if ($mdd >= 20 && $mdd < 24) {
                $date_debut->setDate(date('Y'), date('m'), date('d') - 1);
                $date_debut->setTime($mdd, $mdf);
            }
            if ($mfd >= 20 && $mfd < 24) {
                $date_fin->setDate(date('Y'), date('m'), date('d') - 1);
                $date_fin->setTime($mfd, $mff);
            }
        }
        elseif (date('H') >= 20 && date('H') < 24) {
            if ($mdd >= 0 && $mdd < 8) {
                $date_debut->setDate(date('Y'), date('m'), date('d') + 1);
                $date_debut->setTime($mdd, $mdf);
            }
            if ($mfd >= 0 && $mfd < 8) {
                $date_fin->setDate(date('Y'), date('m'), date('d') + 1);
                $date_fin->setTime($mfd, $mff);
            }
        }

        $tache->setFirstPlanning($date_debut,$date_fin);


        try {
            $this->TaskModel->update($tache);
        } catch (Exception $e) {
            set_user_message($e->getMessage());
        }

        $url = new Link("gantt", "Planification");
        redirect($url->getURL());
    }

    /**
     * Service E :
     * KJIHGFEDCBA
     * 00000010000 => 16
     */
    public function supprimerTache($idTache)
    {
        try {
            $this->TaskModel->delete($idTache);
        } catch (Exception $e) {
            set_user_message($e->getMessage());
        }

        $url = new Link("gantt", "Planification");
        redirect($url->getURL());
    }


}