<head>
    <link rel="stylesheet" href="./vues/css/style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Akronim&family=Montserrat:wght@300;500&family=Prata&display=swap');</style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<nav>
    <label class="logo"> LOCAMAT </label>
    <ul class="nav-links">
        <li>
            <a href="./index.php" id="Home"> Accueil </a>
        </li>
        <?php
        $status=ModelAdministrator::isAdmin();
        if ($status== "Admin") { ?>
            <li>
                <a href="index.php?action=AjouterUtilisateur">Ajouter utilisateur</a>
            </li>
            <li>
                <a href="index.php?action=AjouterMateriel">Ajouter matériel</a>
            </li>
        <?php } else { ?>
            <li>
                <a href="#Contact" id="Cont"> Contact </a>
            </li>
        <?php } ?>
        <?php if (!isset($_SESSION["login"])) { ?>
            <li><a href="index.php?cible=Connexion&action=connection">Se connecter</a></li>
        <?php } else { ?>
            <li><a href="index.php?cible=Deconnexion&action=Deconnexion">Se deconnecter</a></li>
        <?php }?>
    </ul>
</nav>


