<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=le_petit_monde_de_coco', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
    global $bdd; //On défini notre variable globale
}
//retourne un message d'erreur lorsqu'une
// exception est levée
catch (\Exception $e) {
    error_log($e->getMessage());
    // file deepcode ignore ServerLeak: <please specify a reason of ignoring this>
    echo "Une erreur est survenue. Veuillez réessayer plus tard.";
}
