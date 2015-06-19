<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion extends CI_Controller { 

	public $module = "User";

	public function __construct() {
		parent::__construct();

		load_library("User");
		load_library("ImageResizer", "ToolBox");
	}

	public function index() {
		$this->login();
	}

	public function login() {

		$data = array(
			'form_connexion_uri' => construct_full_url("Connexion", "verif_login"),
			'form_inscriptionMembre_uri' => construct_full_url("Inscription", "membre"),
			'form_inscriptionJury_uri' => construct_full_url("Inscription", "jury")
			);

		// r�cup�ration des sponsors dans les assets
		$imageResizer = new imageResizer();
		$data['images'] = $imageResizer->getSponsors(); 
		
		load_view("form_login",$data);
	}

	public function verif_login() {

		$mon_user = new User($this->input->post('email'),
			$this->input->post('password')
			);

		try {
			$mon_user->login();
			redirect(construct_full_url("Resultats", "home", "Notation"));

		} catch (Exception $ex) {
			set_user_message($ex->getMessage());
			redirect(construct_full_url("Connexion", "login", "User"));
		}

       // TODO : chargé la home, quand elle sera faite
       // load_view("form_login",$data);

	}

}