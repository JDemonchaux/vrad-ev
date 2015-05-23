<?php

/**
 * itemModel short summary.
 *
 * itemModel description.
 *
 * @version 1.0
 * @author Marie
 */
class ItemModel extends CI_Model
{

	public function __construct() {
        parent::__construct();
        load_library('Item');
        load_library('Categorie');
        load_library('Notation');
    }

    public function readAll(){
        $query = $this->selectItem();
        $query = $this->db->get();

        $rows = $query->result();

        return $this->fillItem($rows);
    }
    
    public function readAllByGroup($idGroup){
      $query = $this->selectScoredItem();
      $query = $this->db->where('tm_score_grp_itm_scr.fk_grp',$idGroup);
      $query = $this->db->get();

      $rows = $query->result();

      return $this->fillItem($rows);
  }


  private function selectScoredItem(){
      $startQuery =  $this->db->select('pk_itm, itm_lib, itm_weight, itm_priority, itm_type, itm_livrable, itm_desc, pk_cat, cat_lib, scr_score, scr_comment ' );
      $startQuery = $this->db->from('ref_item_itm');
      $startQuery = $this->db->join('tm_score_grp_itm_scr', 'ref_item_itm.pk_itm = tm_score_grp_itm_scr.fk_itm');
      $startQuery = $this->db->join('ref_category_cat', 'ref_item_itm.fk_cat = ref_category_cat.pk_cat');

  }

  private function selectItem(){
    $startQuery =  $this->db->select('pk_itm, itm_lib, itm_weight, itm_priority, itm_type, itm_livrable, itm_desc, pk_cat, cat_lib ');
    $startQuery = $this->db->from('ref_item_itm');
    $startQuery = $this->db->join('ref_category_cat', 'ref_item_itm.fk_cat = ref_category_cat.pk_cat');

}


private function fillItem($rows){
    $result = array();
    foreach ($rows as $key => $data) {
        $categorie = new Categorie($data->pk_cat, $data->cat_lib);
        
        if(isset($data->scr_score)){
            $notation = new Notation($data->scr_score, $data->scr_comment);
        }else{
            $notation = new Notation();
        }

        $item = new Item($data->pk_itm, $data->itm_lib,  $data->itm_priority, $data->itm_weight,$data->itm_type, $data->itm_livrable,$data->itm_desc, $categorie, $notation);

        $result[$data->pk_itm] = $item;
    }
    return $result;
}



}
