<?php

/**
 * participant short summary.
 *
 * participant description.
 *
 * @version 1.0
 * @author Jérôme
 */
class Member extends User
{
    private $groupe;
    private $classe;
    
    public function __construct($id = '', $prenom = '', $nom = '', $email = '', $password = '', $accountValid = FALSE, Group $groupe = NULL, Grade $classe = NULL) {
        parent::__construct($email, $password,$id, $prenom, $nom,$accountValid);
        $this->groupe = $groupe;
        $this->classe = $classe;
    
    }

    public function login() {
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
