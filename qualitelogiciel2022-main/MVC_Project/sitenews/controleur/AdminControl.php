<?php


class AdminControl
{
    /**
     * __construct
     *@return void
     *This function is the constructor for the AdminControl class.
    */
    function __construct() {
        global $vues;
        try {
            $action = $_REQUEST['action'] ?? NULL;
            switch ($action) {
                case NULL: //Cas où c'est un admin (sur la page d'accueil)
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

                case "Supprimer" :
                    $this->casSupprimer();
                    break;

                case "Modifier" :
                    $this->casModifier();
                    break;

                case "ModifierMaterielValidation" :
                    $this->casModifierValiation();
                    break;

                case "AjouterUtilisateur" :
                    $this->casAjouterUtilisateur();
                    break;

                case "AjouterUtilisateurValidation" :
                    $this->casAjouterUtilisateurValidation();
                    break;

                case "AjouterMateriel" :
                    $this->casAjouterMateriel();
                    break;

                case "AjouterMaterielValidation" :
                    $this->casAjouterMaterielValidation();
                    break;

                case "detailUtilisateur" :
                    $this->casDetailUtilisateur();
                    break;

                case "ModifierUtilisateur" :
                    $this->casModifierUtilisateur();
                    break;

                case "ModifierUtilisateurValidation":
                    $this->casModifierUtilisateurValidation();
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
     * casNull
     *@return void
     *This function displays the home page for an administrator. 
    */
    function casNull() {
        global $vues;
        $currentPage=Validation::prepPageActuelle();
        $role=ModelAdministrator::isAdmin();
        $login=ModelAdministrator::isLogin();

        $materials=$this->getListMateriel();
        $users = $this->getAllUsers();
        include('.\vues\php\header.php');
        include('.\vues\php\Materiels.php');
    }

    /**
     * casDetails
     *@return void
     *This function displays the details of a specific material.
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
     * casBorrowing
     *@return void
     *This function handles the borrowing of a material. It creates a BorrowingController object and redirects the user to the home page.
    */
    function casBorrowing() {
        $borrowing = new BorrowingController();
        header("location: index.php");
    }

    /**
     * casSupprimer
     *@return void
     *This function deletes a material from the database. 
    */
    function casSupprimer() {
        $suppr = new DeleteItemController();
        header("location: index.php");
    }

    /**
     * casModifier
     *@return void
     *This function displays a form for the administrator to edit the details of a material. 
    */
    function casModifier() {
        $mat = ItemController::getItemFromId();
        include ('.\vues\php\header.php');
        include('.\vues\php\changeItem.php');
    }

    /**
     * casModifierValidation
     *@return void
     *This function updates the details of a material in the database. 
    */
    function casModifierValiation() {
        ItemController::changeItem();
        header("location: index.php");
    }

    /**
     * casAjouterUtilisateur
     *@return void
     *This function displays a form for the administrator to add a new user to the database.
    */
    function casAjouterUtilisateur() {
        include ('.\vues\php\header.php');
        include('.\vues\php\addUser.php');
    }

    /**
     * casAjouterUtilisateurValidation
     *@return void
     *This function adds a new user to the database. 
    */
    function casAjouterUtilisateurValidation() {
        AddThingsController::addUser();
        header("location: index.php");
    }

    /**
     * casAjouterMateriel
     *@return void
     *This function displays a form for the administrator to add a new material to the database.
    */
    function casAjouterMateriel() {
        include ('.\vues\php\header.php');
        include('.\vues\php\addItem.php');
    }

    /**
     * casAjouterMaterielValidation
     *@return void
     *This function adds a new material to the database.
    */
    function casAjouterMaterielValidation() {
        ItemController::addItem();
        header("location: index.php");
    }

    /**
     * casDetailUtilisateur
     *@return void
     *This function displays the details of a specific user. 
    */
    function casDetailUtilisateur() {
        $u = $this->getUserFromId($_GET["id"]);
        include ('.\vues\php\header.php');
        include('.\vues\php\detailUtilisateur.php');
    }

    /**
     * casModifierUtilisateur
     *@return void
     *This function displays a form for the administrator to edit the details of a user.
    */
    function casModifierUtilisateur() {
        $u = $this->getUserFromId($_GET["id"]);
        include ('.\vues\php\header.php');
        include('.\vues\php\changeUser.php');
    }

    /**
     * casModifierUtilisateurValidation
     *@return void
     *This function updates the details of a user in the database. 
    */
    function casModifierUtilisateurValidation() {
        $this->changeUser();
        header("location: index.php");
    }

    /**
     * casDeconnexion
     *@return void
     *This function logs the current user out. It unsets the session variable "login" and redirects the user to the login page.
    */
    function casDeconnexion() {
        $role=ModelAdministrator::isAdmin();
        $this->deconnexion();
        header("location: index.php");
    }

    /**
     * casDefault
     *@return void 
     *This function is called if none of the other cases in the constructor are met. It redirects the user to the home page.
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
     * deconnexion
     *@return void
     *This function logs the current user out. It unsets the session variable "login" and redirects the user to the login page.
    */
    function deconnexion() {
        $model=new ModelAdministrator();
        $model->seDeconnecter();
    }

    /**
     * getListMateriel     
     *@return array
     *This function gets the list of all materials from the database.
    */
    function getListMateriel() {
        $model=new ModelMateriel();
        return $model->getListMateriel();
    }

    /**
     * getAllUsers
     *@return array
     *This function get all the users from the database
    */
    function getAllUsers() {
        global $con;
        $model = new GatewayAdmin($con);
        return $model->getAllUsers();
    }

    /**
     * getUserFromId
     *@param int $id
     *@return array
     *This function gets the details of a specific user from the database.
    */
    function getUserFromId($id) {
        global $con;
        $model = new GatewayAdmin($con);
        return $model->getUserFromId($id);
    }

    /**
     * getDetailsMateriel
     *@return array
     *This function gets the details of a specific material from the database.
    */
    function getDetailsMateriel() {
        $id=$_GET["produit"];
        $model=new ModelMateriel();
        return $model->getMaterielDetail($id);
    }

    /**
     * isMaterielBorrowed
     *@return bool
     *This function checks if a specific material is currently borrowed.
    */
    function isMaterielBorrowed() {
        $id = $_GET["produit"];
        $model=new ModelMateriel();
        return $model->getBorrowInfo($id);
    }

    /**
     * changeUser
     *@return void
     *This function updates the details of a user in the database.
    */ 
    function changeUser() {
        global $con;
        $ln = $_POST["ln"];
        $fn = $_POST["fn"];
        $email = $_POST["mail"];
        $r = $_POST["role"];

        $role = 0;
        if ($r == "Administrateur") {
            $role = 1;
        }

        $gtw = new GatewayAdmin($con);
        $gtw->changeUserFromId($_GET["id"], $ln, $fn, $email, $role);
    }
}