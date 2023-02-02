<!doctype html>
<html>
<head>
    <meta content="text/html; charset=UTF-8"  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./vues/css/adapt.css">
    <script src="./vues/js/addUser.js"></script>
    <title>Matériels disponibles</title>
</head>
<body>

    <div class="box">
        <form onSubmit="return check()" action="index.php?action=AjouterUtilisateurValidation" method="post">
            <label>Nom de famille</label>
            <input id="ln" name="ln" type="text"><br><br>

            <label>Prenom</label>
            <input id="fn" name="fn" type="text"><br><br>

            <label>Email</label>
            <input id="mail" name="mail" type="text"><br><br>

            <label>Mot de passe</label>
            <input id="pass" name="pass" type="password"><br><br>

            <label>Role</label>
            <select id="role" name="role">
                <option>Administrateur</option>
                <option>Utilisateur</option>
            </select><br><br>

            <input value="Ajouter" type="submit">
        </form>
    </div>
</body>
</html>
