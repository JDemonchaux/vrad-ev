<?php

/**
 *
 * Classe de plannification d'une tache
 * contien uniquement les dates et le RAF associé
 * permet ainsi le calcul d'avancement
 *
 * @version 1.0
 * @package Vrad-EV
 * @author Marie.Barbier.work@gmail.com
 * @copyright  MB&JD December 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');




class Schedule
{
    /**
     * DateTime
     * Heure Planifiée de début de la tache
     */
    private $startTimePlan;

    /**
     * DateTime
     * Heure Planifiée de fin de la tache
     */
    private $endTimePlan;

    /**
     * DateTime
     * Heure Réelle de début de la tache
     */
    private $startHourReal;

    /**
     * DateTime
     * Heure Réelle de fin de la tache
     */
    private $endHourReal; //datetime

    /**
     * INT
     * difféernce en heures entre startTimePlan et endTimePlan
     */
    private $hoursToDo; 

    /**
     * INT
     * difféernce en heures entre startHourReal et endHourReal
     */
    private $hoursDone;

    /**
     * vaut TRUE si la tache n'est pas terminées
     * (cad $endHourReal == NULL)
     * vaut 0 sinon
     */
    private $raf; 

    /**
     * String (ex : YYYY-mm-dd)
     * Format d'Affichage des dates (récup depuis la config)
     */
    private $format_date;

    /**
     * Détermines les indicateurs d'avancement en fonction des DateTime définits
     */
    public function __construct($startTimePlan = NULL, $endTimePlan = NULL, $startTimeReal = NULL, $endTimeReal = NULL)
    {

        $CI =& get_instance();
        $this->format_date = $CI->config->item('date_format_display');

        //verification du format DateTime
        $this->startTimePlan = $this->checkDate($startTimePlan);
        $this->endTimePlan = $this->checkDate($endTimePlan);
        $this->startHourReal = $this->checkDate($startTimeReal);
        $this->endHourReal = $this->checkDate($endTimeReal);

        //détermination des autres attributs calculés
        $this->sethoursPlan();
        $this->setReal();
    }

    /*
     * Détermine la Période en heures entre les dates Planifiées de début et de fin 
     */
    private function sethoursPlan()
    {
        if (!is_null($this->startTimePlan) && !is_null($this->endTimePlan)) {
            $periodePlan = date_diff($this->startTimePlan, $this->endTimePlan);
            $this->hoursToDo = $periodePlan->h + $periodePlan->i / 60;
        } else {
            // Les param ne sont pas des datediff
        }
    }

    /*
     * Détermine la Période en heures entre les dates Réeles de début et de fin 
     * Détermine également le RAF de la tache
     */
    private function setReal()
    {
        // calcul du RAF (pas en heure pour le moment) : si false alors raf = 0 : tache terminée
        $this->raf = true;
        $this->hoursDone = 0;
        if (!is_null($this->endHourReal)) {
            $this->raf = 0;
            $periodeReal = date_diff($this->startHourReal, $this->endHourReal);
            $this->hoursDone = $periodeReal->h + $periodeReal->i / 60;
        }
    }

    /*
     * affecte la date de début Réelle
     * et met à jours les indicateurs
     */
    public function setStartHourReal($startHourReal)
    {
        $this->startHourReal = $this->checkDate($startHourReal);
        $this->setReal();
    }

    /*
     * affecte la date de fin Réelle
     * et met à jours les indicateurs
     */
    public function setEndHourReal($endHourReal)
    {
        $this->endHourReal = $this->checkDate($endHourReal);
        $this->setReal();
    }

    /*
     * Initialise le commencement de la tache
     * et met à jours les indicateurs
     */
    public function setStartHourRealNow()
    {
        $this->startHourReal = new DateTime();
        $this->setReal();
    }

    /*
     * Initialise la fin de la tache
     * et met à jours les indicateurs
     */
    public function setEndHourRealNow()
    {
        $this->endHourReal = new DateTime();
        $this->setReal();
    }

    /**
     * Affecte les dates de début et de fin planiffiées
     */
    public function setTimePlan($startTimePlan, $endTimePlan)
    {
        $this->startHoursPlan = $startTimePlan;
        $this->endTimePlan = $endTimePlan;
        $this->sethoursPlan();

    }

    public function getStartHourPlan()
    {
        return $this->startTimePlan;
    }

    /**
     * mets en forme la date planifiée de début en fonction du format
     * (en paramettre ou pas defaut)
     */
    public function displayStartHourPlan($format = "")
    {
        if (is_null($this->startTimePlan)) {
            return "";
        }
        if (empty($format)) {
            $format = $this->format_date;
        }
        return $this->startTimePlan->format($format);
    }

    public
    function getEndHourPlan()
    {
        return $this->endTimePlan;
    }

    /**
     * mets en forme la date planifiée de fin en fonction du format
     * (en paramettre ou pas defaut)
     */
    public function displayEndHourPlan($format = "")
    {
        if (is_null($this->endTimePlan)) {
            return "";
        }
        if (empty($format)) {
            $format = $this->format_date;
        }
        return $this->endTimePlan->format($format);
    }

    public
    function getStartHourReal()
    {
        return $this->startHourReal;
    }

    /**
     * mets en forme la date réelle de début en fonction du format
     * (en paramettre ou pas defaut)
     */
    public function displayStartHourReal($format = "")
    {
        if (is_null($this->startHourReal)) {
            return "";
        }
        if (empty($format)) {
            $format = $this->format_date;
        }
        return $this->startHourReal->format($format);
    }

    public
    function getEndHourReal()
    {
        return $this->endHourReal;
    }

     /**
     * mets en forme la date planifiées de fin en fonction du format
     * (en paramettre ou pas defaut)
     */
    public function displayEndHourReal($format = "")
    {
        if (is_null($this->endHourReal)) {
            return "";
        }
        if (empty($format)) {
            $format = $this->format_date;
        }
        return $this->endHourReal->format($format);
    }

    public
    function getRAF()
    {
        return $this->raf;
    }

    public
    function getHoursToDo()
    {
        return $this->hoursToDo;
    }

    public
    function getHoursDone()
    {
        return $this->hoursDone;
    }

    /*
     * Gère l'initialisation d'un DateTime
     * en prennant en compte les valeurs nulles
     * et en transtipant les chaines de caractères
     */
    private function checkDate($dateToCheck){
        if (is_null($dateToCheck)) {
            return NULL;
        } elseif (!$dateToCheck instanceof DateTime) {
            return new DateTime($dateToCheck);
        } else {
            return $dateToCheck;
        }
    }


}