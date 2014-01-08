<?php
/***********************__Auteur__ :"Patrice"***************/

/**
Ceci est le module qui contient le jeu de pays. Un joueur va jouer contre
le CPU. Ils doivent les deux choisir un pays et tenter de decouvir le pays de l'autre
celui qui decouvre le pays de l'autre avant a gagne.
*/
include ('src/jeux.php');
include ('src/listePays.php');
include ('src/joueur.php');
include ('src/cpu.php');

$jeu1 = new jeu(strtolower($langue));

$joueur1 = new Joueur ($idUser);



	while (true)
	{
        try
		{
            $level = $lelevel;
            assert (level >= 1 and level <= 5);
            break;
		}
		catch (Exception $e) 
		{
    		echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}
		
	}
   
	$cpu = new Cpu($jeu1, $level);
	/*pour verifier si le pays choisi existe*/
	while (!$joueur1->choisirPays($pays, $jeu1))
	{
		if($joueur1->choisirPays($pays, $jeu1))
			break;
	}
	
	$joueur1->initiateOppInfo($cpu);
	$cpu->initiateOppInfo(joueur1);
	
	echo"Juge dis: le pays de".$joueur1."a".strlen($joueur1->getPays)."lettre et  celui de CPU a ". strlen($cpu->getPaysl)."lettre";
	

	while(true)
	{
		//ici on fera un input 
		$requete = $lettredonnePrjoueur1;
		if(strlen($requete) ==1)
		{
			$reponse =  $joueur1->asTu($requete, $cpu);
		}
		else
		{
			$reponse = $joueur1->estCeTonPays($requete, $cpu);
		}
		if(strlen($requete)!= 1)
		{
			if($reponse)
			{
				$jeu1->setVainqueur($joueur1);
				echo $joueur1." a trouvé le pays de CPU et a gagné ";
				break;
			}
			else
			{
				echo "CPU dit : Mon pays n'est pas ".$requete;
			}
		}
		else if($reponse)
		{
			echo"CPU dit : Mon pays a ". $requete." à la (aux) position(s)";
		}
		else
		{
			echo"CPU dit : Mon pays a ". $requete;
		}
		#Check if the cpu has already started guessing
		if($cpu->getpaysIdentifie())
		{
			$guess = $cpu->pick();#Check if the cpu has already started guessing
			
			# if the guess is correct, the game is over
			
			if($guess == $joueur1->getPays())
			{
				$jeu1->setVainqueur($cpu);
				echo "CPU a trouve ton pays ".$guess.", tu as perdu, son pays etait ".$cpu->getPays;
                break;
			}
			 #if it is not correct, then echo a message and continue
			else
			{
				echo "CPU demande : Est-ce Ton Pays ".$guess;
                echo "Judge dit : Non, ce n'est pas son pays. CPU passe la main";
                continue;
			}
		}
		
		$reponse = $cpu->asTu($joueur1);
		if($reponse[1])
		{
			echo"Judge dit: CPU a trouve la lettre ".$repons[0]." a la (aux) position(s) ".$reponse[1]. " de votre pays";
		}
		else
		{
			echo"Judge says: CPU n\'a pas trouve ".$reponse[0]."dans votre pays";
      
		}
		echo('*'*10 + ' EVOLUTION ' + '*'*10);
        echo('*'+' '*29+'*');
        echo('*'+' '*9+ ' '.join($joueur1->getOpppays)+' '*8+'*');
        echo('*'*10 + ' EVOLUTION ' + '*'*10);
        echo('*'+' '*29+'*');

		$cpu->isTimeToGuess($joueur1);
	
	}
	
	
?>