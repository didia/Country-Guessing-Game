<?php
/***********************__Auteur__ :"Patrice"***************/

/**
Ceci est le module qui contient le jeu de pays. Un joueur va jouer contre
le CPU. Ils doivent les deux choisir un pays et tenter de decouvir le pays de l'autre
celui qui decouvre le pays de l'autre avant a gagne.
*/
include ('jeux.php');
//include ('listePays.php');
include ('joueur.php');
include ('cpu.php');
function  jouer($langue, $idUser, $level)
{
$jeu1 = new jeu(strtolower($langue));
$pays = "Senegal";
$joueur1 = new Joueur ($idUser,$pays, $langue);
 // juste pour tester mais cette sera a saisir pa le user


	$cpu = new Cpu($jeu1, $level);
	echo" le pays du CPU est ".$cpu->getPays();
	echo" le pays du joueur1  est ".$joueur1->getPays();
	/*pour verifier si le pays choisi existe*/
	$joueur1->choisirPays($pays, $jeu1);
	
	/*while (!$joueur1->choisirPays($pays, $jeu1))
	{
		if($joueur1->choisirPays($pays, $jeu1))
			break;
	}
	*/
	$joueur1->initiateOppInfo($cpu);
	$cpu->initiateOppInfo($joueur1);
	
	echo"<br>Juge dis: le pays de".$joueur1->getPseudo()."a".strlen($joueur1->getPays())."lettre et  celui de CPU a ". strlen($cpu->getPays())."lettre<br>";
	

	while(true)
	{
		//ici on fera un input
		//TODO
		$lettresAposerPrjoueur1 = array('a','b','c','d','e','f','g','h','i','j','k','l','z','m','n','o','p','q','r','s','t','u','v','w','x','y');
		if(count($lettresAposerPrjoueur1)>=2)
		{
			$rand_keys = array_rand($lettresAposerPrjoueur1, 2);
		 	$pick = $lettresAposerPrjoueur1[$rand_keys[0]]; 
		}
		else if (count($lettresAposerPrjoueur1) == 1)
			$pick  = $lettresAposerPrjoueur1[0];

		$requete = $pick;//$lettredonnePrjoueur1;
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
			echo"<br>CPU dit : Mon pays a ". $requete." à la (aux) position(s)";
		}
		else
		{
			echo"<br>CPU dit : Mon pays n'a pas ". $requete;
		}
		#Check if the cpu has already started guessing
		if($cpu->getpaysIdentifie())
		{
			$guess = $cpu->pick();#Check if the cpu has already started guessing
			
			# if the guess is correct, the game is over
			
			if($guess == $joueur1->getPays())
			{
				$jeu1->setVainqueur("cpu");
				echo "CPU a trouve ton pays ".$guess.", tu as perdu, son pays etait ".$cpu->getPays();
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
			echo"<br>Judge dit: CPU a trouve la lettre ".$reponse[0]." a la (aux) position(s) ".$reponse[1]. " de votre pays";
		}
		else
		{
			echo"<br>Judge says: CPU n'a pas trouve ".$reponse[0]."dans votre pays";
      
		}
		echo('*'*10 + ' EVOLUTION ' + '*'*10);
        echo('*'+' '*29+'*');
        echo('*'+' '*9+ ' '.($joueur1->getOpppays())+' '*8+'*');
        echo('*'*10 + ' EVOLUTION ' + '*'*10);
        echo('*'+' '*29+'*');

		$cpu->isTimeToGuess($joueur1);
	
	}
	
}
?>
?>