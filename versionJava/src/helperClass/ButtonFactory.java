package helperClass;

import java.awt.Dimension;
import java.awt.Font;

import javax.swing.*;

public class ButtonFactory extends JButton {
	public ButtonFactory(String name){
		super(name);
		setPreferredSize(new Dimension(100,50));
		setFont(new Font("Arial", Font.PLAIN, 16));
	}
	
	public ButtonFactory(ImageIcon image){
		super(image);
	}
}
