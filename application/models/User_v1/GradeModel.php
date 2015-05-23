<?php

/**
 * gradeModel short summary.
 *
 * gradeModel description.
 *
 * @version 1.0
 * @author Jérôme
 */
class GradeModel extends CI_Model
{
    public function readAllGrade() {
        $query = $this->db->get("ref_grade_grd");
        $resultat = $this->fullFillGrade($query->result());
        
        return $resultat;
    }
    
    public function readOneGrade($idClasse) {
        $query = $this->db->where("pk_grd", $idClasse);
        $query = $this->db->get("ref_grade_grd");   
        $resultat = $this->fullFillGrade($query->result());
        return $resultat[0];
    }
    
    public function readOneGradeByLibelle($libelle) {
        $query = $this->db->where("grd_lib", $libelle);
        $query = $this->db->get("ref_grade_grd");   
        $resultat = $this->fullFillGrade($query->result());
        return $resultat[0];
    }
    
    public function fullFillGrade($rows) {
        $result = array();
        foreach ($rows as $key => $data) {
            $classe = new Grade($data->pk_grd, $data->grd_lib);
            $arr["classe"] = $classe;
            array_push($result, $arr["classe"]);
        }
        
        return $result;
    }
}
