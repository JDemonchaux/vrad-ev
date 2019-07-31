<?php

/**
 * userModel short summary.
 *
 * userModel description.
 *
 * @version 1.0
 * @author Marie
 */
class RightModel extends CI_Model
{    

    public function __construct() {
        parent::__construct();
        
    }
    

    public function getDroitsByRole($role) {
        $this->db->select('*');
        $this->db->where('fk_usr_role', $role);
        $query = $this->db->get('tj_rights_rgt');
        $res = $query->result();
        $rights = array();
        foreach ($res as $key => $value) {
            $rights[$value->rgt_model][$value->rgt_controller] = bindec($value->rgt_allow);
        }
        //var_dump($rights);
        return $rights;
    }


    public function getSpecificDroits($model,$controller,$role) {
        $this->db->select('*');
        $this->db->where('rgt_model', $model);
        $this->db->where('rgt_controller', $controller);
        $this->db->where('fk_usr_role', $role);
        $query = $this->db->get('tj_rights_rgt');
        $res = $query->result();
        $value = $res[0];
        //var_dump($value);
        return bindec($value->rgt_allow);
    }
    
    public function setSpecificDroits($model,$controller,$role,$droit) {
        $array = array(
            "rgt_model" =>$model,
            'rgt_controller'=> $controller,
            'fk_usr_role'=>$role,
            "rgt_allow" => $droit
            );

        $this->db->where('rgt_model', $model);
        $this->db->where('rgt_controller', $controller);
        $this->db->where('fk_usr_role', $role);
        $this->db->update('tj_rights_rgt',$array);
    }

    


}
