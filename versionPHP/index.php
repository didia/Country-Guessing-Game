
<?php
header('location:src/home.php');

include ('src/jeux.php');
include ('src/listePays.php');
include ('src/joueur.php');


obtenirListePays('EN');

$unjoueur = new Joueur(1);

echo "<br>".$unjoueur->getLangue();
echo "<br>".$unjoueur->getPays();
echo "<br>".$unjoueur->getPseudo();


?>
