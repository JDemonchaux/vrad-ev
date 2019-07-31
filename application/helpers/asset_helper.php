<?php
/**
 * Construction des balises permetant d'appeler et d'inclure des medias
 * de type css, js ou image depuis leur emplacement par defaut : asset/mediatype/...
 * //TODO ajouter le traitement par lot (batch_css, batch_js)
 * //TODO remplacer les return par des echo ?
 *
 * @package customCI-by-MB&JD
 * @author  Jerome.Demonchaux@gmail.com
 * @copyright   reserved
 * @license reserved
 * @since   Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
  * Création de la balise d'inclusion d'un CSS rangé dans asset
  *
  * @author Jerome.Demonchaux@gmail.com
  *
  * @param String $filename le nom du fichier css (sans l'extension)
  *
  * @return String la balise d'inclusion du css
  */
if (!function_exists('css_url')){
	function css_url($filename){
		return '<link rel ="stylesheet" href="'.base_url().'assets/css/'.$filename.'.css" />';
	}
}

/**
  * Création de la balise d'inclusion d'un JS rangé dans asset
  *
  * @author Jerome.Demonchaux@gmail.com
  *
  * @param String $filename le nom du fichier css (sans l'extension)
  *
  * @return String la balise d'inclusion du JS
  */
if (!function_exists('js_url')){
	function js_url($filename){
		return '<script src="'.base_url().'assets/js/'.$filename.'.js" type="text/javascript"></script>';
	}	
}

/**
  * Création de la balise d'inclusion d'un JS rangé dans asset
  *
  * @author Jerome.Demonchaux@gmail.com
  *
  * @param String $file le nom complet du fichier image (avec l'extension)
  * @param String $desc le titre descriptif de l'image pour l'acessibilité
  * @param String $desc la liste des classes css à appliquer à l'image
  *
  * @return String la balise d'inclusion de l'image
  */
if (!function_exists('img_url')){
	function img_url($file, $desc="", $class = ""){
		return '<img title="'.$desc.'" alt="'.$desc.'" src="'.base_url().'assets/img/'.$file.'" class="'.$class.'"/>';
	}
}
?>