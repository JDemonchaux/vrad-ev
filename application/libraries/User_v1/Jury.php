<?php

/**
 * participant short summary.
 *
 * participant description.
 *
 * @version 1.0
 * @author Jérôme
 */
class Jury extends User
{
    private $ecole;
    private $specialite;
    private $serrialized_ecole;
    
    public function __construct($id = '', $prenom = '', $nom = '', $email = '', $password = '', $ecole = '', $specialite = '', $accountValid = FALSE) {
        $this->role="jury";
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


    public function serialize(){
        parent::serialize();
        $this->serrialized_ecole =  $this->ecole->getId().'|'.//0
                                    $this->ecole->getLibelle().'|'.//1
                                    $this->ecole->getVille().'|'; //2
    }

    public function unSerialize(){
        parent::unSerialize();
        $tab_ecole = explode('|', $this->serrialized_ecole);
        $this->ecole = new School($tab_ecole[0],$tab_ecole[1],$tab_ecole[2]);
    }
}
