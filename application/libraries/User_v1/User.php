<?php

/**
 * user short summary.
 *
 * user description.
 *
 * @version 1.0
 * @author Jérôme
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User {

    private $id;
    private $prenom;
    private $nom;
    private $email;
    private $password;
    private $accountValid;
    private $rights;

    public function __construct($email = '', $password = '', $prenom = '', $nom = '', $id = '') {
        $this->id = $id;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->rights = array();
        //Par défaut, on n'active pas le compte de l'utilisateur (fait via partie d'admin);
        $this->accountValid = FALSE;
    }

    public function getRight($controller, $action) {
        $allowAccess = false;
        if (array_key_exists($controller, $this->rights)) {
            if (array_key_exists($action, $this->rights[$controller])) {
                $allowAccess = $this->rights[$controller][$action];
            }
        }
        return $allowAccess;
    }

    public function login(){
        load_model("userModel");
        $CI = get_instance(); 
        $res = $CI->userModel->validerLogin($this->email, $this->password);

        if (empty($res)) {
            throw new Exception("Identifiants incorrects!", 1);
        }
        else {
            //TODO charger user complet avec ses droits et mettre en session
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getMail() {
        return $this->email;
    }

    public function setMail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $password = md5($password);
        $this->password = $password;
    }

    public function getAccountValid() {
        return $this->accountValid;
    }

    public function setAccountValid($bool) {
        $this->accountValid = $bool;
    }

}
