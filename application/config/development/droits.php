<?php  
/**
 * Fichier permetant de définir les droits de chaque modules
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
| Droits des actions pour chaques controller dans les modules
|--------------------------------------------------------------------------
| 
|  * Controller Orienté Ressources : COR
|  * Gestion des droits selon le modèle suivantes			ZYXWVLRSMEC sur 11 bits
|      				* Fonction  1 (C) : Création			00000000001 =>  1
|      				* Fonction  2 (E) : Edition				00000000010 =>  2
|      				* Fonction  3 (M) : Modification		00000000100 =>  4
|      				* Fonction  4 (S) : Supression			00000001000 =>  8
|      				* Fonction  5 (R) : Recherche			00000010000 => 16
|      				* Fonction  6 (L) : Listing				00000100000 => 32
|      				* Fonction  7 (V) : Voir Détail			00001000000 => 64
|
|   * le nom des fonctions suivantes reste à définir et leur libellé est a associer dans lang_droit
|      * Fonction  8 (W) : Voir Détail Autre format  (W)	00010000000 =>  128
|      * Fonction  9 (X) : fonction personalisable 1 (X)	00100000000 =>  256
|      * Fonction 10 (Y) : fonction personalisable 2 (Y)	01000000000 =>  512
|      * Fonction 11 (Z) : fonction personalisable 3 (Z)	10000000000 => 1024
|
|  * Controller Orienté Service : COS
|  * Gestion des droits sans modèle 						KJIHGFEDCBA sur 11 bits 
|  * à définir par ordre de fréquence d'utilisation
|										* Service A :  		00000000001 => 1
|										* Service B :  		00000000010 => 2
|										* Service C :  		00000000100 => 4
|										* Service D :  		00000001000 => 8
|										* 	ect.				...
|										* Service K :		10000000000 => 1024
|
*/

//Droits pas defaut pour les Controller Orientés Ressources
$droit_COR = array(	"creer" 			=> 1,	//C
							"creer_action" 		=> 1,	//C
							"editer" 			=> 2,	//E
							"modifier"			=> 4,	//M
							"modifier_action"	=> 4,	//M
							"supprimer_action"	=> 8,	//S
							"rechercher"		=> 16,	//R
							"rechercher_action" => 16,	//R
							"lister"			=> 32,	//L
							"voir_detail"		=> 64	//V
							//W, X, Y, Z => à définir précisément pour chaque controller
							);

// Définition des droits pour chaque Module/Controller 
// $config['droits']["Module"]['Controller']
// extentions droits COR et definition droits COS

//TOUT ce qui n'est pas Défini ICI fonctione selon des droits "PUBLIC" --> controller accessibles sans être connectés

$config['droits']["Projet"]['Tache'] = array_merge(	$droit_COR, 
													//extention droits COR
													array(	"voir_detail_autre"	=>	128, //W
															"fonction_perso_X"	=>	256, //X
															"fonction_perso_Y"	=>	512, //Y
															"fonction_perso_Z"	=>	1024 //Z
														));	


												//definition droits COS
$config['droits']["Projet"]['Planification'] = array(	"gantt" 	=> 1, 	//A
														"todoListe"	=> 2 	//B
														// "" 		=> 4 	//C
													);				

												//definition droits COS
$config['droits']["Notation"]['Evaluation'] = array(	"harmonisation" 		=> 1, 	//A
												"harmonisation_action"	=> 1,	//A
												"noterGroupe"			=> 2,	//B
												"noterGroupe_action"	=> 2 	//B
												// "" 		=> 4 	//C
													);	

												//definition droits COS
$config['droits']["Notation"]['Ressources'] = array(	"listeItem" 	=> 1, 	//A
														"importerItem"	=>2
												// "" 		=> 4 	//C
													);	

												//definition droits COS
$config['droits']["Notation"]['Resultats'] = array(	"home" 		=> 1, 	//A
													"podium" 	=> 2, 	//B
													"scores" 	=> 4, 	//C
													);	






