<?php

/**
 *
 * Note obtenue pour l'item par le groupe de projet
 *
 * @version 1.0
 * @package Vrad-EV
 * @author Marie.Barbier.work@gmail.com
 * @copyright  MB&JD December 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');



class Notation
{

	private  $note; //int
	private  $commentaire; //String

	public function __construct( $note=0,  $commentaire=''){
		$this->note = $note;
		$this->commentaire = $commentaire;
	}

	public function getNote(){
		return $this->note;
	}

	public function getCommentaire(){
		return $this->commentaire;
	}


	public function setNote($note){
		$this->note = $note;
	}

	public function setCommentaire($commentaire){
		$this->commentaire = $commentaire;
	}


}