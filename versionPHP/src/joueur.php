
<?php
// un joueur doit être representé par son pseudo, sa langue et son pays
class Joueur
{
	
	
	private   $pseudo;
	private $langue;
	private $actif = false;
	
	/**
	*Construir a partir des information de la base de données
	*/
	public function __construct($idUser)
	{
		include("../Connexion/connex.php");
		$req = "SELECT * actif FROM membres WHERE  id = $idUser";
		$exe=mysql_query($req);
		$infoUser=mysql_fetch_assoc($exe);
		$this->pseudo = $infoUser['pseudo'];
		$this->pays = $infoUser['pays'];
		$this->pLangue = $infoUser['Langue'];
	
	}
	
	/**
	*destructeur
	*/
	public function __destruct()
	{
		$this->actif = false;
		echo"classe detruite";
	}
	
	/**
	*fonction d'assignation et d'Acces
	*/
	public function getPseudo()
	{
		return $this->pseudo;
	}
	
	/**
	*
	*/
	public function getLangue()
	{
		return $this->langue;
	}
	
	/**
	*
	*/
	 public function setPseudo($nouveauPseudo)
    {
       if (!empty($nouveauPseudo) AND strlen($nouveauPseudo)<15)
        {
            $this->pseudo = $nouveauPseudo;
       }
    }   

 
 	/**
	*fonction pour retourner le nombre de lettre du pays
	*/
	public function nombreDeLettreDuPays()
	{
		return strlen($pays);
	}
	
	/**
	*choisir le pays
	*/
	
	public function choisisPays($pays, $listePays)
	{
		//verifier si le pays choisi est valide
		if(in_array($pays, $listePays))
		{
			return true;
		}
		else
		return false;
	}

}
?>