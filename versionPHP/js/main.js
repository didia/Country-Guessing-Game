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
	judge.sendRequest(currentRequest.toUpperCase());
	$("#ask-input")[0].reset();
	
	return false;
}


var Judge = function()
{
	this.screenLog = [];
	this.timerID = null;
	this.inputEnabled = true;
	
}

Judge.prototype = 
{
	constructor: Judge,

	startNewGame: function(pseudo , oponent_level, language, remote)
	{
		this.jeu = new JeuDePays(pseudo, oponent_level, language, remote, this);
		this.jeu.start();
	},

	askPays: function(player1, message)
	{
		this.says(player1.getName() + "  " + message);
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
		this.inputEnabled = true;
		this.sayMessageFrom(player, message);
		this.timerId = setTimeout(function()
		{
			this.jeu.sendRequest(null);
				
		}, 60000);
		
		
	},

	disableInputFor: function(player, message)
	{
		this.inputEnabled = false;	
	},
	
	sendRequest : function(request)
	{
		if(!this.inputEnabled)
		{
			return;
		}
		if(this.timerId)
		{
			clearTimeout(this.timerId);
		}
		this.jeu.sendRequest(request);
		
	},

	annonceWinner: function(winner)
	{
		
	},
	
	refreshScreen: function()
	{
		var oppPays = this.jeu.getOppPays();
		if(oppPays)
		{
			$("#statut-div").html("");
			oppPays.forEach(function(letter)
			{
				$("#statut-div").append("<span class='letter'>" + letter + "</span>");
			});
		}
		
		$("#ecran-geant").html("");
		if(this.screenLog.length < 5)
		{
			this.screenLog.forEach(function(entry)
			{
				$("#ecran-geant").append("<br/><span>"+entry+"</span>");
			});
		}
		else
		{
			this.screenLog.slice(this.screenLog.length-5).forEach(function(entry)
			{
				$("#ecran-geant").append("<br/><span>"+entry+"</span>");
			});
		}
		
	}

}

var judge = new Judge();

