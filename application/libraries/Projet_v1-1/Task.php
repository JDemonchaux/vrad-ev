<?php

/**
 *
 * Tache de projet rataché à un item du Barem
 * contien un object Schedule pour sa plannification et son calcul d'avancement
 *
 * @version 1.0
 * @package Vrad-EV
 * @author Marie.Barbier.work@gmail.com
 * @copyright  MB&JD December 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');




class Task
{
    private $idTask; //int
    private $libelle; //String
    private $description; //String
    private $user; //User Object
    private $item; //item Object
    private $planning; //Schedule Object

    /**
    * Les taches enregistrées en BDD après 22h sont marqué comme NP
    * cad non planifiées initialement dans les delais impartis
    */
    private $isNp; //Boolean

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

    /**
    *
    */
	public function getEtat(){
        if(!$this->planning->getRaf()){
			return 0; //Terminé
		}else if (!is_null($this->planning->getStartHourReal())){
			return 1; // En cours
		}else {
			return NULL; //pas commencé
		}
		
	}

	public function displayEtat(){
		if (is_null($this->getEtat())) {
			return "";
		}elseif($this->getEtat()==0){
			return "Terminé";
		}else if ($this->getEtat()==1){
			return "En cours";
		}
		
	}

	public function displayIconeEtat(){
		if (is_null($this->getEtat())) {
			return "";
		}elseif($this->getEtat()==0){
			return '<span class="glyphicon glyphicon-check green-text"></span>';
		}else if ($this->getEtat()==1){
			return '<span class="glyphicon glyphicon-time orange-text"></span>';
		}
		
	}

    public function start(){
        $this->planning->setStartHourRealNow();
    }

    public function stop(){
        $this->planning->setEndHourRealNow();
    }


}