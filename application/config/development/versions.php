<?php  
/**
 * Fichier permetant de définir les versions de chaque modules
 * dans le cadre de la gestion facilité de plusieurs version d'un même modules
 * Dans le cas ou des versions differents soient déployées 
 * sur differents environements de production
 *
 * @package	customCI-by-MBwork
 * @author	Marie.Barbier.work@gmail.com
 * @copyright	reserved
 * @license	reserved
 * @since	Version 1.0.0
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Versions des modules
|--------------------------------------------------------------------------
|
| Versions pour chaque modules livrés dans l'application cliente
| sous forme d'un tableau ayant pour indice le nom du module
| et en valeur la version au format X-Y
| (utilisation de tiret "-" et non de points "."
| pour assurer la compatibilité avec les noms de dossiers et fichiers
|
| Exemple : 
| $config['versions']["Module"]= '1-0';
|
| Les noms de Modules doivent commencer par une MAJUSCULE
| et ne pas contenir d'espaces ni de caractères accentués ou caractères spéciaux
| à l'exeption du tiret "-" et de l'underscore "_" 
| en cas de nom de modules composés de plusieurs mots
| mais dans tous les cas il faut privilegier les Modules avec un seul MOT
| ne pas utiliser DIRECTORY_SEPARATOR
|
*/

$config['versions']['show_in_URL']=TRUE; //!IMPORTANT LAISSER TRUE EN DEV (mais FLASE en prod)

//$config['versions']["Error"]['DefaultRoute'] = "Controller1"."/"."action1";

//Modules Transverseaux
$config['versions']["Error"]['v']= '1';
$config['versions']["ToolBox"]['v']= '1';
$config['versions']["Tests"]['v']= '1';

//Modules livrés
$config['versions']["User"]['v']= '1';
$config['versions']["User"]['DefaultRoute']["module"] = "Connexion"."/"."login";

$config['versions']["Projet"]['v'] = '1-1';
$config['versions']["Projet"]['DefaultRoute']["module"] = "Planification"."/"."gantt";
$config['versions']["Projet"]['DefaultRoute']['Tache'] = "lister";
$config['versions']["Projet"]['DefaultRoute']['Planification'] = "gantt";			

$config['versions']["Notation"]['v']= '1-1';
$config['versions']["Notation"]['DefaultRoute']["module"] = "Jury"."/"."harmonisation";
$config['versions']["Notation"]['DefaultRoute']["Jury"] = "harmonisation";
$config['versions']["Notation"]['DefaultRoute']["Ressources"] = "listeItem";
$config['versions']["Notation"]['DefaultRoute']["Resultat"] = "home";


//Exemples
//cet exemple marchera dans cette environement
$config['versions']["Module_Dev"]['v']= '1-1';
$config['versions']["Module_Dev"]['DefaultRoute']["module"] = "Controller1"."/"."action1";
//cet exemple ne marchera pas dans cet environement car le dossier Module_Prod_v1-0 n'exsite pas
$config['versions']["Module_Prod"]['v']= '1-0';
$config['versions']["Module_Prod"]['DefaultRoute']["module"] = "Controller1"."/"."action1";


