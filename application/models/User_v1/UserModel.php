<?php

/**
 * userModel short summary.
 *
 * userModel description.
 *
 * @version 1.0
 * @author Jérôme
 */
class UserModel extends CI_Model
{    


    /*
     * Fonction qui vérifie si l'email déjà présent en base de données
     * @param: String email;
     * @return nombre de ligne : 0 pas d'email : 1 email;
     */ 
    public function countByEmail($email) {
    	$query = $this->db->where("usr_email", $email);
    	$query = $this->db->get("TM_USER_USR");

    	return $query->num_rows();
    }

    public function createParticipant(Member $participant) {        
    	$insert = array(
    		"usr_role" => "membre",
    		"usr_name" => $participant->getNom(),
    		"usr_firstname" => $participant->getPrenom(),
    		"usr_email" => $participant->getMail(),
    		"usr_pwd" => $participant->getPassword(),
    		"usr_account_valid" => $participant->getAccountValid(),
    		"fk_grp" => $participant->getGroupe()->getId(),
    		"fk_grd" => $participant->getClasse()->getId(),
    		"fk_schl" => $participant->getGroupe()->getEcole()->getId()
    		);
    	$success = false;
    	if ($this->db->insert("TM_USER_USR", $insert)) {
    		$success = true;
    	}

    	return $success;

    }

    public function createJury(Jury $jury) {
        $insert = array(
            "usr_role" => "jury",
            "usr_name" => $jury->getNom(),
            "usr_firstname" => $jury->getPrenom(),
            "usr_email" => $jury->getMail(),
            "usr_pwd" => $jury->getPassword(),
            "usr_account_valid" => $jury->getAccountValid(),
            "fk_grp" => NULL,
            "fk_grd" => NULL,
            "fk_schl" => $jury->getEcole()->getId()
            );
        $success = false;
        if ($this->db->insert("TM_USER_USR", $insert)) {
            $success = true;
        }

        return $success;
    }

    public function validerLogin($login, $password) {
        $this->db->select('*');
        $this->db->where('usr_email', $login);
        $this->db->where('usr_pwd', $password);
      //  var_dump($this->db->get_compiled_select('tm_user_usr'));die;
        $query = $this->db->get('tm_user_usr');



        $res = $query->result()[0];

        if (empty($res)) {
            throw new Exception($password, 1);
        } else {

            $CI = get_instance();
            //Polymorphisme de l'utilisateur avec la classe enfant necessaire
            load_library("Member");
            load_library("Jury");
            load_library("User");
            if($res->usr_role=="membre"){
                load_model("GradeModel");
                $classe = $CI->GradeModel->readOneGrade($res->fk_grd);
                load_model("GroupModel");
                $groupe = $CI->GroupModel->readOneGroupSchool($res->fk_grp);
                $enfant = new Member($res->pk_usr,$res->usr_firstname, $res->usr_name,$login,"",$res->usr_account_valid,$groupe,$classe);

            }elseif($res->usr_role=="jury"){
                load_model("SchoolModel");
                $ecole = $CI->SchoolModel->readOneSchool($res->fk_schl);
                $specialite = "";

                $enfant = new Jury($res->pk_usr,$res->usr_firstname, $res->usr_name,$login,"",$res->usr_account_valid,$ecole,$specialite);
            }else{
                $enfant = new User($login,"",$res->pk_usr,$res->usr_name, $res->usr_firstname,$res->usr_account_valid);
            }

            //récup des droits
            $enfant->setRights($this->getDroits($res->usr_role));

        }

        return $enfant;

    }

    public function getDroits($role) {
        $this->db->select('*');
        $this->db->where('fk_usr_role', $role);
        $query = $this->db->get('tj_rights_rgt');
        $res = $query->result();
        $rights = array();
        foreach ($res as $key => $value) {
            $rights[$value->rgt_module][$value->rgt_controller] = bindec($value->rgt_allow);
        }
        return $rights;
    }


}
