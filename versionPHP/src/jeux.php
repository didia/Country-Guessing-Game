<?php

function __autoload($class)
{
    static $classDir = './src';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
    require "$classDir/$file";
}
class Jeux
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
	$this->listPays = listePays::obtenirListePays($this->langue);
}
/**
*
*/
public function setVainqueur(string $leVainqueur)

{
	$this->vainqueur = $leVainqueur;
}

}
?>
