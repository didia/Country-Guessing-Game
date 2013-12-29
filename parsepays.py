#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
Ce module permet d'obtenir la liste des pays valides, a partir d'un fichier
donnee.
"""
__auteur__ = "Thefuture2092"


def obtenirListePays(langue):
    """
    cette fonction prend un argument langue et retourne la liste de pays
    dans cette langue.
    """
    # ouvrir un fichier selon la langue fournie
    fin = open('countrylist.txt', encoding="utf-8") if langue.lower() == 'en' else open('listePaysFr.txt', encoding="utf-8")

    listepays = []
    prelistepays = []
    
    for l in fin:
        
        prelistepays.append(l.replace('\x00','').strip().lower())
    for l in prelistepays:
        if l:
            listepays.append(l)
    listepays[0]=listepays[0][2:]
    fin.close()
    return listepays
    #print(listepays)


                
