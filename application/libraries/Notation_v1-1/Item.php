<?php

/**
 *
 * Items du Barème de notation (niveau 2)
 * (Equivalant des specifications : EF, ENF)
 *
 * @version 1.0
 * @package Vrad-EV
 * @author Marie.Barbier.work@gmail.com
 * @copyright  MB&JD December 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');



class Item
{
	private  $idItem; //int
	private  $libelle; //String
	private  $description; //String
	private  $categorie; //Categorie Object
	private  $priority; // String (MoSCow)
	private  $coef; // int
	private  $type; //String : EF | ENF
	private  $livrable; // int : 0 ou 1 : BOOLEAN
	private  $notation; // Notation Object
	private  $niveau; //pour quels équipes

	public function __construct($idItem='',  $libelle='', $priority='', $coef='', $niveau='', $type='', $livrable='',  $description='', $categorie=NULL, $notation=NULL, $avancement=0) {
		load_library('Categorie','Notation');
		load_library('Notation','Notation');
		$this->idItem = $idItem;
		$this->libelle = $libelle;
		$this->description = $description;
		$this->priority = $priority;
		$this->coef = $coef;
		$this->type = $type;
		$this->livrable = $livrable;
		$this->niveau = $niveau;


		if(!isset($categorie)){
			$this->categorie = new Categorie();
		}else{
			$this->categorie = $categorie;
		}

		if(!isset($notation)){
			$this->notation = new Notation();
		}else{
			$this->notation = $notation;
		}

		$this->avancement = $avancement;

	}

	public function getIdItem(){
		return $this->idItem;
	}

	public function getLibelle(){
		return $this->libelle;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getPriority(){
		return $this->priority;
	}

	public function getCoef(){
		return $this->coef;
	}


	public function getNiveau() {
        return $this->niveau;
    }
    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

	public function getType(){
		return $this->type;
	}

	public function getLivrable(){
		return $this->livrable;
	}


	public function getCategorie(){
		return $this->categorie;
	}

	public function getNotation(){
		return $this->notation;
	}

	public function setIdItem($idItem){
		$this->idItem = $idItem;
	}

	public function setLibelle($libelle){
		$this->libelle = $libelle;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setPriority($priority){
		$this->priority = $priority;
	}

	public function setCoef($coef){
		$this->coef = $coef;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function setLivrable($livrable){
		$this->livrable = $livrable;
	}

	public function setCategorie($categorie){
		$this->categorie = $categorie;
	}

	public function setNotation($notation){
		$this->notation = $notation;
	}


	public function getAvancement(){
		return $this->avancement ;
	}

	public function setAvancement($avancement){
		$this->avancement = $avancement;
	}

	// seule les EF et les ENF livrables peuvent compter dans l'avancement
	public function displayAvancement(){
		if($this->livrable==0){
			$avancement = "N/A";
		}else{
			$avancement = $this->avancement." %";
		}
		return $avancement ;
	}

	//si item planifiable et avancement à 0 on ne peut pas noter
	public function isEvaluable(){
		if($this->avancement ==0 && $this->livrable==1){
			return FALSE;
		}
		return TRUE;
	}


}