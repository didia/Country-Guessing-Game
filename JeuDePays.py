#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
Ce module renferme toutes les classes et fonctionnalites utiles au jeu de pays.
"""

__auteur__ = "Thefuture2092"

#importation
import parsepays
import random
import re


class JeuDePays:
    """
    Cette classe definit une nouvelle partie
    """

    def __init__(self, langue):
        """
        string langue: dans quelle langue on veut jouer
        Cree une nouvelle instance du jeu dans la langue donnee.
        """
        self.listedepays = parsepays.obtenirListePays(langue)

    def winner(self, winner):
        """
        winner: type Joueur, definit le joueur qui a gagnE le jeu self 
        """
        self.winner = winner
        
class Joueur:
    """
    Cette classe definit un joueur de JeuDePays
    """
    def __init__(self, nom):
        """
        create an instance of Joueur with string nom as name
        """
        self.nom = nom
        
    def __str__(self):
        """
        __str__(Joueur) -> string
        """

        return self.nom
    
    def choisirPays(self, pays, jeu):
        """
        Choose a country and return True if a valid country is given else false

        Keyword arguments:
        pays -- the country chosen
        jeu  -- The party being played
        """
        
        
        if pays.lower() in jeu.listedepays:
            self.pays = pays.lower()
            return True
        else: return False

    def asTu(self, letter, other):
        """
        Ask if the opponent's country has a given letter
        return the position(s) at which the letter(s) is/are
        or false if it doesn't not contain the letter

        Keyword arguments:
        letter -- the letter to be asked
        other  -- the opponent we are asking to.
        """
        
        lettres = []
        i = 0
        for n in other.pays:
            if n == letter.lower():
                lettres.append(str(i+1))
                self.opppays[i] = n
            i += 1
        return ' '.join(lettres) if lettres else False

    def estCeTonPays(self, flag, other):
        """
        Guess the opponent's country
        return true if we found the country or false if we didn't

        Keyword arguments:
        flag  -- the name we guessed
        other -- the opponent whose name we are guessing 
        """
        return True if flag.lower() == other.pays else False

    def combienDeLettre(self):
        """
        return the number of letter of the country chosen by self
        """
        return len(self.pays)
    
    def initiateOppInfo(self, other):
        """
        initialize opponent's information and save it in opppays
        return nothing

        Keyword arguments:
        other -- the opponent
        """
        #remplir initiallement de ??????
        self.opppays = ['?' for i in range(len(other.pays))]

    def getOpppays(self):
        """
        retun the opponent's country
        """
        return self.opppays
    def getLenOpppays(self):
        """
        return the number of letters of your oppenents country so far found
        """
        return len(list(f for f in self.opppays if f!='?'))

class Cpu(Joueur):
    """
    This is a class modeling a player controlled by the computer
    """
    levels = (0.7, 0.6, 0.5, 0.4, 0.3)
    def __init__(self, jeu, level):
        """
        Create a cpu instance for a game jeu
        """
        super().__init__(nom = 'CPU')
        self.pays = random.choice(jeu.listedepays)
        self.opppays = []
        self.jeu = jeu
        self.matchedcountry = []
        self.letterstoask = ['a','b','c','d','e','f','g','h','i','j','k','l','z',\
                             'm','n','o','p','q','r','s','t','u','v','w','x','y']
        self.level = level


    def getCountryMatched(self):
        """
        This function create a group of matched country.
        """
        #take all the letters in opppays by replacing all '?' by '.' and convert
        # it to a regular expression
        print((''.join(self.opppays)).replace('?','.'))
        regex = re.compile((''.join(self.opppays)).replace('?','.'))

        # A non efficient way to check all the country in countrylist and find
        # which one matches and yield it (to change eventually)
        
        for pays in self.jeu.listedepays:
            if regex.findall(pays):
                self.matchedcountry.append(pays)

    def pick(self):
        """
        This function picks a country among the matched country
        """
        pick = random.choice(self.matchedcountry)
        self.matchedcountry.remove(pick)
        return pick

    def asTu(self, joueur1):
        """
        This is the function by which the cpu ask if the opponent has a random
        letter or not.
        it returns a tuple which has the letter requested and its position in
        the country's name
        """
        #pop a random letter from letterstoask
        requete = random.choice(self.letterstoask)
        self.letterstoask.remove(requete)

        return(requete, super().asTu(requete, joueur1))

    def isTimeToGuess(self, joueur1):
        """
        This function first checks if it is the time for CPU to start guessing
        opponnent Country depending of the difficult of the Game.
        If it is time, the function then search for matched country and add them
        to matchedcountry
        """

        if self.getLenOpppays()/len(joueur1.pays) >= Cpu.levels[self.level-1]:
            self.getCountryMatched()

        
            
            
            
    
    
        
        
        
        
        
            
            
        
        
