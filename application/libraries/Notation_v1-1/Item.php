<?php

/**
 *
 * @version 1.0
 * @author Marie
 */
class Item
{
	private  $idItem;
	private  $libelle;
	private  $description;
	private  $categorie;
	private  $priority;
	private  $coef;
	private  $type;
	private  $livrable;

	public function __construct( $idItem='',  $libelle='', $priority='', $coef='', $type='', $livrable='',  $description='', $categorie=NULL, $notation=NULL, $avancement=0) {
		load_library('Categorie');
		load_library('Notation');
		$this->idItem = $idItem;
		$this->libelle = $libelle;
		$this->description = $description;
		$this->priority = $priority;
		$this->coef = $coef;
		$this->type = $type;
		$this->livrable = $livrable;


		if(!isset($categorie)){
			$this->categorie = new Categorie();
		}else{
			$this->categorie = $categorie;
		}

		if(!isset($notation)){
			$this->notation = new Notation();
		}else{
			$this->notation = $notation;
		}

		$this->avancement = $avancement;

	}

	public function getIdItem(){
		return $this->idItem;
	}

	public function getLibelle(){
		return $this->libelle;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getPriority(){
		return $this->priority;
	}

	public function getCoef(){
		return $this->coef;
	}

	public function getType(){
		return $this->type;
	}

	public function getLivrable(){
		return $this->livrable;
	}


	public function getCategorie(){
		return $this->categorie;
	}

	public function getNotation(){
		return $this->notation;
	}

	public function setIdItem($idItem){
		$this->idItem = $idItem;
	}

	public function setLibelle($libelle){
		$this->libelle = $libelle;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setPriority($priority){
		 $this->priority = $priority;
	}

	public function setCoef($coef){
		 $this->coef = $coef;
	}

	public function setType($type){
		 $this->type = $type;
	}

	public function setLivrable($livrable){
		 $this->livrable = $livrable;
	}

	public function setCategorie($categorie){
		$this->categorie = $categorie;
	}

	public function setNotation($notation){
		$this->notation = $notation;
	}


    public function getAvancement(){
        return $this->avancement ;
    }

    public function setAvancement($avancement){
        $this->avancement = $avancement;
    }

public function displayAvancement(){
         if($this->livrable==0){
							 $avancement = "N/A";
						}else{
							$avancement = $this->avancement." %";
						}
        return $avancement ;
    }

	//si item planifiable et avancement à 0 on ne peut pas noter
    public function isEvaluable(){
if($this->avancement ==0 && $this->livrable==1){
							return FALSE;
						}
    	return TRUE;
    }
   

}