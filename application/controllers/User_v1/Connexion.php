<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Connexion extends CI_Controller
{

    public $module = "User";

    public function __construct()
    {
        parent::__construct();

        load_library("User");
        load_library("ImageResizer", "ToolBox");
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {

		$connexion_uri = new Link ("Connexion", "verif_login");
		$inscriptionMembre_uri = new Link ("Inscription", "membre");
		$inscriptionJury_uri = new Link ("Inscription", "jury");

		$data = array(
			'form_connexion_uri' => $connexion_uri->getURL(),
			'form_inscriptionMembre_uri' => $inscriptionMembre_uri->getURL(),
			'form_inscriptionJury_uri' => $inscriptionJury_uri->getURL()
			);

        // r�cup�ration des sponsors dans les assets
        $imageResizer = new imageResizer();
        $data['images'] = $imageResizer->getSponsors();
        load_view("form_login", $data);
    }

    public function verif_login()
    {

        $mon_user = new User('', '', '', $this->input->post('email'),
            $this->input->post('password')
        );
        try {
            $mon_user->login();

			$link = new Link ("Resultats", "home", "Notation");
			redirect($link->getURL());

		} catch (Exception $ex) {
			set_user_message($ex->getMessage());
			$link = new Link ("Connexion", "login", "User");
			redirect($link->getURL());
		}

    }

    public function logout()
    {
        $this->session->userdata("current_user")->logoff();
        redirect(base_url());
    }

}