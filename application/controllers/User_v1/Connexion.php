<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion extends CI_Controller { 

	public $module = "User";

	public function __construct() {
		parent::__construct();

		load_library("User");
		load_model("userModel");
		load_library('Tunnel','ToolBox');
	}

	public function index() {

	}

	public function login() {

		$data = array(
			'form_connexion_uri' => construct_full_url("Connexion", "verif_login"),
			'form_inscription_uri' => ""
			);
		load_view("form_login",$data);
	}

	public function verif_login() {

		$mon_user = new User($this->input->post('email'),
							 $this->input->post('password')
							 );

		try {
            $mon_user->login();
        }
        catch (Exception $ex) {
            //avant
            //go_and_show_message($ex->getMessage(), "User", "Connexion", "login");

        	// ou sinon
        	//j'envoie le message en session Flash
            set_user_message($ex->getMessage());
            //et parceque je le veux je redirige
            redirect(construct_full_url($controller, $action, $module));
        }

        //avant : dans tous les cas on passe à la suite
		//go_and_show_message("Connexion réussie!", "User", "Connexion", "suite_succes_login", "success", TRUE);

		// ou sinon : on continue
		set_user_message("Connexion réussie!", "success", TRUE);

		//mise a jour des méta données
		$this->metadata = new Meta("Connexion","","");

		$tunnel=new Tunnel('essay',false,false);
		$tunnel->addStep("Etape 1","pn1","action1","Controller1","Module_Dev");
		$tunnel->addStep("Etape 2","pn2","action2","Controller1","Module_Dev");
		$tunnel->addStep("Etape 3","pn3","action1","Controller2","Module_Dev");
		$tunnel->addStep("Etape 4","pn4","action1","Controller2","Module_Dev");
		$tunnel->addStep("Etape 5","pn5","login","Connexion","User");
		$tunnel->setCurentStep(2);

		$data = array("tunnel"=>$tunnel);
		load_view("login_ok",$data);

	}

	public function suite_succes_login(){
		load_view("login_ok");
	}
}