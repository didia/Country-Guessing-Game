package interfaces;

import helperClass.ButtonFactory;

import javax.swing.*;

public class PlayingPanel extends JPanel {
	private JButton button;
	
	public PlayingPanel(){
		button = new ButtonFactory("Playing Field",100,50);
		add(button);
	}
	
}
