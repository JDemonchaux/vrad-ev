<?php
/**
 * Fichier permetant de gérer facilement les hooks du controller
 * pre_constructeur
 *
 * @package    customCI-by-MB&JD
 * @author    Marie.Barbier.work@gmail.com
 * @copyright    MB&JD March-April2015
 * @since    Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function init_layout_data()
{
    //accès à tous les outils du controller
    $CI = get_instance();

    $CI->layout_data = array();

    init_metadata();

}

function init_metadata()
{
    //accès à tous les outils du controller
    $CI = get_instance();

    load_library('Meta', 'ToolBox');
    $general_meta = $CI->config->item('general_meta');

    $CI->metadata = new Meta ($general_meta["title"], $general_meta["description"], $general_meta["keywords"]);
}

function verif_droits()
{
    //accès à tous les outils du controller
    $CI = get_instance();

    $module = $CI->module; //$CI->router->directory;
    $controller = $CI->router->class;
    $action = $CI->router->method;

    $les_droits = $CI->config->item("droits");

    $acces = FALSE;

    if (!isset($les_droits[$module][$controller][$action])) {
        //action PUBLIC pas de verif des droits
        $acces = TRUE;
    } else {
        //il y a-t-il un utilisateur en session?
        if (!isset($_SESSION['current_user'])) {
            $acces = FALSE;
            $user_droits = array();
        } else {
//            $session = $CI->session->get_userdata();
            $user = $_SESSION['current_user'];
            $user->unSerialize();
            //as-t-il les droits?

            $acces = $user->demander_acces($module, $controller, $les_droits[$module][$controller][$action]);

        }
    }

    if ($acces) {
        //Ne rien faire, tout va bien
    } else {
        //on redirige sur la home avec message d'erreur
        $message = "403 : vous n'avez pas le droit d'acc&egrave;der à cette page";
        $message .= "(".$module."/".$controller."/".$action.")";
        set_user_message( $message);

        redirect(construct_full_url("Connexion", "login", "User"));
    }


}