<?php

class NonUserControl
{
    /**
     * __construct
     *@return void
     *This function is the constructor for the NonUserControl class.
    */
    function __construct() {

        global $vues;
        try {
            $action = $_REQUEST['action'] ?? NULL;
            switch ($action) {
                case NULL: //Cas où c'est un visiteur (première visite)
                    $this->casNull();
                    break;

                case "connection" : //page connection
                    $this->casConnexion();
                    break;

                case "Details" :
                    $this->casDetail();
                    break;

                case "SeConnecter" : //action de se connecter (depuis la page connexion)
                    $this->casSeConnecter();
                    break;

                default:
                    $this->casDefault();
                    break;
            }
        }
        catch (PDOException $e)
		{
            $codeErreur = $e;
            require_once($vues['erreur']);
        }
		catch (Exception $e2)
		{
            $codeErreur = $e2;
            require ($vues['erreur']);
        }
	}

	/*
	 * Fonctions appelées du constructeur de NonNonUserControl
	 * ==============================================
	 * @function casNull()
	 * @function casCliquerNew()
	 * @function casChercher()
	 * @function casConnexion()
	 * @function casSeConnecter()
	 * @function casPosterCommentaire()
	 * @function casDefault()
	 */

    /**
     * Summary of casNull
     * @return void
     */
	function casNull() {
        global $vues;
        global $con;
        $role=ModelAdministrator::isAdmin();
        $login=ModelAdministrator::isLogin();
        $gtMaterials = new GatewayMateriel($con);
        $materials = $gtMaterials->getListMateriel();
        // require_once($vues['login']);
        unset($_SESSION["login"]);
        include('.\vues\php\header.php');
        include('.\vues\php\Materiels.php');
    }

    /**
     * Summary of casConnexion
     * @return void
     */
    function casConnexion() {
        global $vues;
        $role=ModelAdministrator::isAdmin();
        require_once($vues['login']);
    }

    /**
     * Summary of casDetail
     * @return void
     */
    function casDetail() {
        global $con;
        $gtwMat = new GatewayMateriel($con);
        if ($gtwMat->itemExists($_GET["produit"])) {
            global $mat;
            $id=$_GET["produit"];
            $model=new ModelMateriel();
            $mat = $model->getMaterielDetail($id);
            $model=new ModelMateriel();
            $itemIsBorrowed = $model->getBorrowInfo($id);
            include ('.\vues\php\header.php');
            include('.\vues\php\detailMateriel.php');
        }

    }

    /**
     * Summary of casSeConnecter
     * @return void
     */
    function casSeConnecter() {
        global $vues;
        $CodeConnection=$this->VerifCompte();
        $role=ModelAdministrator::isAdmin();
        if($CodeConnection==0) {
            require_once($vues['login']);
        }
        else {
            $this->AttributionRole();
            header("location: index.php");
        }
    }

    /**
     * Summary of casDefault
     * @return void
     */
    function casDefault() {
        global $vues;
        $codeErreur = "Erreur dans l'URL";
        require($vues['erreur']);
    }

    /*
     * Fonctions appelées de celles présentes dans le constructeur (celles plus haut)
     * ==============================================================================
     * @cliquerNews()
     * @cliquerNews_Com()
     * @VerifCompte()
     * @ajoutCommentaire()
     * @NbNews()
     * @NbNewsDate()
     * @ArtPagination($premierArt,$artParPage)
     *      @param $premierArt : premier article de la page actuelle
     *      @param $premierArt : nombre d'article par page à afficher
     * @rechercheNewsPage(int $premiereNews,int $NbNews)
     *      @param $premiereNews : premier actuelle de la page actuelle pour la date cherché
     *      @param $NbNews : nombre d'article par page à afficher
     */

    /**
     * Summary of VerifCompte
     * @return int
     */
    function VerifCompte() {
        $model=new modelAdministrator();
        $login=$_POST['login'];
        $mdp=$_POST['motDePasse'];
        if(isset($login) && isset($mdp)){
            $login=Validation::Nettoyer_string($login);
            $mdp=Validation::Nettoyer_string($mdp);
        }
        $codeCon=$model->getCodeVerifCompte($login,$mdp);
        if($codeCon==1) {
            $_SESSION['login']=$login;
            // $_SESSION['role']="Admin";
        }
        return $codeCon;
    }

    /**
     * Summary of AttributionRole
     * @return void
     */
    function AttributionRole() {
        $model = new modelNonUser();
        $login=$_POST['login'];
        $role=$model->checkStatusCompte($login);
        if($role==0) {$_SESSION['role']="User";}
        else $_SESSION['role']="Admin"; //role=1
    }

}