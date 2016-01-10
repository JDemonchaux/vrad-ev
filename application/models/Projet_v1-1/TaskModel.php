<?php

/**
 * taskModel short summary.
 *
 * taskModel description.
 *
 * @version 1.0
 * @author Marie
 */
class TaskModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        load_library('Task', 'Projet');
        load_library('Item', 'Notation');
        load_library('Schedule', 'Projet');
        load_library('Categorie', 'Notation');
        load_library('Notation', 'Notation');
        load_library('User', "User");
    }

    public function create($task)
    {

        $CI =& get_instance();
        $format_date = $CI->config->item('date_format_bdd');

        $np = false;
        if (date('H') >= 22 || date('H') >= 00 && date('H') <= 8) {
            $np = true;
        }

        $tache = array(
            "pk_tsk" => $task->getIdTask(),
            "fk_usr" => $task->getUser(),
            "fk_itm" => $task->getItem(),
            "tsk_lib" => $task->getLibelle(),
            "tsk_comment" => $task->getDescription(),
            "tsk_start_hour_plan" => $task->getPlanning()->getStartHourPlan()->format($format_date),
            "tsk_end_hour_plan" => $task->getPlanning()->getEndHourPlan()->format($format_date),
            "tsk_is_np" => $np,
            );
        $this->db->insert("TM_TASK_TSK", $tache);
    }

    public function readOneTask($idTask) {
        $query = $this->selectFullTask();
        $query = $this->db->where("pk_tsk", $idTask);
        $query = $this->db->get();
        $resultat = $this->fillFullTask($query->result());
        return array_shift($resultat);
    }

    public function readAllByGroup($idGroup)
    {
        $query = $this->selectFullTask();
        $query = $this->db->where('tm_user_usr.fk_grp', $idGroup);
        $query = $this->db->get();

        $rows = $query->result();

        return $this->fillFullTask($rows);
    }

    public function readAllByUser($idUser)
    {
        $query = $this->selectFullTask();
        $query = $this->db->where('tm_user_usr.pk_usr', $idUser);
        $query = $this->db->get();

        $rows = $query->result();

        return $this->fillFullTask($rows);
    }

    public function update($task)
    {

        $CI =& get_instance();
        $format_date = $CI->config->item('date_format_bdd');

        $array = array(
            "pk_tsk" => $task->getIdTask(),
            "fk_usr" => $task->getUser()->getId(),
            "fk_itm" => $task->getItem()->getIdItem()
            );

        if ($task->getPlanning() !== "") {
            $array["tsk_start_hour_plan"] = $task->getPlanning()->getStartHourPlan()->format($format_date);
            $array["tsk_end_hour_plan"] = $task->getPlanning()->getEndHourPlan()->format($format_date);
            if(!is_null($task->getPlanning()->getStartHourReal())){
                $array["tsk_start_hour_real"] = $task->getPlanning()->getStartHourReal()->format($format_date);
            }
            if(!is_null($task->getPlanning()->getEndHourReal())){
                $array["tsk_end_hour_real"] = $task->getPlanning()->getEndHourReal()->format($format_date);
            }
        }

        $this->db->where("pk_tsk", $array["pk_tsk"]);
        $this->db->update("TM_TASK_TSK", $array);


    }

    public function delete($id)
    {
        $this->db->where("pk_tsk", $id);
        $this->db->delete("TM_TASK_TSK");
    }

    private function selectFullTask()
    {
        $startQuery = $this->db->select('pk_tsk, tsk_lib, tsk_comment, tsk_start_hour_plan, tsk_end_hour_plan, tsk_start_hour_real, tsk_end_hour_real,
         tsk_state, tsk_is_np ,pk_itm, itm_lib, itm_weight, itm_priority, itm_niv, itm_type, itm_livrable, itm_desc , pk_cat, cat_lib, cat_hexa_color, scr_score, scr_comment, pk_usr, usr_firstname, usr_name');
        $startQuery = $this->db->from('tm_task_tsk');
        $startQuery = $this->db->join('ref_item_itm', 'tm_task_tsk.fk_itm = ref_item_itm.pk_itm');
        $startQuery = $this->db->join('tm_user_usr', 'tm_task_tsk.fk_usr = tm_user_usr.pk_usr');
        $startQuery = $this->db->join('ref_category_cat', 'ref_item_itm.fk_cat = ref_category_cat.pk_cat');
        $startQuery = $this->db->join('tm_score_grp_itm_scr', 'tm_user_usr.fk_grp = tm_score_grp_itm_scr.fk_grp', 'left');


        //$query = $this->db->join('TM_GROUP_GRP', 'TM_GROUP_GRP.pk_grp = tm_user_usr.fk_grp');
    }


    private function fillFullTask($rows)
    {
        $result = array();
        foreach ($rows as $key => $data) {
            $user = new User('', '', $data->pk_usr, $data->usr_firstname, $data->usr_name);
            $categorie = new Categorie($data->pk_cat, $data->cat_lib, '', $data->cat_hexa_color);

            if (isset($data->scr_score)) {
                $notation = new Notation($data->scr_score, $data->scr_comment);
            } else {
                $notation = NULL;
            }
            $item = new Item($data->pk_itm, $data->itm_lib, $data->itm_priority, $data->itm_weight, $data->itm_niv , $data->itm_type, $data->itm_livrable, $data->itm_desc, $categorie, $notation);
            $planification = new Schedule($data->tsk_start_hour_plan, $data->tsk_end_hour_plan, $data->tsk_start_hour_real, $data->tsk_end_hour_real);
            $task = new Task($data->pk_tsk, $data->tsk_lib, $data->tsk_comment, $item, $planification, $user);
            $task->setIsNp($data->tsk_is_np);
            $result[$data->pk_tsk] = $task;
        }
        return $result;
    }


}
