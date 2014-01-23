package helperClass;

import java.awt.Dimension;
import java.awt.Font;

import javax.swing.*;

public class ButtonFactory extends JButton {
	public ButtonFactory(String name,int x,int y){
		super(name);
		setPreferredSize(new Dimension(x,y));
		if(x>=100){
			setFont(new Font("Arial", Font.PLAIN, 16));
		}else{
			setFont(new Font("Arial", Font.PLAIN, 12));
		}
		
	}
	
	public ButtonFactory(ImageIcon image){
		super(image);
	}
}
