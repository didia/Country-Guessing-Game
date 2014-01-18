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
	this.current_requete = null;
};

JeuDePays.prototype = 
{
	
	constructor : JeuDePays,
	
	get_pays : function(language){
	
	},
	
	play : function()
	{
		this.cpu.choisirPays();
		pays = this.judge.getPays(this.player1, "Entrez votre pays");
		while (!this.player1.choisirPays(pays)) 
		{
			this.judge.says("Nous n'avons pas trouvé le pays que vous avez choisi");
			pays = this.judge.getPays(this.player1, "Choisissez un nouveau pays (ignorez les accents)");
		}
		this.judge.sayMessageFrom(this.cpu, "Mon pays a " + this.cpu.getCountryLength() + " lettres");
		this.player1.setOpponent(this.cpu);
		this.cpu.setOpponent(this.player1);
		
		while(true)
		{
			var timeout;
			var requete;
			this.judge.enableInputFor(this.player1, "Votre tour de jouer");
			this.timerId = setTimeout(function()
			{
				this.judge.disableInputFor(this.player1, "Le temps s'est écroulé, Votre tour passe!")
				timeout = true;
			}, 
			60000);
			while(!timeout && !this.current_requete)
			{
			}
			
			requete = this.current_requete;
			this.current_requete = null;

			if(requete)
			{
				this.processRequeteFrom(this.player1, requete);
			}
			else
			{
				this.judge.says(this.player1.name + " passe la main.");
				
			}
			
			if (this.winner)
			{
				this.endGame();
				break;
			}

			cpuRequete = this.cpu.getNextRequest()

			this.processRequeteFrom(this.cpu, cpuRequete)

			if (this.winner)
			{
				this.endGame();
				break;
			}

		}
	
		
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
