<?php


class Administrator
{
    public $login;
    public $mdp;

    /**
     * __construct
     * @param mixed $pseudo
     * @param mixed $motDePasse
     */
    public function __construct($pseudo,$motDePasse) {
        $this->login=$pseudo;
        $this->mdp=$motDePasse;
    }



}