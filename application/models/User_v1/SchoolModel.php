<?php

/**
 * SchoolModel short summary.
 *
 * SchoolModel description.
 *
 * @version 1.0
 * @author Jérôme
 */
class SchoolModel extends CI_Model
{

    public function __construct() {
        parent::__construct();
        load_library("School");
    }

    public function readAllSchool() {
        $query = $this->db->select("*");
        $query = $this->db->from("tm_school_schl");
        $query = $this->db->get();
        $resultat = $this->fullFillSchool($query->result());
        return $resultat;
        
    }

    public function readOneSchool($idEcole) {
        $query = $this->db->where("pk_schl", $idEcole);
        $query = $this->db->get("tm_school_schl");
        $resultat = $this->fullFillSchool($query->result());
        return $resultat[0];
    }
    
    public function createSchool($ecole) {
        $array = array(
            "schl_lib" => $ecole->getLibelle(),
            "schl_city" => $ecole->getVille()
            );
        $query = $this->db->insert("tm_school_schl", $array);
        $req = $this->db->where("schl_lib", $ecole->getLibelle());
        $req = $this->db->get("tm_school_schl");
        $resultat = $this->fullFillSchool($req->result());
        return $resultat[0];
        
    } 
    
    public function fullFillSchool($rows) {
        $result = array();
        foreach ($rows as $key => $data) {
            $school = new School($data->pk_schl, $data->schl_lib, $data->schl_city);
            $arr["school"] = $school;
            array_push($result, $arr["school"]);
        }
        
        return $result;
    }
}
