<!doctype html>
<html>
<head>
    <meta content="text/html; charset=UTF-8"  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./vues/css/adapt.css">
    <script src="./vues/js/checkItem.js"></script>
    <title>Matériels disponibles</title>
</head>
<body>

<div class="box">
    <form onSubmit="return check()" action="index.php?action=ModifierMaterielValidation&id=<?php echo $mat[0]["Reference"]?>" method="post">
        <label>Nom de l'appareil</label>
        <input id="name" name="name" type="text" value="<?php echo $mat[0]["Name"]?>"><br><br>

        <label>Version</label>
        <input id="version" name="version" type="text" value="<?php echo $mat[0]["Version"]?>"><br><br>

        <label>Reference</label>
        <input id="ref" name="ref" type="text" value="<?php echo $mat[0]["Reference"]?>"><br><br>

        <label>Type</label>
        <input type="text" id="type" value="<?php echo $mat[0]["Type"]?>"><br><br>

        <label>Marque</label>
        <input id="brand" name="brand" type="text" value="<?php echo $mat[0]["Brand"]?>"><br><br>

        <label>Lien de l'image</label>
        <input name="url" type="text" value="<?php echo $mat[0]["Picture"]?>"><br><br>

        <?php if ($mat[0]["Type"] == "Telephone") {?>
            <label>Numéro de téléphone</label>
            <input id="phoneNumber" name="phoneNumber" type="text" value="<?php echo $mat[0]["PhoneNumber"]?>"><br><br>
        <?php } ?>

        <input name="Ajouter" type="submit">
    </form>
</div>
</body>
</html>


