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
    private $serrialized_groupe;
    private $serrialized_classe;
    
    public function __construct($id = '', $prenom = '', $nom = '', $email = '', $password = '', Group $groupe = NULL, Grade $classe = NULL, $accountValid = FALSE) {
        $this->role="membre";
        parent::__construct($email, $password,$id, $prenom, $nom,$accountValid);
        $this->groupe = $groupe;
        $this->classe = $classe;
    }

    public function serialize(){
        parent::serialize();
        $this->serrialized_groupe =   $this->groupe->getId().'|'. //0
                                $this->groupe->getLibelle().'|'. //1
                                $this->groupe->getEcole()->getId().'|'.//2
                                $this->groupe->getEcole()->getLibelle().'|'.//3
                                $this->groupe->getEcole()->getVille().'|'. //4
                                $this->groupe->getAvancement().'|'. //5
                                $this->groupe->getScore().'|'.//6
                                $this->groupe->getResultats();//7
        $this->serrialized_classe =   $this->classe->getId().'|'.
                                $this->classe->getLibelle();
    }

    public function unSerialize(){
        parent::unSerialize();
        $tab_group = explode('|', $this->serrialized_groupe);
        $ecole = new School($tab_group[2],$tab_group[3],$tab_group[4]);
        $this->groupe = new Group($tab_group[0],$tab_group[1],$tab_group[5],$tab_group[6],$tab_group[7]);
        $tab_classe = explode('|', $this->serrialized_classe);
        $this->classe = new Grade($tab_classe[0],$tab_classe[1]);
    }

    //TODO verifie si c'est pertinent d'avoir ça ici vu que la fonction est presente dans la parent
//    public function login() {
//        load_model("userModel");
//
//        $CI = get_instance();
//        $res = $CI->userModel->validerLogin($this->email, $this->password);
//        if (empty($res)) {
//            throw new Exception($this->password, 1);
//        } else {
//            $this->id = $res->pk_usr;
//            $this->prenom = $res->usr_name;
//            $this->nom = $res->usr_firstname;
//            $this->accountValid = $res->usr_account_valid;
//            if ($this->accountValid == 0) {
//                throw new Exception("Votre compte n'a pas encore été activé", 1);
//            }
//
//            //récup des droits
//
//            $this->rights = $CI->userModel->getDroits($res->usr_role);
//
//            //Mise en session
//            $CI->session->set_userdata("current_user", $this);
//
//        }
//    }

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
