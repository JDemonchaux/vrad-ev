<?php

/**
 * userModel short summary.
 *
 * userModel description.
 *
 * @version 1.0
 * @author Jérôme
 */
class GroupModel extends CI_Model
{    
    
    public function readAllGroup() {
        $query = $this->db->get("TM_GROUP_GRP");
        $resultat = $this->fullFillGroup($query->result());
        return $resultat;
    }
    
    public function readOneGroup($idGroup) {
        load_library("Group");
        $query = $this->db->where("pk_grp", $idGroup);
        $query = $this->db->get("TM_GROUP_GRP");
        $resultat = $this->fullFillGroup($query->result());
        return $resultat[0];
    }

    public function readOneGroupByLibelle($libelle) {
        $query = $this->db->where("grp_lib", $libelle);
        $query = $this->db->get("tm_group_grp");
        $resultat = $this->fullFillGroup($query->result());
        var_dump($query->result());
        return $resultat;
    }
    
    public function readAllGroupSchool() {
        $query = $this->db->select("*");
        $query = $this->db->from("TM_GROUP_GRP");
        $query = $this->db->join("TM_SCHOOL_SCHL", "fk_schl=pk_schl");
        $query = $this->db->get();
        
        $resultat = $this->fullFillGroupSchool($query->result());
        return $resultat;
    }

    public function readOneGroupSchool($idGroupe) {
        load_library("School");
        load_library("Group");
        $query = $this->db->select("*");
        $query = $this->db->from("TM_GROUP_GRP");
        $query = $this->db->join("TM_SCHOOL_SCHL", "fk_schl=pk_schl");
        $query = $this->db->where("pk_grp", $idGroupe);
        $query = $this->db->get();
        
        $resultat = $this->fullFillGroupSchool($query->result());
        return $resultat[0];
    }
    
    
    public function createGroupe($groupe) {
        $array = array(
            "grp_lib" => $groupe->getLibelle(),
            "fk_schl" => $groupe->getEcole()->getId()
            );
        var_dump($array);
        $query = $this->db->insert("TM_GROUP_GRP", $array);
        $req = $this->db->where("grp_lib", $groupe->getLibelle());
        $req = $this->db->join("TM_SCHOOL_SCHL", "fk_schl=pk_schl");
        $req = $this->db->get("TM_GROUP_GRP");
        $resultat = $this->fullFillGroupSchool($req->result());
        return $resultat[0];
    }
    
    
    public function fullFillGroup($rows) {
        $result = array();
        foreach ($rows as $key => $data) {
            $ecole = "";
            $groupe = new Group($data->pk_grp, $data->grp_lib, $ecole);
            $arr["groupe"] = $groupe;
            array_push($result, $arr["groupe"]);
        }
        
        return $result;
        
    }
    
    
    public function fullFillGroupSchool($rows) {
        $result = array();
        foreach ($rows as $key => $data) {
            $ecole = new School($data->pk_schl, $data->schl_lib, $data->schl_city);
            $groupe = new Group($data->pk_grp, $data->grp_lib, $ecole);
            $arr["groupe"] = $groupe;
            array_push($result, $arr["groupe"]);
        }
        
        return $result;
        
    }
}
