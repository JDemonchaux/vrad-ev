<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Rubrique {

	protected $name = "";
	
	protected $item_rubrique = array();
	
	public function __construct( $name = "",$item = array() ){
	
		$this->name = $name;
		$this->item_rubrique = $item;
	
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getItem()
	{
		return $this->item_rubrique;
	}
	
	/*
		Permet l'ajout d'un tableau d'item 
	*/
	public function setItem($item)
	{
		$this->item_rubrique = $item;
	}
	
	/*
		Permet l'ajout d'un item dans la liste (à la fin)
	*/
	public function addItem($un_item)
	{
		array_push($this->item_rubrique,$un_item);
	}
}