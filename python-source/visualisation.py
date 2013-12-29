#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
This is the package responsible of the Gui UI for The game Jeu De Pays
"""
__auteur__ = 'Thefuture2092'

from tkinter import *

root = Tk()

#creation des variables a utiliser
language = StringVar()
ngameimg = PhotoImage(file="ngame.gif")
countryflag = PhotoImage(file = "flag.gif")
startimg = PhotoImage(file ="play.gif")
# create the welcome frame
welcomescreen = Frame(root, bg="black")
#inside the welcome the first label, the name of the game
gname = Frame(welcomescreen, bg ="black")
gamename = Label(gname, image=ngameimg, justify = 'center')
gamename.grid(padx=5,pady=(5, 10))
gname.grid(row=1)

#and a text to say welcome
wcome = Frame(welcomescreen, height = 100, width = 500, bg ="black")
welcome = Label(wcome, image = countryflag, fg="yellow", bg ="black", justify="center")
welcome.pack()
wcome.grid(row=2, pady=(0, 50))

#and a radio button for the language selection
 #first the frame
flanguage = Frame(welcomescreen, height = 100, width= 500, bg = "black")
 #the language label first
languagel = Label(flanguage, text = "SELECT A LANGUAGE BELOW:", font=32, bg="black",\
                  fg="green")
languagel.grid(row=1,pady=(0,10))
 # the two radio buttons
language1=Radiobutton(flanguage, selectcolor= "yellow", variable=language, value='fr', text="Francais",\
                      bg="black", fg="blue", font=20, justify = "center")
    ##french selected by default
language1.select()
language1.grid(row=2)

language2=Radiobutton(flanguage, selectcolor= "yellow", variable=language, value='en', text="English",\
                      bg="black", fg="blue", font=20, justify="center")
language2.grid(row=3)

flanguage.grid(row=3)

#the start button
startbutton=Button(welcomescreen, image=startimg, bg="black", justify="center")
startbutton.grid(row=4)

#the copyright label

copright = Label(welcomescreen, text="G2Pays, a game made by Aristote Diasonama(aka thefuture2092), Allrights reserved",\
                 bg="black",font=8,fg="purple")
copright.grid(row=5,sticky="s",pady=(50,0))

welcomescreen.pack()
root.mainloop()
    
