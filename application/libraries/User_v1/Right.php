<?php

/**
 * user short summary.
 *
 * user description.
 *
 * @version 1.0
 * @author J??r??me
 */
class right {

    public function __construct() {
        
    }
    
    
    public function checkAuthorization() {
        $user = $_SESSION["user"];
        $page = uri_string(); 
        $uriPath = explode("/",$page);
        $controller = $uriPath[0];
        $action =$uriPath[1];
        if (!$user->getRight($controller, $action) === true) {
            //TODO rediriger ves error_405
            redirect(index_page());
            return false;
        }else{
            return true;
        }
    }

    public function getAllPages() {
        $rights = array();

        //doit retourner toutes les pages possible du site 
        //=> tous les controllers avec toutes leur actions publiques
        // on doit cr??er des role, tel que le role "non connect??" 
        // il nous faut un utilisateur anomymous 
        // a qui on donnera les droits de tous ce qui ne necessite pas de droits
        //soit je charge tous les controller pour en extraire toutes leur fonctions (mais ca risque d'etre consomatueur)
        //$arr = get_defined_functions();
        //get_declared_classes()
        //soit je lis dans les fichiers php pour les parser et en sortir lesfonctions...
        //$rights["controller"]["action"]=0;

        $lesControllers = glob("application/controllers/*.php");

        //exlusion des fichiers de Tests_Unitaires
        foreach ($lesControllers as $controllerPath) {
            if (preg_match("/(.*)Tests_(.*)/", $controllerPath) === 0) {
                $lesControllersAcessibles[] = $controllerPath;
            }
        }


        foreach ($lesControllersAcessibles as $file) {
            
            //extraction du nom du controller
            $pahtAnalyse = explode("/", $file);
            $controllerFile = $pahtAnalyse[sizeof($pahtAnalyse) - 1];
            $controllerName = explode(".", $controllerFile)[0];

            // dans chaque fichier recherche de tous les paterns : "public function inscriptionParticipant("
            $fileRessource = fopen($file, 'r');
            $contentFile = fread($fileRessource, filesize($file));
            $patternControllerAction = "/public function (.*)[(]/"; //public function [^(AJAX_)][A-Za-z]*[(]
            preg_match_all($patternControllerAction, $contentFile, $resulatFindMatch, PREG_PATTERN_ORDER);

            foreach ($resulatFindMatch[0] as $controllerFonction) {
                //extraction du nom de l'action
                $nameAnalyse = explode(" ", $controllerFonction);
                $nameFonction = $nameAnalyse[sizeof($nameAnalyse) - 1];
                $nameFonction[strlen($nameFonction) - 1] = ""; //enl?ve le dernier caract?re : "("
                $action = $nameFonction;

                //pas de demande de droit pour les url "masqu?" appel?es en appel retour ou ajax
                $paternPrefixe = "/[A-Za-z]*_/";
                preg_match($paternPrefixe, $controllerFonction, $prefixeFound);
                if ($prefixeFound != "AJAX_") { //TODO exclure tout les prefixe
                    $rights[$controllerName][$action]["url"] = site_url(array($controllerName,$action));
                    $rights[$controllerName][$action]["name"] = "";// comment gère-t-on cela? avec une annotation?? une nomenclauture du nom des fonctions de controller?
                    $rights[$controllerName][$action]["allow"] = FALSE;
                }
            }

            return $rights;
        }
    }


}