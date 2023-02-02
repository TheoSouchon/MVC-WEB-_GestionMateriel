<?php

class GatewayNonUser
{
    private $con;

    /**
     * Summary of __construct
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * Summary of CheckStatusCompte
     * @param string $login
     * @return int
     */
    public function CheckStatusCompte(string $login) : int {
        $request = "select Role from users where Email='$login';";
        $prepared = $this->con->prepare($request);
        $prepared->execute();
    
        $results = $prepared->fetchAll();
        foreach ($results as $row) {
            //mdp2 : mot de passe de "Email" dans la bdd
            return  $row['Role'];
        }
    }

}