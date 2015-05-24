<?php
/**
 * Surcharge du helper du system pour gérer les URL en fonction 
 * de l'affichage ou non du numero de version du module 
 * permetant ainsi de gérer facilement plusieurs version d'un même modules
 * Ce helper utilise ces fonctions de versions définit dans le hook utilisé en pre_system
 *
 * @package customCI-by-MB&JD
 * @author  Marie.Barbier.work@gmail.com
 * @see hooks/versions_functions.php
 * @copyright   MB&JD April 2015
 * @since Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('construct_uri_string'))
{
	/**
	 * URL String
	 *
	 * Returns the URI segments.
	 *
	 * @return	string
	 */
	function construct_uri_string($controller, $action, $module="")
	{
				$CI =& get_instance();
		//par defaut, on utilise le module courrant
        if($module===""){
            $module = $CI->module; 
        }
        //les modules ne sont pas toujours sufixé par leur version selon l'environement d'exectution
        $module_full_name = get_module_route_name($CI->config->item('versions'),$module);
		$url_segments = array($module_full_name,$controller,$action);

		return implode("/",$url_segments);
	}
}

if ( ! function_exists('construct_full_url'))
{
	/**
	 * URL String
	 *
	 * Returns the URI segments.
	 *
	 * @return	string
	 */
	function construct_full_url($controller, $action, $module="")
	{
		$CI =& get_instance();
		$url_end = construct_uri_string($controller, $action, $module="");
		return $CI->config->site_url($url_end);
	}
}

