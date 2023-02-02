<!DOCTYPE html>
<html lang="fr">
<head lang="fr">
    <meta content="text/html; charset=UTF-8"  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./vues/css/adapt.css">
    <title>Matériels disponibles</title>
</head>

<body>
<div class=box>
    <h3>Matériels : </h3>
    <table>
        <?php
        foreach ($materials as $m) {
            ?>
            <tr>
                <td>
                    <?php
                    echo $m["Name"];
                    ?>
                </td>
                <td>
                    <?php
                    echo $m["Type"];
                    ?>
                </td>
                <td>
                    <?php
                    echo $m["Brand"];
                    ?>
                </td>
                <td>
                    <?php
                    echo $m["PhoneNumber"];
                    ?>
                </td>
                <td>
                    <a href="index.php?action=Details&cible=detail&produit=<?php echo $m["Reference"]?>">Détails</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table><br>

    <?php
    $status=ModelAdministrator::isAdmin();
    if ($status == "Admin") { ?>
    <h3>Utilisateurs :</h3>
        <?php foreach ($users as $u) { ?>
            <tr>
                <td><?php echo $u["Lastname"]?></td>
                <td><?php echo $u["Firstname"]?></td>
                <td>
                    <a href="index.php?action=detailUtilisateur&id=<?php echo $u["Email"]?>">Détails</a>
                </td>
            </tr><br>
        <?php }
    } ?>
        <table>
            <tr>
                <td></td>
            </tr>
        </table>


</div>

</body>

</html>
