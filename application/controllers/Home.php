<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $module = '';

    public function index()
    {
        $CI = get_instance();
        if ($CI->session->userdata("current_user") !== NULL) {
            redirect(construct_full_url("Resultats", "home", "Notation"));
        } else {
            redirect(construct_full_url("Connexion", "", "User"));
        }
    }
}
