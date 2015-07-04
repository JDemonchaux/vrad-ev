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

class User
{

    protected $id;
    protected $prenom;
    protected $nom;
    protected $email;
    protected $password;
    protected $accountValid;
    protected $rights;

    public function __construct($email = '', $password = '', $id = '', $prenom = '', $nom = '', $accountValid = FALSE)
    {
        $this->id = $id;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = md5($password);
        $this->rights = array();
        $this->accountValid = $accountValid;
    }

    public function getRight($controller, $action)
    {
        $allowAccess = false;
        if (array_key_exists($controller, $this->rights)) {
            if (array_key_exists($action, $this->rights[$controller])) {
                $allowAccess = $this->rights[$controller][$action];
            }
        }
        return $allowAccess;
    }

    public function login() 
    {
        load_model("userModel");

        $CI = get_instance();
        $user = $CI->userModel->validerLogin($this->email, $this->password);
        
        if ($this->accountValid == 0) {
            throw new Exception("Votre compte n'a pas encore été activé", 1);
        }

        //Mise en session
        $CI->session->set_userdata("current_user", $user);

    }

    public function logoff()
    {
        $CI = get_instance();
        $CI->session->unset_userdata("current_user");
    }

    public function demander_acces($module, $controller, $action_droit)
    {
        if (!isset($this->rights[$module][$controller])) {
            //module/controller non definit pour l'utilisateur = pas de droit
            $acces = FALSE;
        } else {
            //BitBashing : &logic entre la valeur de action demandé et les droit utilisateur pour ce controller
            if ($this->rights[$module][$controller] & $action_droit) {

                $acces = TRUE;
            } else {
                $acces = FALSE;
            }
        }
        return $acces;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getMail()
    {
        return $this->email;
    }

    public function setMail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $password = md5($password);
        $this->password = $password;
    }

    public function getAccountValid()
    {
        return $this->accountValid;
    }

    public function setAccountValid($bool)
    {
        $this->accountValid = $bool;
    }

    public function getRights()
    {
        return $this->rights;
    }

    public function setUser($user){
        $this->id = $user->getId();
        $this->prenom = $user->getPrenom();
        $this->nom = $user->getNom();
        $this->email = $user->getEmail();
        $this->password = ""; //par defaut on "effface" le mot de passe
        $this->rights = $user->getRights();
        $this->accountValid = $user->getAccountValid();
    }

}
