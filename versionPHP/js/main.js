var currentRequest = null;

function showStartForm()
{
	$("#welcome-div").hide();
	$("#game-panel").hide();
	$("#start-div").show();
	
	
}

function showMenuPrincipal()
{
	$("#start-div").hide();
	$("#game-panel").hide();
	$("#welcome-div").show();
}

function startGame()
{
	$("#start-div").hide();
	$("#welcome-div").hide();
	$("#game-panel").show();
	var myFormData = $("#start-form").serializeArray();
	var pseudo = $("#start-form input[name = pseudo]").val();
	var level = $("#start-form select[name = level]").val();
	judge.startNewGame(pseudo, level, "fr", false);
	
	
	
}

function JoueurPlay()
{
	currentRequest = $("#ask-input input[name = request]").val();
	$("#ask-input")[0].reset();
	return false;
}


var Judge = function()
{
	this.screenLog = [];
}

Judge.prototype = 
{
	constructor: Judge,

	startNewGame: function(pseudo , oponent_level, language, remote)
	{
		this.jeu = new JeuDePays(pseudo, oponent_level, language, remote, this);
		this.jeu.play();
	},

	getPays: function(player1, message)
	{
		this.says(player1.getName() + "  " + message);
		pays= currentRequest;
		while(pays == null)
		{
			pays = currentRequest
		}
		currentRequest = null;
		return pays;
	},

	says: function(message)
	{
		
		this.screenLog.push(message);
		this.refreshScreen();
	},

	sayMessageFrom: function(player, message)
	{
		this.says(player.name + " "+ message);
	},

	enableInputFor: function(player, message)
	{
		
	},

	disableInputFor: function(player, message)
	{
		
	},

	annonceWinner: function(winner)
	{
		
	},
	
	refreshScreen: function()
	{
		if(this.screenLog.length < 5)
		{
			this.screenLog.forEach(function(entry)
			{
				alert(entry);
				$("#ecran-geant").append("<span>"+entry+"</span>");
			});
		}
		
	}

}

var judge = new Judge();

