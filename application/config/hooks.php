<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
//permet de gérer les versions dans les routes par defaut
require( APPPATH."config". DIRECTORY_SEPARATOR.ENVIRONMENT .DIRECTORY_SEPARATOR.'versions.php' );

$hook['pre_system'][] = array(
                                'class'    => '',
                                'function' => 'construct_routes',
                                'filename' => 'versions_functions.php',
                                'filepath' => 'hooks',
                                'params'   => $config['versions']
                                );
//$hook['pre_controller'][] = array(
$hook['post_controller_constructor'][] = array(
                                'class'    => '',
                                'function' => 'init_layout_data',
                                'filename' => 'controller_surcharge.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

// permet de lancer la méthode de verification des droits sur chaque page, avant l'exectution de celle-ci
/*
$hook['post_controller_constructor'][] = array(
                                'class'    => 'Right',
                                'function' => 'checkAuthorization',
                                'filename' => 'right.php',
                                'filepath' => 'librairies/User_v'.$vu,
                                'params'   => array()
                                );

*/


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */