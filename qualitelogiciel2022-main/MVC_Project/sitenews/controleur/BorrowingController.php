<?php

include('./modeles/gateways/GatewayBorrowing.php');

/**
 *BorrowingController
 *@return void
 *Initializes variables and calls borrowing function in GatewayBorrowing class
*/
class BorrowingController {
    function __construct()
    {
        $reference = $_GET["id"];
        $dateDelivery = $_POST["date"];
        $user = $_SESSION["login"];
        $dateToday = new DateTime();
        $dateTodayFormat = $dateToday->format("Y-m-d");

        global $con;
        $borr = new GatewayBorrowing($con);
        $borr->borrowing($reference, $user, $dateTodayFormat, $dateDelivery);
    }
}
?>
