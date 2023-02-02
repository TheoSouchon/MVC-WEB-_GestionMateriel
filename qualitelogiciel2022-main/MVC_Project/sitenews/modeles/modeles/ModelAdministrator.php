<?php

use PhpParser\Node\Name;

class modelAdministrator
{
    /**
     * Summary of getCodeVerifCompte
     * @param string $login
     * @param string $mdp
     * @return int
     */
    public function getCodeVerifCompte(string $login, string $mdp) {
        global $con;
        $gtwUser= new GatewayAdmin($con);
        $login=Validation::Nettoyer_string($login);
        $mdp=Validation::Nettoyer_string($mdp);
        return $gtwUser->CheckVerifCompte($login,$mdp);
    }

    /**
     * Summary of seDeconnecter
     * @return void
     */
    public function seDeconnecter() {
        session_unset();
        session_destroy();
        $_SESSION = array();
        Validation::prepSession();
    }

    /**
     * Summary of isAdmin
     * @return string
     */
    public static function isAdmin() {
        if(isset($_SESSION['role'])) {
            $status=Validation::Nettoyer_string($_SESSION['role']);
            if($status=="Admin"){
                return "Admin";
            }
            if($status=="User") {
                return "User";
            }else return "NonUser";
        }
        else return "NonUser";
    }

    /**
     * Summary of isLogin
     * @return null|string
     */
    public static function isLogin() {
            if(isset($_SESSION['login'])) {
                $login=Validation::Nettoyer_string($_SESSION['login']);
                return $login;

            }
            return null;
    }
}