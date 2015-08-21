<?php
/**
 * Fichier permetant de g�rer facilement plusieurs version d'un m�me modules
 * Ce helper utilise ces fonctions de versions d�finit dans le hook utilis� en pre_system
 * pour g�n�rer les appels aux mod�les, librairies et vues.
 * De plus le chargement des vues peut se faire automatiquement encapsul�
 * dans un template parent
 *
 * @package customCI-by-MB&JD
 * @author  Jerome.Demonchaux@gmail.com
 * @see hooks/versions_functions.php
 * @copyright  MB&JD March-April 2015
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');


/**
  * Chargement d'un mod�le avec son numero de version
  * pour le module du controller ou enventuellemnt le module sp�cif� 
  *
  * @author Marie.Barbier.work@gmail.com
  *
  * @param String $filename le nom du mod�le
  * @param String $module le nom du module, si chaine vide utilise le module du controller
  *
  * @return void
  */
if (!function_exists('load_model'))
{
  function load_model($filename, $module="") 
  {
        //acc�s � tous les outils du controller
    $CI = get_instance(); 
        //par defaut, on utilise le module courrant
    if($module===""){
      $module = $CI->module; 
    }
        //le mod�le est toujours stock� dans un dossier comporant la version du module
        //utilisation directe des fonctions de versios d�j� charg�es par le hook pre_system
    $module_full_name = get_module_versioned_name($CI->config->item('versions'),$module);
        //puis appel standard � la m�thode load du controller
    $CI->load->model($module_full_name."/".$filename);
  }
}

/**
  * Chargement d'une librairie d'un autre module avec son numero de version
  *
  * @author Marie.Barbier.work@gmail.com
  *
  * @param String $filename le nom de la librairie
  * @param String $module le nom du module, si chaine vide utilise le module du controller
  *
  * @return void
  */
if (!function_exists('load_library'))
{
  function load_library($filename, $module="") 
  {
        //acc�s � tous les outils du controller
    $CI = get_instance(); 
        //par defaut, on utilise le module courrant
    if($module===""){
      $module = $CI->module; 
    }
        //les librairies sont toujours stock�es dans un dossier comporant la version du module
        //utilisation directe des fonctions de versios d�j� charg�es par le hook pre_system
    $module_full_name = get_module_versioned_name($CI->config->item('versions'),$module);
        //puis appel standard � la m�thode load du controller
        //var_dump($module_full_name."/".$filename);
    $CI->load->library($module_full_name."/".$filename);
  }
}


/**
  * Chargement d'une vue d'un autre module avec son numero de version
  * encaspul�e dans le template sp�cifi�
  *
  * @author Marie.Barbier.work@gmail.com
  * @see libraries/template.php
  *
  * @param String $filename le nom de la vue
  * @param array $data les donn�es envoy�es aux vues
  * @param String $template le nom du template d'encapsulation de la vue
  * @param array $template_data les donn�es envoy�es au layout
  * @param String $module le nom du module, si chaine vide utilise le module du controller
  *
  * @return void
  */
if (!function_exists('load_templated_view'))
{
  function load_templated_view($filename, $data = '', $template, $templat_data, $module="") 
  {
        //acc�s � tous les outils du controller
    $CI = get_instance(); 
        //par defaut, on utilise le module courrant
    if($module===""){
      $module = $CI->module; 
    }
        //la vue est toujours stock�e dans un dossier comporant la version du module
        //utilisation directe des fonctions de versios d�j� charg�es par le hook pre_system
    $module_full_name = get_module_versioned_name($CI->config->item('versions'),$module);

        //passer les params au template
    $CI->template->set('metadata',$CI->metadata);
    foreach ($templat_data as $key => $value) {
      $CI->template->set($key,$value);
    }

        //puis appel � la m�thode chargeant la vue dans un template
    $CI->template->load($template, $module_full_name."/".$filename, $data);

  }
}

/**
  * Chargement d'une vue d'un autre module avec son numero de version
  * encaspul�e dans le template par defaut sp�cifi� dans la configuration
  *
  * @author Jerome.Demonchaux@gmail.com
  * @see libraries/template.php
  *
  * @param String $filename le nom de la vue
  * @param array $data les donn�es envoy�es aux vues
  * @param String $module le nom du module, si chaine vide utilise le module du controller
  *
  * @return void
  */
if (!function_exists('load_view'))
{
  function load_view($filename, $data = '', $module="")  
  {
        //acc�s � tous les outils du controller
    $CI = get_instance(); 
        //par defaut, on utilise le module courrant
    if($module===""){
      $module = $CI->module; 
    }
        //definition du template par defaut
    $default_template = $CI->config->item("default_template");
        //la vue est toujours stock�e dans un dossier comporant la version du module
        //utilisation directe des fonctions de versios d�j� charg�es par le hook pre_system
    $module_full_name = get_module_versioned_name($CI->config->item('versions'),$module);

        //passer les params au template
    $CI->template->set('metadata',$CI->metadata);
    foreach ($CI->layout_data as $key => $value) {
      $CI->template->set($key,$value);
    }

        //puis appel � la m�thode chargeant la vue dans un template
    $CI->template->load($default_template, $module_full_name."/".$filename, $data);
  }
}

/**
  * Chargement d'une vue d'un autre module avec son numero de version
  * sans template (pour les appel Ajax notamment, ou les prints?)
  *
  * @author Jerome.Demonchaux@gmail.com
  * @see libraries/template.php
  *
  * @param String $module le nom du module
  * @param String $filename le nom de la vue
  * @param array $data les donn�es envoy�es aux vues
  *
  * @return void
  */
if (!function_exists('load_simple_view'))
{
  function load_simple_view($filename, $data = '', $module="")  
  {

        //acc�s � tous les outils du controller
    $CI = get_instance(); 
        //par defaut, on utilise le module courrant
    if($module===""){
      $module = $CI->module; 
    }
        //la vue est toujours stock�e dans un dossier comporant la version du module
        //utilisation directe des fonctions de versios d�j� charg�es par le hook pre_system
    $module_full_name = get_module_versioned_name($CI->config->item('versions'),$module);
        //puis appel standard � la m�thode load du controller
    $CI->load->view($module_full_name."/".$filename, $data);
  }
}
?>