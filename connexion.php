<?php
include("application.php");

$uneConnexion = new MaConnexion("utilisateur", "", "root", "localhost");
$resultat = $uneConnexion->selectUtilisateur($_POST["identifiant"], $_POST["motdepasse"]);

if (!empty($resultat)) {
    echo "OUI sa fonctionne !";
}
else {
    echo "Non sa ne fonctionne pas !";
}
?> 