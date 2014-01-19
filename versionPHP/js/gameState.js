var GameState = function(jeu)
{
	this.jeu = jeu;
}

GameState.prototype = 
{
	processRequest: function(request)
	{

	}
	
}

IdleState = function(jeu)
{
	this.jeu = jeu;
}

IdleState = Object.create(GameState.prototype);


PlayingState = function(jeu)
{
	this.jeu = jeu;
}

PlayingState.prototype = Object.create(GameState.prototype);

PlayingState.prototype.checkEndOfGame = function()
{
	if (this.jeu.winner)
	{
		this.jeu.state = new IdleState(this.jeu);
		this.jeu.endGame();
		return true;
	}
	
	return false;
}
PlayingState.prototype.processRequest = function(request)
{
	this.jeu.judge.disableInputFor(this.jeu.player1);
	
	if(request == null || request == '')
	{
		this.jeu.judge.says(this.player1.name + " passe la main.");
	}
	else
	{
		this.jeu.processRequeteFrom(this.jeu.player1, this.jeu.cpu, request);
	}
	
	if (this.checkEndOfGame())
	{
		return;
	}
	
	
	cpuRequete = this.jeu.cpu.getNextRequest();
	this.jeu.processRequeteFrom(this.jeu.cpu, this.jeu.player1, cpuRequete)
	
	if(this.checkEndOfGame())
	{
		return;
	}
	
	this.jeu.judge.enableInputFor(this.jeu.player1, " C'est ton tour de jouer");
	

}

WaitingCountryState = function(jeu)
{
	this.jeu = jeu;
}

WaitingCountryState.prototype = Object.create(GameState.prototype);

WaitingCountryState.prototype.processRequest= function(request)
{
	this.jeu.judge.disableInputFor(this.player1);
	
	if(this.jeu.player1.choisirPays(request))
	{
		this.jeu.cpu.choisirPays();
		this.jeu.judge.sayMessageFrom(this.jeu.cpu, "Mon pays a " + this.jeu.cpu.getCountryLength() + " lettres");
		
		this.jeu.player1.setOpponent(this.jeu.cpu.getCountryLength());
		
		this.jeu.cpu.setOpponent(this.jeu.player1.getCountryLength());
		
		this.jeu.state = new PlayingState(this.jeu);
		
		this.jeu.judge.enableInputFor(this.jeu.player1, "À vous de commencer, Demandez une lettre ou devinez le pays!");
	}
	else
	{
		this.jeu.judge.enableInputFor(this.jeu.player1, request + " n'est pas un pays valide, veuillez choisir un pays valide!");
	}
}