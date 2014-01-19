var CPU_NAMES_ARRAY = new Array("Captain America", "The supergirl", "The catwoman", "Blade", "The punisher")
var COUNTRIES = new Array("GABON", "GHANA", "CONGO", "CANADA", "BRESIL");
var LETTERS = new Array('A','B','C','D','E','F','G','H','I','J','K','L',
								  'M','N','O','P','Q','R','S','T','U','V','W','X',
								  'Y','Z');

var LEVELS = new Array(0.7, 0.6, 0.5, 0.4, 0.3);

function shuffle(o){ //v1.0
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};

var Player = function(name)
{
	this.name = name;
	this.pays = null;
	this.oppPays = null;
	this.oppCountryLength = 0;
	this.alreadyDecouverte = 0;

}

Player.prototype = {
	constructor: Player,

	choisirPays: function(pays)
	{
		if(COUNTRIES.indexOf(pays > -1))
		{
			this.pays = pays;
			return true;
		}

		return false;
	},
	asTu: function(requete)
	{
		if(requete.length > 1)
		{
			return this.pays === requete;
		}
		
		reponses = []
		for(var i=0; i<this.pays.length;i++) {
    		if (this.pays[i] === requete) reponses.push(i);
		}
		
		if (reponses.length > 0) return reponses;
		
		return null;
		
	},
	setOpponent: function(oppLengthPays)
	{
		this.oppPays = new Array(oppLengthPays);
		for (var i = 0; i < oppLengthPays; i++)
		{
			this.oppPays[i] = "?";
		}
		this.oppCountryLength = oppLengthPays;
		
		
	},

	updateOppInfo: function(requete, reponse)
	{
		reponse.forEach(function(position)
		{
			this.oppPays[position] = requete;
			this.alreadyDecouverte += 1;
		});
	},
	
	getName: function()
	{
		return this.name;
	},
	
	getCountryLength: function()
	{
		if(this.pays)
		{
			return this.pays.length;
		}
		return 0;
	},
	
	getOppPays: function()
	{
		return this.oppPays;
	}
	

}

var Cpu = function(level)
{
	this.name = CPU_NAMES_ARRAY[level-1];
	this.level = level;
	this.lettersToAsk = shuffle(LETTERS);
	this.matchedCountries = []

	
};

Cpu.prototype = Object.create(Player.prototype);

Cpu.prototype.constructor = Cpu;

Cpu.prototype.choisirPays = function()
{
	this.pays = COUNTRIES[Math.floor(Math.random() * COUNTRIES.length)];
}

Cpu.prototype.isTimeToGuess = function()
{
	if ((this.alreadyDecouverte/this.oppCountryLength) >= LEVELS[this.level - 1])
	{
		var regex = this.oppPays.join('');
		regex = regex.replace('?', '.');
		regex = '/' + regex + '/';

		COUNTRIES.forEach(function(country)
		{
			if(country.match(regex))
			{
				this.matchedCountries.push(country);
			}
		});
		return true;
	}

	return false;
}

Cpu.prototype.pick = function()
{
	return this.matchedCountries.pop();
}

Cpu.prototype.getNextRequest = function()
{
	if(this.matchedCountries.length != 0 || this.isTimeToGuess())
	{
		return this.pick()
	}

	return this.lettersToAsk.pop();
}


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
	getOppPays: function()
	{
		return this.player1.getOppPays();
	},
	sendRequest : function(request)
	{
		this.state.processRequest(request);
	},
	
	start : function()
	{
		this.judge.askPays(this.player1, "Entrez votre pays");
	
	},

	processRequeteFrom: function(player1, player2, requete)
	{

		if(requete)
		{
			reponse = player2.asTu(requete);
			if (requete.length == 1)
			{		
				if (reponse)
				{
					player1.updateOppInfo(requete, reponse);
					var article;
					if(reponse.length != 1)
					{
						article = " aux positions "
					} 
					else
					{
						article = " à la position "
					}

					var message = "Mon pays a " + requete + article + reponse.join(" ");
					self.judge.sayMessageFrom(player2, message);
				}
				
				else
				{
					var message  = "Mon pays n'a pas " + requete;
					self.judge.sayMessageFrom(player2, message);
				}


			}
			else
			{
				if(reponse){
					this.setWinner(player1);
				}
				else
				{
					var message = "Mon pays n'est pas " + requete;
					self.judge.sayMessageFrom(player2, message);
				}
			}

		}

	},
	

	endGame:function()
	{
		this.judge.annonceWinner(this.winner);

	}

};
