<?php

/**
 *
 * Categorisation des items du Barème de notation (niveau 1)
 * (Equivalant des activités de projet)
 *
 * @version 1.0
 * @package Vrad-EV
 * @author Marie.Barbier.work@gmail.com
 * @copyright  MB&JD December 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');



class Categorie
{
	private  $id; //int
	private  $libelle; //String
	private  $description; //String
	private  $score; //int
	private  $coef; //int
	private  $hexaColor; //String ex : #FF0000

public function __construct( $idCategorie='',  $libelle='',  $description='', $hexaColor="") {
	$this->idCategorie = $idCategorie;
	$this->libelle = $libelle;
	$this->description = $description;
	$this->hexaColor = $hexaColor;
	$this->score = 0;
	$this->coef = 0;

}

public function getId(){
	return $this->idCategorie;
}

public function getLibelle(){
	return $this->libelle;
}

public function getDescription(){
	return $this->description;
}

public function getScore(){
	return $this->score;
}

public function getCoef(){
	return $this->coef;
}


public function getHexaColor(){
	return $this->hexaColor;
}

public function setId($idCategorie){
	$this->idCategorie = $idCategorie;
}

public function setLibelle($libelle){
	$this->libelle = $libelle;
}

public function setDescription($description){
	$this->description = $description;
}

public function setScore($score){
	$this->score = $score;
}

public function setCoef($coef){
	$this->coef = $coef;
}

public function setHexaColor($hexaColor){
	$this->hexaColor = $hexaColor;
}




}