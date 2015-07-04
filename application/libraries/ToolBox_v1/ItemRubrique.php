<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class ItemRubrique {

	protected $name = "";
	
	protected $URL = array();
	
	protected $current = false;
	
	public function __construct($name= "",$URL = array()){
	
		$this->name = $name;
		$this->URL = $URL;
		$this->current = false;
	
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getURL()
	{
		return $this->URL;
	}
	
	public function setURL($URL)
	{
		$this->URL = $URL;
	}
	
	public function setCurrent()
	{
		$this->current = true;
	}
	
	public function isCurrent()
	{
		return $this->current;
	}
}