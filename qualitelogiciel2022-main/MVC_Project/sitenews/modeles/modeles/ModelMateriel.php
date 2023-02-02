<?php

use SebastianBergmann\Environment\Console;

class modelMateriel
{
    /**
     * Summary of getListMateriel
     * @return array
     */
    public function getListMateriel() {
        global $con;
        $gtwMateriel= new GatewayMateriel($con);
        return $gtwMateriel->getListMateriel();
    }

    /**
     * Summary of getMaterielDetail
     * @param mixed $id
     * @return array
     */
    public function getMaterielDetail($id) {
        global $con;
        $gtwMateriel = new GatewayMateriel($con);
        return $gtwMateriel->getDetailMateriel($id);
    }

    /**
     * Summary of getBorrowInfo
     * @param mixed $id
     * @return bool
     */
    public function getBorrowInfo($id) {
        global $con;
        $gtwMateriel = new GatewayMateriel($con);
        return $gtwMateriel->getBorrowInfo($id);
    }

    /**
     * Summary of checkCreationMateriel
     * @param mixed $name
     * @param mixed $version
     * @param mixed $reference
     * @param mixed $brand
     * @param mixed $type
     * @param mixed $phoneNumber
     * @return bool
     */
    public function checkCreationMateriel($name,$version,$reference,$brand,$type,$phoneNumber) {
        $pattern="/^[a-zàäâéèêëïîöôùüû\s]*$/i";
        if ($name != "" &&
        $version != "" &&
        $reference != "" &&
        $brand != "" &&
        $type != "") {

        

        // le nom contient des caractères spéciaux
        if (!preg_match($pattern,$name)) {
            return false;
        }
        
        // Le nom est > 30 caractères
        if (strlen($name) > 30) {
            return false;
        }

        // le type contient des caractères spéciaux
        if (!preg_match($pattern,$type)) {
            return false;
        }

        // le type est > 30 caractères
        if (strlen($type) > 30) {
            return false;
        }

        // la marque contient des caractères spéciaux
        if (!preg_match($pattern,$brand)) {
            return false;
        }

        // la marque est > 30 caractères
        if (strlen($brand) > 30) {
            return false;
        }

        // la version a moins de 3 caractères
        if (strlen($version) < 3) {
            return false;
        }

        // la version contient des caractères spéciaux
        if (!preg_match($pattern,$version)) {
            return false;
        }


        // la version contient plus de 15 caractères
        if (strlen($version) > 15) {
            return false;
        }

        // Le numéro de téléphone ne fait pas 10 caractères
        if (strlen($phoneNumber) != 10 && strlen($phoneNumber) != 0) {
            return false;
        }

        return true;
    } else {
        return false;
        }
    }
}