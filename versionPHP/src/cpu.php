<?php

/**
*This is a class modeling a player controlled by the computer
*/
class Cpu extends Joueur{
    
   public static $levels = array(5=>0.7, 4=>0.6, 3=>0.5, 2=>0.4, 1=>0.3);
   
   private $pays;
   private $level;
   private $jeu;
   private $listePays;
   private $paysIdentifie = array();
   private $lettresAposer = array('a','b','c','d','e','f','g','h','i','j','k','l','z','m','n','o','p','q','r','s','t','u','v','w','x','y');
  
  
   
 
 public function  __construct($jeu, $level)
 {
	  parent::__construct(1);
	  $listePays = $jeu->getListePays();
	
	  $rand_keys = array_rand($listePays, 2);
	  $this->pays = $listePays[$rand_keys[0]];
	  $this->listePays = $listePays;
	  $this->jeu = $jeu;
	  $this->level = $level;
 }
 
 /**
 *
 */
 public  function getPays()
 {
	 return $this->pays;
 }

/**
*Cette fonction crée un groupe de pays identifié.
*prendre toutes les lettres de opppays en remplaçant tout '? *de '.' et le convertir en une expression régulière 
*/
public function getpaysIdentifie()
 { 

$m =array();
	 $regex= str_replace('?', '.', parent::getOpppays());
	  $listePays = $this->listePays;
	 foreach( $listePays as $pays)
	 {
		 if(preg_match($regex, $pays, $m))
		{
			echo $pays;
		}
	 }
	  
 }
 
 /**
 *Cette fonction prend un pays parmi les pays identifié
 */
 public function pick()
 {
	 $paysIdentifies = $this->paysIdentifie;
	 $rand_keys = array_rand($paysIdentifies, 2);
	 $pick = $paysIdentifies[$rand_keys[0]]; 
     unset($this->paysIdentifie[ array_keys($this->paysIdentifie, $pick)]);
	
	return $pick;
 }
 
 
 /**
 *Il s'agit de la fonction par laquelle le cpu demander si 		 *l'adversaire a un hasard lettre ou non.
 *il renvoie un tuple qui a demandé la lettre et sa position dansle nom du pays
 */
 
 public function asTu($joueur)
 {
	 $lettreAposer = $this->lettresAposer;
	 $rand_keys = array_rand($lettreAposer, 2);
	 $requete = $lettreAposer[$rand_keys[0]]; 
	 unset($this->lettresAposer[ array_keys($this->lettresAposer, $requete)]);
	
	return array('requete'=>$requete,'asTu' =>parent::asTu($requete, $joueur));	
	  
 }
 
 
 /**
 *Cette fonction vérifie d'abord si c'est le temps de la CPU *pour commencer à devineropponnent Pays en fonction de la difficulté du jeu.
 Si il est temps, alors la fonction de recherche pour le pays identifié et ajoutez-les à matchedcountry
 */
 
 public function isTimeToGuess($joueur)
 {
	 if(parent::getLenOpppays()/strlen($joueur->getpays)>= $levels [$this->level-1]);
	 {
		 $this->getpaysIdentifie();
	 }
 }
}
?>