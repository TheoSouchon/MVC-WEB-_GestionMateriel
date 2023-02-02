<?php

class ItemController
{
    private $con;
    /**
     * Summary of __construct
     * @param mixed $db
     * @return void
     *This function is the constructor for the ItemController class.
     */
    public function __construct($db)
    {
        $this->con = $db;
    }

    /**
     * Summary of getItemFromId
     * @return array
     */
    static function getItemFromId() : array {
        global $con;
        $gtwMat = new GatewayMateriel($con);
        $mat = $gtwMat->getDetailMateriel($_GET["id"]);
        return $mat;
    }

    /**
     * Summary of changeItem
     * @return void
     */
    static function changeItem() {
        $name = $_POST["name"];
        $version = $_POST["version"];
        $reference = $_POST["ref"];
        $brand = $_POST["brand"];
        $picture = $_POST["url"];
        $phoneNumber = $_POST["phoneNumber"];
        $type = $_POST["type"];

        global $con;
        $gtwMat = new GatewayMateriel($con);
        $gtwMat->changeItemFromId($_GET["id"], $name, $version, $reference, $type, $brand, $picture, $phoneNumber);
    }

    /**
     * Summary of addItem
     * @return void
     */
    static function addItem() {
        $name = $_POST["name"];
        $version = $_POST["version"];
        $reference = $_POST["ref"];
        $brand = $_POST["brand"];
        $picture = $_POST["url"];
        $phoneNumber = $_POST["phoneNumber"];
        $type = $_POST["type"];

        global $con;
        $gtwMat = new GatewayMateriel($con);
        $gtwMat->addItem($name, $version, $reference, $type, $brand, $picture, $phoneNumber);
    }

}