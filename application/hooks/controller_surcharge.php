<?php
/**
 * Fichier permetant de gérer facilement les hooks du controller
 * pre_constructeur
 *
 * @package	customCI-by-MB&JD
 * @author	Marie.Barbier.work@gmail.com
 * @copyright	MB&JD March-April2015
 * @since	Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function init_layout_data(){
		//accès à tous les outils du controller
        $CI = get_instance(); 

        $CI->layout_data = array();

		init_metadata();

}

function init_metadata(){
		//accès à tous les outils du controller
        $CI = get_instance(); 

        load_library('Meta','ToolBox');
        $general_meta = $CI->config->item('general_meta');

        $CI->metadata = new Meta ($general_meta["title"],$general_meta["description"],$general_meta["keywords"]);
}