<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resultats extends CI_Controller
{

    public $module = "Notation";
    public $classement;

    public function __construct()
    {
        parent::__construct();

        load_library("Classement");
        load_library("School", "User");
        load_model("GroupModel", "User");
        load_library("ImageResizer", "ToolBox");
    }

    public function index()
    {
        $this->home();
    }

    public function home()
    {
        $imageResizer = new imageResizer();

        $les_groupes = $this->GroupModel->readAllGroupSchool();
        $this->classement = new Classement($les_groupes);
        $this->classement->calcul(Classement::$AVANCEMENT_ON);
        $this->classement->orderByAvancement();

        // Determination de l'heure en cours
        $dt = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $heure = $dt->format('H') . "h" . $dt->format('i');

        $data = array(
            'images' => $data['images'] = $imageResizer->getSponsors(),
            'les_groupes' => $this->classement->getLesGroupes(),
            'heure' => $heure
        );

        load_view("home", $data);

    }

    public function podium()
    {
        $les_groupes = $this->GroupModel->readAllGroup();
        $this->classement = new Classement($les_groupes);
        $this->classement->calcul(Classement::$AVANCEMENT_ON, Classement::$SCORE_ON);
        $this->classement->orderByScores();

        $data = array(
            'les_groupes' => $this->classement->getLesGroupes(),
        );

        load_view("podium", $data);

    }

    public function scores()
    {
        $les_groupes = $this->GroupModel->readAllGroup();
        $this->classement = new Classement($les_groupes);
        $this->classement->calcul(Classement::$AVANCEMENT_OFF, Classement::$SCORE_ON, Classement::$DETAIL_OFF, Classement::$DETAIL_ON);
        $this->classement->orderByScores();

        $data = array(
            'les_groupes' => $this->classement->getLesGroupes(),
        );

        load_view("scores", $data);

    }

}

