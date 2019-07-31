<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
|
*/
$config['versions']['show_in_URL']=FLASE; //!IMPORTANT LAISSER FALSE EN PROD
//cet exemple ne marchera pas dans cet environement car le dossier Module_Dev n'exsite pas
$config['versions']["Module_Dev"]['v']= '1-1';
$config['versions']["Module_Dev"]['DefaultRoute'] = "Controller1"."/"."action1";
//cet exemple  marchera  dans cet environement
$config['versions']["Module_Prod"]['v']= '1-0';
$config['versions']["Module_Prod"]['DefaultRoute'] = "Controller1"."/"."action1";
