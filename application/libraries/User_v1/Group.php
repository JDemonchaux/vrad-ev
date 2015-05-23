<?php

/**
 * groupe short summary.
 *
 * groupe description.
 *
 * @version 1.0
 * @author Jérôme
 */
class Group
{
    private $id;
    private $libelle;
    private $ecole;
    private $avancement;
    private $score; //note totale
    private $resultats; //liste d'Items avec leur notation
    
    public function __construct($id = '', $libelle = '', $ecole = '') {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->ecole = $ecole;
    }
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getLibelle() {
        return $this->libelle;
    }
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    
    public function getEcole() {
        return $this->ecole;
    }
    public function setEcole($ecole) {
        $this->ecole = $ecole;
    }

    public function getAvancement(){
        return $this->avancement ;
    }

    public function setAvancement($avancement){
        $this->avancement = $avancement;
    }

    public function getScore(){
        return $this->score;
    }

    public function setScore($score){
         $this->score = $score;
    }

    public function getResultats(){
        return $this->resultats;
    }

    public function setResultats($resultats){
        $this->resultats = $resultats;
    }
}
