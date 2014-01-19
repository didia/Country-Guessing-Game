var CPU_NAMES_ARRAY = new Array("Captain America", "The supergirl", "The catwoman", "Blade", "The punisher")

var Player = function(name)
{
	this.name = name;
}

Player.prototype = {
	constructor: Player,

	choisirPays: function(pays)
	{
		return true;
	},

	setOpponent: function(player)
	{
		
	},

	askOpponent: function(requete)
	{
		
	},
	getName: function()
	{
		return this.name;
	}

}

var Cpu = function(level)
{
	this.name = CPU_NAMES_ARRAY[level-1];
	this.level = level;
	
};

Cpu.prototype = Object.create(Player.prototype);

Cpu.prototype.constructor = Cpu;


var JeuDePays = function(pseudo , oponent_level, language, remote, judge)
{
	this.player1 = new Player(pseudo);
	this.cpu = new Cpu(oponent_level);
	this.winner = null;
	this.tour = 0;
	this.language = language;
	this.remote = remote;
	this.judge = judge;
	this.state = new WaitingCountryState(this);
};



JeuDePays.prototype = 
{
	
	constructor : JeuDePays,
	
	get_pays : function(language){
	
	},
	
	sendRequest : function(request)
	{
		this.state.processRequest(request);
	},
	
	start : function()
	{
		this.judge.askPays(this.player1, "Entrez votre pays");
	
	},

	processRequeteFrom: function(player, requete)
	{

		if(requete)
		{
			reponse = player.askOpponent(requete);
			if (requete.length == 1)
			{		
				if (reponse)
				{
					var article;
					if(reponse.indexOf(" ") != -1)
					{
						article = " aux positions "
					} 
					else
					{
						article = " à la position "
					}

					var message = "Mon pays a " + requete + article + reponse;
					self.judge.sayMessageFrom(player.opponent, message);
				}
				
				else
				{
					var message  = "Mon pays n'a pas " + requete;
					self.judge.sayMessageFrom(player.opponent, message);
				}


			}
			else
			{
				if(reponse){
					this.setWinner(player);
				}
				else
				{
					var message = "Mon pays n'est pas " + requete;
					self.judge.sayMessageFrom(player.opponent, message);
				}
			}

		}

	},
	

	endGame:function()
	{
		this.judge.annonceWinner(this.winner);

	}

};
