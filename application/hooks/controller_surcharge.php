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

function verif_droits(){
	//accès à tous les outils du controller
	$CI = get_instance(); 

    $module = $CI->module; //$CI->router->directory;
    $controller = $CI->router->class;
    $action = $CI->router->method;

    $les_droits = $CI->config->item("droits");

    $acces = FALSE;

    if( ! isset($les_droits[$module][$controller][$action]) ){
    	//action PUBLIC pas de verif des droits
    	$acces = TRUE;
    }
    else{
    		if( ! $CI->session->has_userdata("user") ){
    			$acces = FALSE;
    			$user_droits = array();
    		}else{
    			$user_droits = $CI->session->get_userdata("user")->getRights();
    		}

    	if( ! isset($user_droits[$module][$controller][$action]) ){
    		//module/controller non definit pour l'utilisateur = pas de droit
    		$acces = FALSE;
    	}
    	else{
			//BitBashing : &logic entre l'action demandé et le droit utilisateur correspondant
    		if( $les_droits[$module][$controller][$action] & $user_droits[$module][$controller][$action] ){
    			$acces = TRUE;
    		}
    		else{
    			$acces = FALSE;
    		}
    	}

    }

    if($acces){
			//Ne rien faire, tout va bien
    }
    else{
			//on redirige sur la home avec message d'erreur
    	set_user_message("403 : vous n'avez pas le droit d'accerder à cette page",1);
    	redirect(construct_full_url("Inscription", "index", "User"));
    }



}