<?php
/**
 * Fichier permetant de gérer facilement plusieurs version d'un même modules
 * Dans le cas ou des versions differents soient déployées 
 * sur differents environements de production
 *
 * @package	customCI-by-MB&JD
 * @author	Marie.Barbier.work@gmail.com
 * @copyright	MB&JD March-April2015
 * @since	Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
  * Construction dynamique des routes par defaut des modules
  *
  * Cette construction dynamique prend en compte l'affichage ou non
  * de la version des modules dans l'URL
  * pour construire les routes par defaut vers le controller et l'action
  * dans le cas ou l'URL appelé ne précise que le nom du module
  *
  * @author	Marie.Barbier.work@gmail.com
  *
  * @param array $config_versions liste des versions pour chaque modules 
  * dont show_in_URL module version info
  *
  * @return void
  */
function construct_routes($config_versions){

// ICI nous somme dans un Hook appeler au pre_system point!!!!!
// Pour rappel $CI = get_instance(); ne fonctionne pas
// on n'a pas non plus accès aux autres éléments de la config
// c'est pour cela que l'on doit la recevoir en parametre des méthodes
// De plus, ON PASSE EN GLOBAL l'infos que l'on construit ICI 
// pour la récupérer plus loin dans la config, plus précisément dans Route

	$route = array();
	foreach ($config_versions as $module => $version){
	
		//la permière info de versions n'est pas un module en soit
		if($module!="show_in_URL"){
			     //pour le reste
      $module_route_name = get_module_route_name($config_versions, $module);
      if (isset($version['DefaultRoute'])){
         foreach ($version["DefaultRoute"] as $controller => $info){
            if($controller == "module"){
                $route_name = $module_route_name;
            }else{
              $route_name = $module_route_name."/".$controller;
            }
          $default_action = $route_name."/".$info;
         //association de la route du module à sa route controller/action par default
         $route[$route_name] = $default_action;

         }

      }
			
		}
	
	}
  //var_dump($route);
	//Mise à jour de la variable gloable utilisé dans le fichier routes.php
	$GLOBALS["default_modules_route"] = $route;

}

/**
  * pour avoir le nom du module avec son num de version ou pas
  *
  * En fonction de la configuration de l'environement
  * les noms de modules peuvent être utiliser sans leur numero de version
  * pour les controller, afin d'amélioré le rendu de l'url
  * alors que le numero de versions est tourjours
  * utilisé pour accèder aux vues, aux modèles et aux librairies
  *
  * @author	Marie.Barbier.work@gmail.com
  *
  * @param array $config_versions liste des versions pour chaque modules 
  * dont show_in_URL module version info
  * @param String nom de base du module
  *
  * @return String nom correctement formé du module pour l'URL
  */
if (!function_exists('get_module_route_name'))
{
	function get_module_route_name($config_versions, $module) 
	{
		$module_name="";
		//$CI = get_instance();
		//$show = $CI->config->item("show_versions_in_URL");
		$show = $config_versions['show_in_URL'];

		if($show){
			$module_name  = get_module_versioned_name($config_versions, $module);
		}else{
			$module_name = $module;
		}
		return $module_name;
	}
}
/**
  * pour avoir le nom du module avec  forcement son num de version
  *
  * le numero de versions est tourjours utilisé pour accèder 
  * aux dossier et fichiers des vues, des modèles et des librairies
  *
  * @author	Marie.Barbier.work@gmail.com
  *
  * @param array $config_versions liste des versions pour chaque modules 
  * dont show_in_URL module version info
  * @param String nom de base du module
  *
  * @return String nom du module sufixé de _v et son numero de version
  * tel que défini dans la configuration par exemple _v1-2
  */
if (!function_exists('get_module_versioned_name'))
{
	function get_module_versioned_name($config_versions, $module) 
	{
		$module_name="";
		//$CI = get_instance();
		//$module_version = $CI->config->item("versions")[$module];
    if(!empty($module)){
		$module_version = $config_versions[$module];

			$module_name = $module."_v".$module_version['v'];
}
		return $module_name;
}
}


