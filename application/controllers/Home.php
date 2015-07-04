<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $module = '';

    public function index()
    {
        $CI = get_instance();
        if ($CI->session->userdata("current_user") !== NULL) {
            $link = new Link ("Resultats", "home", "Notation");
            redirect($link->getURL());
        } else {
            $link = new Link ("Connexion", "", "User");
            redirect($link->getURL());
        }
    }
}
