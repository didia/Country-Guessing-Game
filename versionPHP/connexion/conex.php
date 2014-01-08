<?php
function connexion()
{
	$serveur="127.0.0.1";
	$user="root";
	$pass="";
	$mysqli = new mysqli("localhost", $user, $pass, "gamepays");
	
	/* Vérification de la connexion */
	if ($mysqli->connect_errno) {
		printf("Échec de la connexion : %s\n", $mysqli->connect_error);
		exit();
	}

	return $mysqli;
}

?>