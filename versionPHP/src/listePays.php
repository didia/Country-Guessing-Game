
<?php

#Auteur: Patrice 


//Ce module permet d'obtenir la liste des pays valides, a partir d'un fichier donnee.


function obtenirListePays($langue)
{
	$tableauPays  = array();
	//ouverture du fichier en lecture seule
	if(strtolower($langue )== "fr") 
	{
	$handle = fopen('./text/listepays.txt', 'r');
	}
	else if(strtolower($langue )== "en") 
	{
		$handle = fopen('./text/countrylist.txt', 'r');
	
	}
	//si l'ouverture est reussi
	if($handle)
	{
		//tanque l'on est pas à la fin du fichier
		while(!feof($handle))
		{
			//on lit la ligne courante
			$buffer = fgets($handle);
			array_push($tableauPays, $buffer);
		}
		
		//on ferme le fichier
		fclose($handle);
	}
	
	foreach($tableauPays as &$value)
	{
		echo $value;
	}
	return $tableauPays;
	
}

?>