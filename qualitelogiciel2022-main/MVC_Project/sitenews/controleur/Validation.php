<?php


class Validation
{

    /**
     * Nettoyer_string
     *@param string $string
     *@return string
     *This function sanitizes a string by removing any special characters or tags.
    */
    static function Nettoyer_string($string){
        return filter_var($string,FILTER_SANITIZE_STRING);
    }

    /**
     * Nettoyer_int
     *@param string $string
     *@return string
     *This function sanitizes a string by removing all illegal characters from a number..
    */
    static function Nettoyer_int($string){
        return filter_var($string,FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * prepSession
     *@return void
     *This function prepares the session by starting the session if it has not already been started and setting default
     * values for the "login" and "role" session variables if they are not already set.
    */

    static function prepSession(){
        if(session_status() == PHP_SESSION_NONE) {
            session_start();

            if(!isset($_SESSION['login']))
            {
                $_SESSION['login']="";
            }

            if(!isset($_SESSION['role']))
            {
                $_SESSION['role']="Visiteur";
            }
        }
    }

    /**
     * prepTailleTexte
     *@param string $texte
     *@param int $occurence
     *@return string
     *This function formats a string by adding line breaks at specified intervals.
    */
    static function prepTailleTexte(string $texte,int $occurence) :string
    {
        $NouvelleChaine="";


        for ($i = $occurence; $i < (strlen($texte)) ; $i=$i+$occurence) {
            $deb = $i - $occurence;
            $NouvelleChaine = $NouvelleChaine . ($des = substr($texte, $deb, $occurence) . '<br>');

            $nbrmax=$i;
        }
        if(strlen($texte)%$occurence!=0){
            $NouvelleChaine = $NouvelleChaine. $ds = substr($texte,-(strlen($texte)%$occurence));

        }

        if(strlen($texte)%$occurence==0){
            $NouvelleChaine = $NouvelleChaine. $ds = substr($texte,-($occurence));
        }

        return $NouvelleChaine;
    }

    /**
     * CouperTexte
     *@param string $texte
     *@param int $nbr
     *@return string
     *This function truncates a string to a specified length and adds an ellipsis at the end.
    */
    static function CouperTexte(string $texte,int $nbr) :string
    {
           $Chaine=substr($texte,0,$nbr)."<strong> ...</strong>";
           return $Chaine;
    }

    /**
     * prepPageActuelle
     *@return int
     *This function gets the current page number from the GET data.
    */
    static function prepPageActuelle(){
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }
        return $currentPage;
    }

}