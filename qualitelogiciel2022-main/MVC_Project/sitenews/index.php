
<?php

require_once(__DIR__.'/config/config.php');
require_once(__DIR__.'/config/Autoload.php');

Autoload::charger();
$CtrlUser = new FrontControlleur();

/*
if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] != "") {
        $url = "Items";
        // On identifie le contrôleur à appeler dont le nom est contenu dans cible passé en GET
        if(isset($_GET['cible']) && !empty($_GET['cible'])) {
            // Si la variable cible est passé en GET
            $url = $_GET['cible'];
            $isPage = true;
        }

        //include('controleur\\' . $url . 'Controller.php');
    }
}
*/







