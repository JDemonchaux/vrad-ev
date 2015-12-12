<?php

/**
 *
 * @version 1.0
 * @author Marie
 */
class Task
{
    private $idTask;
    private $libelle;
    private $description;
    private $user;
    private $item;
    private $planning;
    private $isNp;

    public function __construct($idTask = '', $libelle = '', $description = '', $item = NULL, $planification = NULL, $user = NULL)
    {
        load_library('Schedule', 'Projet');
        load_library('Item', "Notation");
        $this->idTask = $idTask;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->planning = $planification;
        $this->user = $user;
        $this->item = $item;
    }

    public function getIsNp()
    {
       return $this->isNp;
    }

    public function getIdTask()
    {
        return $this->idTask;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPlanning()
    {
        return $this->planning;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function setIdTask($idTask)
    {
        $this->idTask = $idTask;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPlanning($startHourPlan, $endHourPlan, $startHourReal, $endHourReal)
    {
        $this->planning = new Schedule($startHourPlan, $endHourPlan, $startHourReal, $endHourReal);
    }

    public function setFirstPlanning($startHourPlan, $endHourPlan)
    {
        $this->planning = new Schedule($startHourPlan, $endHourPlan);
    }

    public function setItem($item)
    {
        $this->item = $item;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setIsNp($np) {
        $this->isNp = $np;
    }

	public function getEtat(){
		return "";
	}


}