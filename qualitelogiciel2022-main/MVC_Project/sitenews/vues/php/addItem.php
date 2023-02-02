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
    <form onSubmit="return check()" action="index.php?action=AjouterMaterielValidation" method="post">
        <label>Nom de l'appareil</label>
        <input id="name" name="name" type="text"><br><br>

        <label>Version</label>
        <input id="version" name="version" type="text"><br><br>

        <label>Reference</label>
        <input id="ref" name="ref" type="text"><br><br>

        <label>Type</label>
        <input id="type" type="text" name="type"><br><br>

        <label>Marque</label>
        <input id="brand" name="brand" type="text"><br><br>

        <label>Lien de l'image</label>
        <input id="url" name="url" type="text"><br><br>

        <div id="phoneN">
            <label>Numéro de téléphone</label>
            <input id="phoneNumber" name="phoneNumber" type="text"><br><br>
        </div>


        <input value="Ajouter" name="Ajouter" type="submit">
    </form>
</div>
</body>
</html>

