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

    public function __construct($id = '', $prenom = '', $nom = '', $email = '', $password = '') {
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
            $this->id = $res->pk_usr;
            $this->prenom = $res->prenom;
            $this->nom = $res->nom;
            $this->accountValid = $res->usr_account_valid;

            if($this->accountValid==0){
                throw new Exception("Votre compte n'a pas encore été activé", 1);
            }

            //récup des droits
            $this->rights = $CI->userModel->getDroits($res->role);
            //Mise en session
            $CI->session->set_userdata("curent_user",$this);

        }
    }

    public function logoff(){
        $CI->session->unset_userdata("curent_user");
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

    public function getRights(){
        return $this->rights;
    }

}
