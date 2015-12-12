<?php

/**
 *
 * @version 1.0
 * @author Marie
 */
class Schedule
{
    private $startTimePlan; //datetime
    private $endTimePlan; //datetime
    private $startHourReal; //datetime
    private $endHourReal; //datetime
    private $hoursToDo; //datetime
    private $hoursDone; //datetime
    private $raf; // peut être boolean
    private $format_date;

    public function __construct($startTimePlan = NULL, $endTimePlan = NULL, $startTimeReal = NULL, $endTimeReal = NULL)
    {

        $CI =& get_instance();
        $this->format_date = $CI->config->item('date_format_display');

        // nb heures planifiées

        if (!$startTimePlan instanceof DateTime) {
            $this->startTimePlan = new DateTime($startTimePlan);
        } elseif (is_null($startTimePlan)) {
            $this->startTimePlan = NULL;
        } else {
            $this->startTimePlan = $startTimePlan;
        }
        if (!$endTimePlan instanceof DateTime) {
            $this->endTimePlan = new DateTime($endTimePlan);
        } elseif (is_null($endTimePlan)) {
            $this->endTimePlan = NULL;
        } else {
            $this->endTimePlan = $endTimePlan;
        }
        if (!$startTimeReal instanceof DateTime) {
            $this->startHourReal = new DateTime($startTimeReal);
        } elseif (is_null($startTimeReal)) {
            $this->startHourReal = NULL;
        } else {
            $this->startHourReal = $startTimeReal;
        }
        if (!$endTimeReal instanceof DateTime) {
            $this->endHourReal = new DateTime($endTimeReal);
        } elseif (is_null($endTimeReal)) {
            $this->endHourReal = NULL;
        } else {
            $this->endHourReal = $endTimeReal;
        }
        $this->sethoursPlan();
        $this->setReal();
    }

    private
    function sethoursPlan()
    {
        if (!is_null($this->startTimePlan) && !is_null($this->endTimePlan)) {
            $periodePlan = date_diff($this->startTimePlan, $this->endTimePlan);
            $this->hoursToDo = $periodePlan->h + $periodePlan->i / 60;
        } else {
            // Les param ne sont pas des datediff
        }
    }

    private
    function setReal()
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

    public
    function setStartHourReal($startHourReal)
    {
        if (gettype($startHourReal) !== "DateTime") {
            $this->startHourReal = new DateTime($startHourReal);
        } else {
            $this->startHourReal = $startHourReal;
        }
        $this->setReal();
    }

    public
    function setEndHourReal($endHourReal)
    {
        if (gettype($endHourReal) !== "DateTime") {
            $this->endHourReal = new DateTime($endHourReal);
        } else {
            $this->endHourReal = $endHourReal;
        }
        $this->setReal();
    }

    public
    function setStartHourRealNow()
    {
        $this->startHourReal = new DateTime();
        $this->setReal();
    }

    public
    function setEndHourRealNow()
    {
        $this->endHourReal = new DateTime();
        $this->setReal();
    }

    public
    function setTimePlan($startTimePlan, $endTimePlan)
    {
        $this->startHoursPlan = $startTimePlan;
        $this->endTimePlan = $endTimePlan;
        $this->sethoursPlan();

    }

    public
    function getStartHourPlan()
    {
        return $this->startTimePlan;
    }

    public
    function displayStartHourPlan($format = "")
    {
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

    public
    function displayEndHourPlan($format = "")
    {
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

    public
    function displayStartHourReal($format = "")
    {
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

    public
    function displayEndHourReal($format = "")
    {
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


}