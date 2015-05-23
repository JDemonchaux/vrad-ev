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
