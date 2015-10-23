<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $module = 'home';

    public function index()
    {
        $CI = get_instance();
        if (isset($_SESSION['current_user'])) {
            $link = new Link ("home", "Resultats", "Notation");
            redirect($link->getURL());
        } else {
            $link = new Link ("index", "Connexion",  "User");
            redirect($link->getURL());
        }
    }
}
