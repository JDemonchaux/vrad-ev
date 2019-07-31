<?php
/**
 * Fichier permetant de gérer facilement les notifications utilisateurs et les pages d'erreur
 * 
 *
 * @package customCI-by-MB&JD
 * @author  Jerome.Demonchaux@gmail.com
 * @copyright   MB&JD April 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*	Appelée depuis un controller pour afficher un message (erreur, warning, info, success)
*
* @author  Jerome.Demonchaux@gmail.com
*
* @param string $message : le message à afficher
* @param String $module : le module de la vue à charger.
* @param String $vue : la vue à charger
* @param String $type : le type de notification à afficher (par défaut : error)
* @param Boolean $dismiss : si la notification doit se fermer automatiquement (par défaut : FALSE)
*
* @return void : met en session flash un message qui sera gérer par la vue le recevant
*/
if (! function_exists("set_user_message")) {
	function set_user_message($message, $type = "error", $dismiss = FALSE) {
		$CI = get_instance();
		$CI->session->set_flashdata("message", $message);
		$CI->session->set_flashdata("type", $type);
		$CI->session->set_flashdata("dismiss", $dismiss);

	}
}

/**
* Appelée depuis un controller pour afficher un message (erreur, warning, info, success)
* ET passer à autre chose : nouvelle action d'un controller d'un module
*
* @author  Marie.Barbier.work@gmail.com
* @deprecated 
* @see helper/MY_url_helper.php
*
* @param string $message : le message à afficher
* @param String $module : le module de la vue à charger.
* @param String $vue : la vue à charger
* @param String $type : le type de notification à afficher (par défaut : error)
*
* @return void : gère le message et redirige sur l'action de controller demandée
*/
if (! function_exists("go_and_show_message")) {
	function go_and_show_message($module, $controller, $action, $message, $type = "error", $dismiss = FALSE) {
		set_user_message($message, $type, $dismiss);
		//utilisation du helper MY_url
		redirect(construct_full_url($controller, $action, $module));
	}
}


/**
* Appelée dans le Layout.
* Regarde si une notification est présente en session flash
* Si oui, charge la notification (l'initialisation se fait en JQuery)
* TODO : gérer la pile !!??
*
* @author  Jerome.Demonchaux@gmail.com
*
*/
if (! function_exists("show_notification")) {
	function show_notification() {
		$CI = get_instance();
		$type = $CI->session->flashdata("type");
		$message = $CI->session->flashdata('message');
		$dismiss = $CI->session->flashdata('dismiss');

		if ($message == '' OR $message == NULL OR empty($message)) {
			// Ici on fait rien.
			// Le helper est chargé à chaque vue
			// Donc si aucun message n'est en session, on n'affiche pas la div de notification.
		} else {
			$data["message"] = $message;
			$data["type"] = $type;
			$data['dismiss'] = $dismiss;
			load_simple_view("notification", $data,"Error");
		}
	}
}