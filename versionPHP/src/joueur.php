
<?php
// un joueur doit être representé par son pseudo, sa langue et son pays

class Joueur
{
	
	private  $pays ;
	private  $pseudo;
	private $langue;
	private $actif = false;
	private $opppays ;

	/**
	*Construir a partir des information de la base de données
	*/
	public function __construct($user,$pays,$langue)
	{
		
			
			$this->pseudo = $user;
			$this->pays = $pays;
			$this->langue = $langue;
		/*
		$mysqli  = connexion();
		if ($result = $mysqli->query("SELECT * FROM joueurs WHERE  id = '$idUser'", MYSQLI_USE_RESULT))
		{
			
			$infoUser = mysqli_fetch_assoc($result);
			$this->pseudo = $infoUser['userName'];
			$this->pays = "Senegal";//$infoUser['pays'];//TODO
			$this->langue = $infoUser['langue'];
		}
		else
		{
			echo"<br>impossible d'Executer la requette ". mysql_error()."<br>";
			exit;
		}
	*/	
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
	public function getPays()
	{
		return $this->pays;
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
	 public function setPseudo(string $nouveauPseudo)
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
	
	public function choisirPays( $pays, $jeu)
	{
		//verifier si le pays choisi est valide
		$listePays = $jeu->getListePays();
		
	
		if(in_array(strtolower($pays), $listePays))
		{
			echo" trouvé";
			return true;
		}
		else
		{
			echo" pas trouve";
			return false;
		}
	}
		
	/**
	*Demandez si le pays de l'adversaire a la lettre donnée
	*retourner la ou les positions de la ou des  lettres 
	*ou false si elle ne contient pas la lettre
	*Arguments mot-clé:
	*lettre - la lettre demandé
	*autre -  l'adversaire.
		*/
	public function asTu( $lettre, Joueur $adversaire)
	{
		$lettres = array();
		$paysAdeversaire  = str_split($adversaire->getOpppays());
		$i = 0;
		foreach($paysAdeversaire as &$value)
		{
			if ($value == $lettre)
			{
				array_push($lettres, $lettre);
				$this->opppays = str_replace($this->opppays[$i], $lettre,$this->opppays); 
			}
			++$i;
				
		}
		
		return $lettres;
		
		
		
	}
	
	/**Devinez le pays de l'adversaire
     *return true si nous avons trouvé le pays ou faux sinon
	 *Arguments mot-clé:
     *drapeau - le nom que nous devinions
     *autre - l'adversaire dont le nom nous devinons
		 */
	public function estCeTonPays($pays, $adversaire)
	{
		return (strcmp($pays, $adversaire->getPays()));
	}
	
	/**
	*        return the number of letter of the country chosen by self
	*/
        
	public function  combienDeLettre()
       {
        return strlen($this->pays);
	   }
	   
	   /**
	   *remplir initiallement de ??????
	   */
	public function  initiateOppInfo($adversaire)
    {
		$opppaysArray = array();
		
		for($i = 0; $i<strlen($adversaire->getPays()); ++$i) 
        	array_push($opppaysArray,'?');
		$this->opppays = implode("", $opppaysArray);
		
	}
	
	/**
	* retun le pays de l'adversaire
	*/
	public function getOpppays()
	{
		return $this->opppays;
	}
	/**
	* le nombre de lettres incunue restantes
	*/
	
	public function getLenOpppays()
	{
		//$opppaysStr = $this->opppays;
		return strlen($this->opppays); // mb_substr_count($opppaysStr , '?');
	}
	
}
?>