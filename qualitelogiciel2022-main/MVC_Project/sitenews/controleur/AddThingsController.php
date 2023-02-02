<?php

class AddThingsController
{
    /**
     * addUser
     *@return void
     *This function adds a user to the database using the POST data sent in the form.
    */
    
    static function addUser() : void {
        $firstName = $_POST["fn"];
        $lastName = $_POST["ln"];
        $email = $_POST["mail"];
        $r = $_POST["role"];

        $role = 0;
        if ($r == "Administrateur") {
            $role = 1;
        }

        $password = $_POST["pass"];

        $passordHashed = password_hash($password, PASSWORD_BCRYPT);

        global $con;
        $gtwAdmin = new GatewayAdmin($con);
        $gtwAdmin->addUser($firstName, $lastName, $email, $role, $passordHashed);
    }

    /**
     * addItem
     *@return void
     *This function adds an item to the database using the POST data sent in the form.
    */
    static function addItem() : void {
        $name = $_POST["name"];
        $version = $_POST["version"];
        $reference = $_POST["ref"];
        $type = $_POST["type"];
        $brand = $_POST["brand"];
        $picture = $_POST["url"];
        $phoneNumber = $_POST["phoneNumber"];

        global $con;
        $gtwAdmin = new GatewayAdmin($con);
        $gtwAdmin->addItem($name, $version, $reference, $type, $brand, $picture, $phoneNumber);
    }

}