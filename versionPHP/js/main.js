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

var JeuDePays = function(pseudo , oponent_name, language, remote){
	self.player1 = new Player(pseudo);
	self.cpu = new Cpu(oponent_name);
	self.tour = 0;
	self.language = language;
	self.remote = remote;
	self.list_pays = self.get_pays(language);
	self.judge = new Judge()
	
};

JeuDePays.prototype = {
	constructor : JeuDePays,
	
	get_pays : function(language){
	
	},
	
	play : function()
	{
		self.cpu.choisirPays();
		pays = self.judge.getPays(player1, "Entrez votre pays");
		while (!self.player1.choisirPays(pays)) 
		{
			self.judge.says("Nous n'avons pas trouvé le pays que vous avez choisi");
			pays = self.judge.getPays(player1, "Choisissez un nouveau pays (ignorez les accents)");
		}
		self.judge.message_from(self.cpu, "Mon pays a " + self.cpu.getCountryLength() + " lettres");
		
	}
	
		
}

