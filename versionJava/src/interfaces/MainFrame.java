package interfaces;

import javax.swing.*;

import GameData.CurrentConfiguration;
import helperClass.*;

import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
public class MainFrame extends JFrame {
	
	private JPanel welcomePanel;
	private JPanel centerPanel;
	
	public MainFrame(){
		super("Guess Game");
		welcomePanel=new WelcomePanel();
			
		add(welcomePanel);
		setLocation(300, 150);
		setPreferredSize(new Dimension(800,900));
		setVisible(true);
		setDefaultCloseOperation(this.EXIT_ON_CLOSE);
		pack();
		Default.frame=this;
	}
	
	public static void setPanel(JPanel p){
		Default.frame.add(p);
		Default.frame.invalidate();
		Default.frame.validate();
	}
}
