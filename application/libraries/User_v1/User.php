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

    private $id;
    private $prenom;
    private $nom;
    private $email;
    private $password;
    private $accountValid;
    private $rights;

    public function __construct($email = '', $password = '', $id = '', $prenom = '', $nom = '')
    {
        $this->id = $id;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = md5($password);
        $this->rights = array();
        //Par défaut, on n'active pas le compte de l'utilisateur (fait via partie d'admin);
        $this->accountValid = FALSE;
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
        $res = $CI->userModel->validerLogin($this->email, $this->password);
        if (empty($res)) {
            throw new Exception($this->password, 1);
        } else {
            $this->id = $res->pk_usr;
            $this->prenom = $res->usr_name;
            $this->nom = $res->usr_firstname;
            $this->accountValid = $res->usr_account_valid;
            if ($this->accountValid == 0) {
                throw new Exception("Votre compte n'a pas encore été activé", 1);
            }

            //récup des droits

            $this->rights = $CI->userModel->getDroits($res->usr_role);

            //Mise en session
            $CI->session->set_userdata("current_user", $this);

        }
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

}
