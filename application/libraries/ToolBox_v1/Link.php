<?php
/**
 * Classe de construction des URL
 * 
 *
 * @package customCI-by-MB&JD
 * @author  Marie.Barbier.work@gmail.com
 * @copyright  MB&JD April 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Link {

    /**
    * nom du module
    */
    protected $module_name ="";
    /**
    * version du module
    */
    protected $module_version = 0;
    /**
    * nom du module avec ou sans la version selon la configuration de l'environement
    */
    protected $module_route_name = "";
    /**
    * nom du module avec la version
    */
    protected $module_full_name ="";
    /*
    * nom du controller visé
    */
    protected $controller ="";
    /**
    * nom de l'action visée
    */
    protected $action ="";
    /**
    * array liste des segments de l'url
    */
    protected $url_segments = array();
    /**
    * URL complete et absolue
    */
    protected $url ="";
    /**
    * url relative
    */
    protected $link ="";

    public function __construct($action="",$controller="",$module_name=""){
		if(empty($action)&&empty($controller)){
            //appel depuis l'autoload au contructeur vide --> on passe
        }else{

            $this->CI =& get_instance();
    		//par defaut, on utilise le module courrant
            if($module_name===""){
                $this->module_name = $this->CI->module; 
            }else{
            	$this->module_name = $module_name; 
            }

            $this->module_version = $this->CI->config->item('versions')[$this->module_name]['v'];

            //les modules ne sont pas toujours sufixé par leur version selon l'environement d'exectution
            $this->module_route_name = get_module_route_name($this->CI->config->item('versions'),$this->module_name);
            $this->module_full_name = get_module_versioned_name($this->CI->config->item('versions'),$this->module_name);

            $this->controller = $controller;
            $this->action = $action;

    		$this->url_segments = array($this->module_route_name,$this->controller,$this->action);

            $this->link = implode("/",$this->url_segments);

            $this->url = $this->CI->config->site_url($this->link);

        }

    }

    public function getModuleName(){
    	return $this->module_name;
    }

    public function getModuleVersion(){
    	return $this->module_version;
    }

    public function getModuleRouteName(){
    	return $this->module_route_name;
    }

    public function getModuleFullName(){
    	return $this->module_full_name;
    }

    public function getController(){
    	return $this->controller;
    }

    public function getAction(){
    	return $this->action;
    }

    public function getActionName(){
        return $this->CI->lang->line("menu_".$this->action);
    }

    public function getURL(){
    	return $this->url;
    }

    public function getLink(){
    	return $this->link;
    }

}
/* End of file link.php */
/* Location: ./system/application/libraries/ToolBox/link.php */