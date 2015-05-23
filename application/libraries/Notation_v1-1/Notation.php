<?php

/**
 *
 * @version 1.0
 * @author Marie
 */
class Notation
{

	private  $note;
	private  $commentaire;

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