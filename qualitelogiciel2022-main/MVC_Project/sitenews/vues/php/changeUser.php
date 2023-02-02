<!doctype html>
<html>
<head>
    <meta content="text/html; charset=UTF-8"  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./vues/css/adapt.css">
    <script src="./vues/js/changeUser.js"></script>
    <title>Matériels disponibles</title>
</head>
<body>

<div class="box">
    <form onSubmit="return check()" action="index.php?action=ModifierUtilisateurValidation&id=<?php echo $u[0]["Email"]?>" method="post">
        <label>Nom de famille</label>
        <input id="ln" name="ln" type="text" value="<?php echo $u[0]["Lastname"]?>"><br><br>

        <label>Prénom</label>
        <input id="fn" name="fn" type="text" value="<?php echo $u[0]["Firstname"]?>"><br><br>

        <label>Email</label>
        <input id="mail" name="mail" type="text" value="<?php echo $u[0]["Email"]?>"><br><br>

        <label>Role</label>
        <select name="role">
            <option <?php if ($u[0]["Role"] == 1) {?> selected <?php } ?>>Administrateur</option>
            <option <?php if ($u[0]["Role"] == 0) {?> selected <?php } ?>>Utilisateur</option>
        </select><br><br>

        <input name="Ajouter" type="submit">
    </form>
</div>
</body>
</html>


