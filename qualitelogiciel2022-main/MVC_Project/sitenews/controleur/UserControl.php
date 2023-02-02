<?php
require_once(__DIR__.'./BorrowingController.php');
class UserControl
{
    /**
     * __construct
     *@return void
     *This function is the constructor for the UserControl class.
    */
    function __construct() {
        global $vues;
        try {
            $action = $_REQUEST['action'] ?? NULL;
            switch ($action) {
                case NULL: //Cas où c'est un user (sur la page d'accueil)
                    $this->casNull();
                    break;

                case"Deconnexion":
                    $this->casDeconnexion();
                    break;

                case "Details":
                    $this->casDetails();
                    break;

                case "Borrowing" :
                    $this->casBorrowing();
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
            $codeErreur[] = "$e2";
            require ($vues['erreur']);
        }
    }

    /*
	 * Fonctions appelées du constructeur de UserControl
	 * ==============================================
	 * @function casNull()
	 * @function casCliquerNew()
	 * @function casChercher()
	 * @function casCreerArt()
	 * @function casAjoutArt()
	 * @function casPosterCommentaire()
     * @function casDeconnexion()
	 * @function casDefault()
	 */

    /**
     * Summary of casNull
     * @return void
     */
    function casNull() {
        global $vues;
        $currentPage=Validation::prepPageActuelle();
        $role=ModelAdministrator::isAdmin();
        $login=ModelAdministrator::isLogin();

        $materials=$this->getListMateriel();
        include('.\vues\php\header.php');
        include('.\vues\php\Materiels.php');
    }

    /**
     * Summary of casDetails
     * @return void
     */
    function casDetails() {
        // Test si materiel existe
        global $con;
        $gtwMat = new GatewayMateriel($con);
        if ($gtwMat->itemExists($_GET["produit"])) {
            global $mat;
            $mat=$this->getDetailsMateriel();
            $itemIsBorrowed = $this->isMaterielBorrowed();
            $borrowingR = $gtwMat->borrowingHistoryUser($_SESSION["login"], $_GET["produit"]);
            include ('.\vues\php\header.php');
            include('.\vues\php\detailMateriel.php');
        } else {
            header("location: index.php");
        }
    }

    /**
     * Summary of casBorrowing
     * @return void
     */
    function casBorrowing() {
        $borrowing = new BorrowingController();
        header("location: index.php");
    }

    /**
     * Summary of casDeconnexion
     * @return void
     */
    function casDeconnexion() {
        $role=ModelAdministrator::isAdmin();
        $this->deconnexion();
        header("location: index.php");
    }

    /**
     * Summary of casDefault
     * @return void
     */
    function casDefault() {
        global $vues;
        require($vues['erreur']);
    }

    


    /*
     * Fonctions appelées de celles présentes dans le constructeur (celles plus haut)
     * ==============================================================================
     * @RecupNews()
     * @cliquerNews()
     * @cliquerNews_Com()
     * @ajoutArticle()
     * @ajoutCommentaire()
     * @deconnexion()
     * @NbNews()
     * @NbNewsDate()
     * @rechercheNewsPage()
     * @ArtPagination($premierArt,$artParPage)
     *      @param $premierArt : premier article de la page actuelle
     *      @param $premierArt : nombre d'article par page à afficher
     * @rechercheNewsPage(int $premiereNews,int $NbNews)
     *      @param $premiereNews : premier actuelle de la page actuelle pour la date cherché
     *      @param $NbNews : nombre d'article par page à afficher
     */

    /**
     * Summary of deconnexion
     * @return void
     */
    function deconnexion() {
        $model=new ModelAdministrator();
        $model->seDeconnecter();
    }

    /**
     * Summary of getListMateriel
     * @return array
     */
    function getListMateriel() {
        $model=new ModelMateriel();
        return $model->getListMateriel();
    }

    /**
     * Summary of getDetailsMateriel
     * @return array
     */
    function getDetailsMateriel() {
        $id=$_GET["produit"];
        $model=new ModelMateriel();
        return $model->getMaterielDetail($id);
    }

    /**
     * Summary of isMaterielBorrowed
     * @return bool
     */
    function isMaterielBorrowed() {
        $id = $_GET["produit"];
        $model=new ModelMateriel();
        return $model->getBorrowInfo($id);
    }

}