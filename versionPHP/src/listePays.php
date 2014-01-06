
<?php

#Auteur: Patrice 


//Ce module permet d'obtenir la liste des pays valides, a partir d'un fichier donnee.


function obtenirListePays($langue)
{
	$tableauPats  = array();
	//ouverture du fichier en lecture seule
	$handle = fopen('text/listepays.tx', 'r');
	//si l'ouverture est reussi
	if($handle)
	{
		//tanque l'on est pas à la fin du fichier
		while(!feof($handle))
		{
			//on lit la ligne courante
			$buffer = fgets($handle);
			array_push($tableauPats, $buffer);
		}
		
		//on ferme le fichier
		fclose($handle);
	}
	
	return $tableauPats;
}

?>