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
     *  Fonction qui vérifie si l'email déjà présent en base de données
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

    public function validerLogin($login, $password) {
        $this->db->select('*');
        $this->db->where('usr_email', $login);
        $this->db->where('usr_pwd', $password);
        $query = $this->db->get('tm_user_usr');

        //$query = 'SELECT * FROM `tm_user_usr` WHERE `usr_email` = "'.$login.'" AND `usr_pwd` = "'.$password.'"';

        //$res = $this->db->query($query);

        return $query->result();
    }

}
