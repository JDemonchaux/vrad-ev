<?php

/**
 * participant short summary.
 *
 * participant description.
 *
 * @version 1.0
 * @author Jérôme
 */
class Jury extends user
{
    private $ecole;
    private $specialite;
    
    public function __construct($id = '', $prenom = '', $nom = '', $email = '', $password = '', $ecole = '', $specialite = '', $accountValid = FALSE) {
        parent::__construct($email, $password,$id, $prenom, $nom,$accountValid);
        $this->ecole = $ecole;
        $this->specialite = $specialite;
    }
    
    public function getEcole() {
        return $this->ecole;
    }
    public function setEcole($ecole) {
        $this->ecole = $ecole;
    }
    
    public function getSpecialite() {
        return $this->specialite;
    }
    public function setSpecialite($specialite) {
        $this->specialite = $specialite;
    }
}
