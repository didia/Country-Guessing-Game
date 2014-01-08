
<?php
// un joueur doit être representé par son pseudo, sa langue et son pays

class Joueur
{
	
	private  $pays ;
	private  $pseudo;
	private $langue;
	private $actif = false;
	private $opppays;

	/**
	*Construir a partir des information de la base de données
	*/
	public function __construct($idUser)
	{
		
		$mysqli  = connexion();
		if ($result = $mysqli->query("SELECT * FROM joueurs WHERE  id = '$idUser'", MYSQLI_USE_RESULT))
		{
			
			$infoUser = mysqli_fetch_assoc($result);
			$this->pseudo = $infoUser['userName'];
			$this->pays = $infoUser['pays'];
			$this->langue = $infoUser['langue'];
		}
		else
		{
			echo"<br>impossible d'Executer la requette ". mysql_error()."<br>";
			exit;
		}
		
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
	
	public function choisisPays(string $pays, $jeu)
	{
		//verifier si le pays choisi est valide
		$listePays = $jeu->getListePays();
		if(in_array($pays, $listePays))
		{
			return true;
		}
		else
		return false;
	}
		
	/**
	*Demandez si le pays de l'adversaire a la lettre donnée
	*retourner la ou les positions de la ou des  lettres 
	*ou false si elle ne contient pas la lettre
	*Arguments mot-clé:
	*lettre - la lettre demandé
	*autre -  l'adversaire.
		*/
	public function asTu(string $lettre, joueur $adversaire)
	{
		$lettres = array();
		$paysAdeversaire  = str_split($adversaire.pays);
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
		
		return str_split($lettre );
		
		
		
	}
	
	/**Devinez le pays de l'adversaire
     *return true si nous avons trouvé le pays ou faux sinon
	 *Arguments mot-clé:
     *drapeau - le nom que nous devinions
     *autre - l'adversaire dont le nom nous devinons
		 */
	public function estCeTonPays($pays, $adversaire)
	{
		return (strcmp($pays, $adversaire.pays));
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
		$opppaysArray = str_split($this->opppays);
		for($i = 0; $i<strlen($adversaire.pays); ++$i) 
        	$this->$opppaysArray[$i] = '?';
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
	
		return mb_substr_count($opppaysStr , '?');
	}
	
}
?>