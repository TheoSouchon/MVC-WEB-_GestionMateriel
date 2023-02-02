<?php

class modelNonUser
{
    /**
     * Summary of checkStatusCompte
     * @param string $login
     * @return int
     */
    public function checkStatusCompte(string $login) {
        global $con;
        $gtwUser= new GatewayNonUser($con);
        $login=Validation::Nettoyer_string($login);
        return $gtwUser->checkStatusCompte($login);
    }

}