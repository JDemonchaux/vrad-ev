<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jerome
 * Date: 20/06/2015
 * Time: 12:47
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fonction pour savoir si un utilisateur est connecté
 * @return TRUE or FALSE
 */
if (!function_exists("is_connected")) {
    function is_connected()
    {
        $CI = get_instance();
        if ($CI->session->userdata("current_user") !== NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}