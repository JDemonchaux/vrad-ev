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
load_library('Link','ToolBox');

class TunnelStep extends Link {

		private $full_name = "";
		private $short_name = "";
		private $number = "";

		public function __construct($number=0,$full_name="",$short_name="",$action="",$controller="",$module_name=""){
				parent::__construct($action,$controller,$module_name);
				$this->full_name = $full_name;
				$this->short_name = $short_name;
				$this->number = $number;
		}

		public function getNumber(){
			return $this->number;
		}

		public function getName(){
			return $this->full_name;
		}

		public function getShortName(){
			return $this->short_name;
		}

	}

/* End of file Tunnel.php */
/* Location: ./system/application/libraries/ToolBox/Tunnel.php */
