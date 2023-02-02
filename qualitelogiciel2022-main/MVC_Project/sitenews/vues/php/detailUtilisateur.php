<!DOCTYPE html>
<html lang="fr">
<head lang="fr">
    <meta content="text/html; charset=UTF-8"  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./vues/css/adapt.css">
    <title></title>
</head>

<body>
<div class="box">
    <h2>Nom de famille : <?php echo $u[0]["Lastname"]?></h2>
    <h2>Prénom : <?php echo $u[0]["Firstname"]?></h2>
    <h2>Adresse mail : <?php echo $u[0]["Email"]?></h2>
    <h2>Role : <?php if ($u[0]["Role"] == 0)
            echo "Utilisateur";
        else
            echo "Administrateur";
        ?></h2><br>

    <a href="index.php?action=ModifierUtilisateur&id=<?php echo $u[0]["Email"]?>">Modifier</a>
</div>


</body>
</html>