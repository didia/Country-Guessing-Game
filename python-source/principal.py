#!/usr/bin/env python
# -*- coding: utf-8 -*-

from JeuDePays import *


"""
Ceci est le module qui contient le jeu de pays. Un joueur va jouer contre
le CPU. Ils doivent les deux choisir un pays et tenter de decouvir le pays de l'autre
celui qui decouvre le pays de l'autre avant a gagne.
"""
__auteur__ = "Thefuture2092"

print('Ceci est un jeu de pays')
print('*#='*8)
print('*#='*8)
print('   '*8)
langue = input("Which language?/Quelle langue? 'en' for english/'fr' pour le francais: ")
while(langue != "en" and langue != "fr"):
    langue = input("Enter 'en' for english/Entrez 'fr' pour le francais: ")
jeu1 = JeuDePays(langue.lower())


joueur1 = Joueur(input('Bienvenue! Quelle est votre nom?: ') if langue.lower() == "fr" else \
       input('Welcome! What\'s your name?: '))

print('*#'*40)
print("Voici les regles: Entrez une lettre pour demande a l'adversaire si la lettre se trouve dans\
le nom de pays de votre adversaire. Au cous ou vous entrez plus d'une lettre ce sera alors\
une tentative de deviner le pays de l'adversaire")
print('*#='*40)
print(' '*40)

while True:
    while True:
        try:
            level = int(input('Choisissez un niveau de difficulte(1-5)?'))
            assert level >= 1 and level <= 5
            break;
        except :
            print('You should enter a number between 1 and 5')
        
    cpu = Cpu(jeu1, level)
    while(not joueur1.choisirPays(input("Entrez votre pays, {}:".format(joueur1)).strip(), jeu1)):
        if joueur1.choisirPays(input("Entrez un pays qui existe:").strip(),jeu1): break;
    joueur1.initiateOppInfo(cpu)
    cpu.initiateOppInfo(joueur1)

    print('Judge says: Le Pays de << {} >> a {} lettres et Celui de << CPU>> a {} lettres'\
          .format(joueur1, len(joueur1.pays), len(cpu.pays)))
    while True:
        requete = input('{}: Demandez si le pays de CPU a ou est : '.format(str(joueur1)))
        reponse = joueur1.asTu(requete, cpu) if len(requete) == 1 else joueur1.estCeTonPays(requete, cpu)
        if len(requete) != 1:
            if reponse:
                jeu1.winner(str(joueur1))
                print('{} a trouve le pays de cpu et a gagne'.format(str(joueur1)))
                break
            else:
                print('CPU says: Mon pays n\'est pas "{}"'.format(requete))
        elif reponse:
            print('CPU says: Mon pays a "{}" a la (aux) position(s) {}'.format(requete, reponse))
        else:
            print('CPU says: Mon pays n\'a pas "{}"'.format(requete))

        if cpu.matchedcountry: #Check if the cpu has already started guessing
            guess = cpu.pick() #if yes then cpu must guess the country

            # if the guess is correct, the game is over
            if guess == joueur1.pays:
                jeu1.winner(str(cpu))
                print('CPU a trouve ton pays "{}", tu as perdu, son pays etait "{}"'.format(guess, cpu.pays))
                break

            #if it is not correct, then print a message and continue
            else:
                print('CPU asks: Est-ce Ton Pays "{}"?'.format(guess))
                print('Judge says: Non, ce n\'est pas son pays. CPU passe la main')
                continue


        #In case cpu has not started guessing the normal flow of the program

        reponse = cpu.asTu(joueur1)

        if reponse[1]:
            print('Judge says: CPU a trouve la lettre "{}" a la (aux) position(s) {} de votre pays'.format(reponse[0], reponse[1]))
        else:
            print('Judge says: CPU n\'a pas trouve "{}" dans votre pays'.format(reponse[0]))
        print('*'*10 + ' EVOLUTION ' + '*'*10)
        print('*'+' '*29+'*')
        print('*'+' '*9+ ' '.join(joueur1.opppays)+' '*8+'*')
        print('*'*10 + ' EVOLUTION ' + '*'*10)
        print('*'+' '*29+'*')

        #check if it is time to start guessing
        cpu.isTimeToGuess(joueur1)
                
                
    rep = input('Voulez-vous commencer une nouvelle partie? yes or no: ')
    if not rep=='yes':
        break
    
        
        
    
