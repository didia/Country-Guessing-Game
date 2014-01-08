<?php

function __autoload($class)
{
    static $classDir = './src';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
    require "$classDir/$file";
}

/**
*
*/
class Jeu
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
public function setVainqueur(string $leVainqueur)

{
	$this->vainqueur = $leVainqueur;
}
/**
*
*/
public function getListePays()
{
	return $this->listPays;
}

}
?>
