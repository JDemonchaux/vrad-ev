<?php  
/**
 * Fichier permetant de définir les élements de menu liés aux valeus en base
 * pour lien dynamique
 *
 * @package	customCI-by-MBwork
 * @author	Marie.Barbier.work@gmail.com
 * @copyright	reserved
 * @license	reserved
 * @since	Version 1.0.0
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// $config['menu']["Module"]['Controller']['action'] = array(  )
												
$config['menu']["Projet"]['Planification']["gantt"] = array(	"model_name" => "Group",
																"model_module" => "User",
																"role" => array("jury")
													);				

												
$config['menu']["Notation"]['Evaluation']["noterGroupe"] = array(	"model_name" => "Group",
																	"model_module" => "User",
																	"role" => array("jury")
															);	








