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

        if ($user->accountValid == 0) {
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
            // TODO : c'est la que ça chie pour le 403
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

    public function getMenu()
    {
        //TODO : ya un truc de pas bien la dedans! On se retrouve dans l'url avec /plaNNification au lieu de /plaNification
        // Ducoup le controller PlaNification merdouille au moment du load_view

        load_library('Rubrique', 'ToolBox');
        load_library('ItemRubrique', 'ToolBox');
        load_library('Link', 'ToolBox');


        //accès à tous les outils du controller
        $CI =& get_instance();


        $module_current = $CI->module; //$CI->router->directory;
        $controller_current = $CI->router->class;
        $action_current = $CI->router->method;

        $les_droits = $CI->config->item("droits");
        $acces = FALSE;

        $menu = array();
        $CI->lang->load('menu', "french");

        //Module
        while ($contolleur = current($les_droits)) {


            $module_name = key($les_droits);
            $droit_current = "";
            $name_rubrique = $CI->lang->line("menu_" . $module_name);

            //On initialise notre rubrique
            $rubrique = new Rubrique($name_rubrique, array());

            //Traitement des items du menu
            //Controler
            while ($action = current($contolleur)) {
                $contolleur_name = key($contolleur);
                $name_item = $CI->lang->line($contolleur_name);

                //Action
                while ($droit = current($action)) {
                    $action_name = key($action);
                    $acces = $this->demander_acces($module_name, $contolleur_name, $les_droits[$module_name][$contolleur_name][$action_name]);
                    if ($acces) {
                        if ($droit_current == $droit) {
                            //Menu deja initialisé

                            if ($contolleur_name == $controller_current && $action_name == $action_current) {
                                $item->setCurrent();
                            }
                        } else {
                            $droit_current = $droit;

                            $name_action = $CI->lang->line("menu_" . $module_name . "_" . $contolleur_name . "_" . $action_name);

                            //On initialise un Link
                            $link = new Link($action_name, $contolleur_name, $module_name);

                            //On initialise un item
                            $item = new ItemRubrique($name_action, $link);
                            if ($contolleur_name == $controller_current && $action_name == $action_current) {
                                $item->setCurrent();
                            }
                            //var_dump($item);
                            //echo "<hr>";
                            $rubrique->addItem($item);
                        }
                    }
                    next($action);
                }
                next($contolleur);
            }

            if (count($rubrique->getItem()) >= 1) {
                array_push($menu, $rubrique);
            }
            next($les_droits);
        }


        $data = array("menu" => $menu);


        return load_simple_view("menu", $data, "User");
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

    public function setRights($rights)
    {
        $this->rights = $rights;
    }

    public function getRights()
    {
        return $this->rights;
    }

    public function setUser($user)
    {
        $this->id = $user->getId();
        $this->prenom = $user->getPrenom();
        $this->nom = $user->getNom();
        $this->email = $user->getEmail();
        $this->password = ""; //par defaut on "effface" le mot de passe
        $this->rights = $user->getRights();
        $this->accountValid = $user->getAccountValid();
    }

}
