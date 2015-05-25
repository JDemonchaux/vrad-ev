<?php

/**
 * participant short summary.
 *
 * participant description.
 *
 * @version 1.0
 * @author Jérôme
 */
class Member extends user
{
    private $groupe;
    private $classe;
    
    public function __construct($id = '', $prenom = '', $nom = '', $email = '', $password = '', Group $groupe = NULL, Grade $classe = NULL) {
        parent::__construct($email, $password,$id, $prenom, $nom);
        $this->groupe = $groupe;
        $this->classe = $classe;
    
    }
    
    public function getGroupe() {
        return $this->groupe;
    }
    public function setGroupe($groupe) {
        $this->groupe = $groupe;
    }
    
    public function getClasse() {
        return $this->classe;
    }
    public function setClasse($classe) {
        $this->classe = $classe;
    }
}
