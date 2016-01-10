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
    private $niveau;
    private $avancement;
    private $score; //note totale
    private $resultats; //liste d'Items avec leur notation
    
    public function __construct($id = '', $libelle = '', $ecole = '', $niveau = '', $avancement = '',$score = "", $resultats = "") {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->ecole = $ecole;
        $this->avancement = $avancement;
        $this->score = $score;
        $this->moyenne = 0;
        $this->resultats = $resultats;
        $this->niveau = $niveau;
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

    public function getNiveau() {
        return $this->niveau;
    }
    public function setNiveau($niveau) {
        $this->niveau = $niveau;
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

    //score rammené sur 20 en fonction du niveau
    public function getMoyenne(){
        return $this->moyenne;
    }

    public function setMoyenne($moyenne){
         $this->moyenne = $moyenne;
    }

    public function getResultats(){
        return $this->resultats;
    }

    public function setResultats($resultats){
        $this->resultats = $resultats;
    }
}
