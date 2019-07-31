<?php

/**
 * school short summary.
 *
 * school description.
 *
 * @version 1.0
 * @author Jérôme
 */
class School
{
    private $id;
    private $libelle;
    private $ville;
    
    public function __construct($id = '', $libelle = '', $ville = '') {
        $this->id =$id;
        $this->libelle = $libelle;
        $this->ville = $ville;
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
    
    public function getVille() {
        return $this->ville;
    }
    public function setVille($ville) {
        $this->ville = $ville;
    }

    
    
}
