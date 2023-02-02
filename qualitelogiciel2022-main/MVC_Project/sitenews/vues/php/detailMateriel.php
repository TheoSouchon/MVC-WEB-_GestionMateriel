<!DOCTYPE html>
<html lang="fr">
<head lang="fr">
    <meta content="text/html; charset=UTF-8"  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./vues/css/adapt.css">
    <title>Matériels disponibles</title>
    <script src="./vues/js/detailMateriel.js"></script>
</head>

<div class="box">
    <h2><u>Nom du produit :</u> <?php  echo $mat[0]["Name"]?></h2>
    <h2><u>Version :</u> <?php echo $mat[0]["Version"]?></h2>
    <h2><u>Reference :</u> <?php echo $mat[0]["Reference"]?></h2>
    <h2><u>Type de produit :</u> <?php echo $mat[0]["Type"]?></h2>
    <h2><u>Marque :</u> <?php echo $mat[0]["Brand"]?></h2><br>
    <?php
    if (isset($mat[0]["PhoneNumber"])) {  ?>
        <h2><u>Numéro de téléphone :</u> <?php echo $mat[0]["PhoneNumber"]?></h2>
    <?php } ?>

    <?php if ($itemIsBorrowed) { ?>
        <h3 style="color: red">Cet appreil est actuellement emprunté</h3><br>
    <?php } else { ?>
        <h3 style="color: green">Cet appreil est disponible</h3><br>
    <?php } ?>


    <?php
    $status=ModelAdministrator::isAdmin();
    if ($status != "NonUser") {
        if (count($borrowingR) > 0) { ?>
            <h2>Historique de vos emprunts : </h2>
        <?php } ?>
    <ul>
        <?php
        foreach ($borrowingR as $bo) { ?>
            <li>Emprunté le <?php echo $bo["BorrowingDate"]?>, rendu le <?php echo $bo["DeliveryDate"]?></li>
        <?php } ?>

    </ul><br>
    <?php } ?>
    <?php

    $status=ModelAdministrator::isAdmin();
    if (isset($_SESSION["login"])) {
    if ($status == "Admin" || $status == "User") {
        if (!$itemIsBorrowed) { ?>
            <button id="BorrowingButton">Emprunter le produit</button><br>
            <form id="BorrowingForm" action="index.php?action=Borrowing&id=<?php echo $mat[0]["Reference"]?>" method="post">
                <label>Date à laquelle vous devrez rendre le produit</label><br><br>
                <input name="date" id="BorrowingDateInput" type="date">

                <input id="BorrowingSubmit" type="submit" value="Envoyer">
            </form><br>
        <?php }
            if ($status == "Admin") { ?>
                <a href="index.php?action=Modifier&id=<?php echo $mat[0]["Reference"]?>">Modifier le produit</a><br><br>
                <a href="index.php?action=Supprimer&id=<?php echo $mat[0]["Reference"]?>">Supprimer le produit</a><br><br>
            <?php } ?>




    <?php } } ?>
</div>

</body>

</html>