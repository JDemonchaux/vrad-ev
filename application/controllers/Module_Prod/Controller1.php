<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller1 extends CI_Controller {

	private $module = "Module_Prod";
    
    public function __construct() {
        parent::__construct();
        
        //TODO : ici placer les chargement de libraries et modeles utiles à ce controller
        //surtout pas de autoload à cause du fonctionnement par module
        //on a donc un "comme un autoload" dans le constructeur pour chacunes de ses actions
        //pour la gestion des versions on utilise le loadHelper
        /*load_library($this->module, "group");
        load_library($this->module, "jury");
        load_library($this->module, "member");
        load_library($this->module, "grade");
        load_library($this->module, "school");
        
        load_model($this->module, "userModel");
        load_model($this->module, "groupModel");
        load_model($this->module, "gradeModel");
        load_model($this->module, "schoolModel");*/
    }

	public function index()
	{
		echo "index-controller1";
	}

	public function action1()
	{
		echo "action1-controller1";
        $config_version = $this->config->item('versions');
        $module_full_name = get_module_versioned_name($config_version,$this->module);
        echo $module_full_name;
        echo "<bR>";
        echo $this->uri->uri_string();
	}

	public function action2()
	{
		echo "action2-controller1";
	}
}
