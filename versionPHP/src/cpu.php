<?php
include ('src/joueur.php');
include ('src/jeux.php');
include ('src/listePays.php');

/**
*This is a class modeling a player controlled by the computer
*/
class Cpu extends Joueur{
    
   private  $levels = array(5=>0.7, 4=>0.6, 3=>0.5, 2=>0.4, 1=>0.3);
   private $pays;
   private $opppays;
   private static $jeu;
   private $paysIdentifie = array();
   private $lettresAposer = array('a','b','c','d','e','f','g','h','i','j','k','l','z','m','n','o','p','q','r','s','t','u','v','w','x','y');
   
 
 public function  __construct($langue, $unjeu, $level)
 {
	 
	$unjeu =  new Jeux('fr');
	$unjeu->
	$jeux = $unjeu;
	  parent::__construct();
	  $this->pays = array_ran($unjeu->
	  
 }

/**
*Cette fonction crée un groupe de pays identifié.
*prendre toutes les lettres de opppays en remplaçant tout '? *de '.' et le convertir en une expression régulière 
*/
public function getpaysIdentifie()
 {  $litPays = 
	$opppaysRefait = str_replace('?', '.',$this->opppays);
	 foreach( 
	 $regex = 
 }
}
?>