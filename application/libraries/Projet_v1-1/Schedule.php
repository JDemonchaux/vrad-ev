<?php

/**
 *
 * @version 1.0
 * @author Marie
 */
class Schedule
{
	private  $startTimePlan;
	private  $endTimePlan;
	private  $startHourReal;
	private  $endHourReal;
	private  $hoursToDo;
	private  $hoursDone;
	private  $raf; // peut être boolean

    public function __construct( $startTimePlan = NULL, $endTimePlan = NULL, $startTimeReal = NULL, $endTimeReal = NULL){

        // nb heures planifiées
        $this->startTimePlan = $startTimePlan;
        $this->endTimePlan = $endTimePlan;
        $this->startHourReal = $startTimeReal;
        $this->endHourReal = $endTimeReal;
        $this->sethoursPlan();
        $this->setReal();		
    }

    private function sethoursPlan(){
        if (!is_null($this->startTimePlan) && !is_null($this->endTimePlan)) {            
            $periodePlan = date_diff($this->startTimePlan,$this->endTimePlan);    
            $this->hoursToDo = $periodePlan->h + $periodePlan->i/60;
        }
        else {
            // Les param ne sont pas des datediff
        }
    }

    private function setReal(){
        // calcul du RAF (pas en heure pour le moment) : si false alors raf = 0 : tache terminée
        $this->raf = true;
        $this->hoursDone = 0;
        if (!is_null($this->endHourReal)){
            $this->raf = 0;
            $periodeReal = date_diff($this->startHourReal,$this->endHourReal);
            $this->hoursDone  = $periodeReal->h + $periodeReal->i/60;
        }
    }

    public function setStartHourReal( $startHourReal){
        $this->startHourReal = $startHourReal;
        $this->setReal();
    }

    public function setEndHourReal( $endHourReal){
        $this->endHourReal = $endHourReal;
        $this->setReal();
    }

    public function setStartHourRealNow(){
        $this->startHourReal = new DateTime();
        $this->setReal();
    }

    public function setEndHourRealNow(){
        $this->endHourReal = new DateTime();
        $this->setReal();
    }

    public function setTimePlan( $startTimePlan,  $endTimePlan){
        $this->startHoursPlan = $startTimePlan;
        $this->endTimePlan = $endTimePlan;
        $this->sethoursPlan();

    }

    public function getStartHourPlan(){
        return $this->startTimePlan;
    }

    public function displayStartHourPlan($format=DEFAULT_DT_FORMAT){
        return $this->startTimePlan->format($format);
    }

    public function getEndHourPlan(){
        return $this->endTimePlan;
    }

    public function displayEndHourPlan($format=DEFAULT_DT_FORMAT){
        return $this->endTimePlan->format($format);
    }

    public function getStartHourReal(){
        return $this->startHourReal;
    }

    public function displayStartHourReal($format=DEFAULT_DT_FORMAT){
        return $this->startHourReal->format($format);
    }

    public function getEndHourReal(){
        return $this->endHourReal;
    }

    public function displayEndHourReal($format=DEFAULT_DT_FORMAT){
        return $this->endHourReal->format($format);
    }

    public function getRAF(){
        return $this->raf;
    }

    public function getHoursToDo(){
        return $this->hoursToDo;
    }

    public function getHoursDone(){
        return $this->hoursDone;
    }


}