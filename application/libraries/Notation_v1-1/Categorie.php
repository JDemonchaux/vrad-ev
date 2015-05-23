<?php

/**
 *
 * @version 1.0
 * @author Marie
 */
class Categorie
{
	private  $id;
	private  $libelle;
	private  $description;
	private  $score;
	private  $coef;

public function __construct( $idCategorie='',  $libelle='',  $description='') {
	$this->idCategorie = $idCategorie;
	$this->libelle = $libelle;
	$this->description = $description;
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


}