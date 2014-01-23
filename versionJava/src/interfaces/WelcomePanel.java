package interfaces;


import javax.swing.*;
import helperClass.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class WelcomePanel extends JPanel implements ActionListener {
	public static JPanel topPanel;
	private JPanel bottomPanel;
	private JButton exitButton;
	private JButton continueButton;
	private JButton helpButton;
	private JLabel welcomeLabel;
	
	public WelcomePanel(){
		super(new BorderLayout());
		exitButton = new ButtonFactory(Default.EXIT,100,50);
		exitButton.addActionListener(this);
		continueButton = new ButtonFactory(Default.CONTINUE,100,50);
		continueButton.addActionListener(this);
		
		helpButton = new ButtonFactory("Help",100,50);
		helpButton.addActionListener(null);
		welcomeLabel = new JLabel("Welcome to The Country Guessing Game");
		welcomeLabel.setFont(welcomeLabel.getFont().deriveFont(25.0f));
		welcomeLabel.setForeground(Color.white);
		
		topPanel = new JPanel(new GridLayout(2,1));
		topPanel.setBackground(Color.black);
		topPanel.add(welcomeLabel);
		
		bottomPanel = new JPanel();
		bottomPanel.add(exitButton);
		bottomPanel.add(continueButton);
		bottomPanel.add(helpButton);
		bottomPanel.setBackground(Color.black);
		
		add(topPanel,BorderLayout.NORTH);
		add(bottomPanel,BorderLayout.SOUTH);
		
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		String action=e.getActionCommand();
		switch(action){
		case Default.EXIT:
			Default.frame.dispose();
			break;
		case Default.CONTINUE:
			MainFrame.setPanel(new GameConfigurationPanel());
			continueButton.setVisible(false);
			break;
		}
		
		
	}
}
