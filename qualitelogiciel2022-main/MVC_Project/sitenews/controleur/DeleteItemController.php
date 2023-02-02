<?php


class DeleteItemController
{
    /**
     * __construct
     *@return void
     *This function is the constructor for the DeleteItemController class.
    */
    public function __construct()
    {
        global $con;
        $gtMateriel = new GatewayMateriel($con);
        $id = $_GET["id"];
        $gtMateriel->deleteItemFromId($id);
    }

}