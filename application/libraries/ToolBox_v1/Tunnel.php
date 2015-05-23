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


class Tunnel {

	/**
	* nom du tunnel
	*/
	private $name = "tunnel";
	/**
	* Liste des étapes du tunnel
	*/
	private $steps = array();
	/**
	* indique si l'on peut cliquer sur les liens suivant du tunnel
	*/
	private $navigable = FALSE;
	/**
	* indique si l'on peut cliquer sur les liens précédent du tunnel
	*/
	private $backwardable = FALSE;

	private $curentStep = NULL;

	public function __construct($name="tunnel",$navigable=FALSE,$backwardable=FALSE){
		load_library('TunnelStep','ToolBox');
		$this->name = $name;
		$this->backwardable = $backwardable;
		$this->navigable = $navigable;

	}

	/**
	* 
	**/
	public function addStep($full_name,$short_name,$action,$controller,$module_name){
		$number=sizeof($this->steps);
		$this->steps[$number] = new TunnelStep ($number,$full_name,$short_name,
												$action,$controller,$module_name);
	}

	public function display(){
		$data = array("tunnel"=>$this);
		load_simple_view("tunnel", $data, "ToolBox");
	}

	public function is_navigable(){
		return $this->navigable;
	}

	public function is_backwardable(){
		return $this->backwardable;
	}

	/**
	*
	*/
	public function setCurentStep($number){
		$this->curentStep = $number;
	}

	public function getCurentStep(){
		return $this->curentStep;
	}

	public function getName(){
		return $this->name;
	}

	public function getSteps(){
		return $this->steps;
	}
}

/* End of file Tunnel.php */
/* Location: ./system/application/libraries/ToolBox/Tunnel.php */