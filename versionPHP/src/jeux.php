<?php
include_once('ListePays.php');

class LeJeux
{
private $langue;
private $vainqueur;

private $listPays = array();

/**
*
*/
public function __construct($uneLangue)
{
	$this->langue = $uneLangue;
	$this->listPays = obtenirListePays($this->langue);
}
/**
*
*/
public function setVainqueur($leVainqueur)

{
	$this->vainqueur = $leVainqueur;
}

}

 
?>
