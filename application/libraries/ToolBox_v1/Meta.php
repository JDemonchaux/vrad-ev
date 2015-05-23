<?php
/**
 * Classe de construction des metadata pour l'entete HTML
 * 
 *
 * @package customCI-by-MB&JD
 * @author  Marie.Barbier.work@gmail.com
 * @copyright  MB&JD April 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Meta {

    /**
    * titre de la page
    */
    private $title ="";
    /**
    * titre de la page
    */
    private $description ="";
    /**
    * titre de la page
    */
    private $key_words ="";



    public function __construct($title="",$description="",$key_words=""){
		$this->title=$title;
        $this->description=$description;
        $this->key_words=$key_words;

    }

    public function getTitle(){
        return $this->title;
    }

   

}
/* End of file Meta.php */
/* Location: ./system/application/libraries/ToolBox/Meta.php */