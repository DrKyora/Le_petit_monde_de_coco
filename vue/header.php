<!DOCTYPE html>
<html lang="fr">
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/model/dbconnect.php");
session_start();
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/asset/css/style.css" />
    <title><?php echo $title ?></title>
</head>

<body>
    <div class="shadow">
        <header>
            <img src="/img/logo_header.png" alt="une main qui tient un crochet" />
            <div>
                <nav>
                    <ul>
                        <li><a href="accueil.php">Accueil</a></li>
                        <li><a href="creation.php">Créations</a></li>
                        <li><a href="tuto.php">Bien débuter</a></li>
                        <?php if (!isset($_SESSION["user"])) { ?>
                            <li><a href="inscription.php">Inscription</a></li>
                            <li><a href="connexion.php">Connexion</a></li>
                            <?php } else {
                            if ((isset($_SESSION["user"]) && ($_SESSION["user"]["role"]))) {
                            ?>
                                <li><a href="profil.php">Administrateur</a></li>
                            <?php
                            } else { ?>
                                <li><a href="profil.php">Profil</a></li>
                        <?php }
                        } ?>
                    </ul>
                    <div id="icons"></div>
                </nav>
            </div>
        </header>