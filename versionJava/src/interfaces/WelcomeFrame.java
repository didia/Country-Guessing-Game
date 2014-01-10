package interfaces;

import javax.swing.*;

import GameData.CurrentConfiguration;
import helperClass.ButtonFactory;

import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class WelcomeFrame extends JFrame implements ActionListener {
	private final String EXIT="Exit";
	private final String CONTINUE="Continue";
	private final String FR="FRANCAIS";
	private final String EN="ENGLISH";
	private JPanel mainPanel;
	private JPanel bottomPanel;
	private JPanel centerPanel;
	private JButton exitButton;
	private JButton continueButton;
	private JButton helpButton;
	private JButton francaisButton;
	private JButton englishButton;
	private JLabel welcomeLabel;
	private JLabel languageSelection;
	
	public WelcomeFrame(){
		super("Guess Game");
		ImageIcon frenchImage= new ImageIcon(getClass().getResource("../images/frenchFlag.png"));
		ImageIcon englishImage= new ImageIcon(getClass().getResource("../images/englishFlag.png"));
		welcomeLabel = new JLabel("Welcome to The Guessing Game");
		welcomeLabel.setFont(welcomeLabel.getFont().deriveFont(25.0f));
		welcomeLabel.setForeground(Color.white);
		
		languageSelection= new JLabel("Select a Language / choisissez une Langue: ");
		languageSelection.setForeground(Color.white);
		languageSelection.setVisible(false);
		
		exitButton = new ButtonFactory(EXIT);
		exitButton.addActionListener(this);
		
		continueButton = new ButtonFactory(CONTINUE);
		continueButton.addActionListener(this);
		
		helpButton = new ButtonFactory("Help");
		helpButton.addActionListener(null);
		
		francaisButton = new ButtonFactory(FR);
		francaisButton.setIcon(frenchImage);
		francaisButton.setPreferredSize(new Dimension(200,80));
		francaisButton.addActionListener(this);
		
		englishButton = new ButtonFactory(EN);
		englishButton.setIcon(englishImage);
		englishButton.setPreferredSize(new Dimension(200,80));
		englishButton.addActionListener(this);
		
		mainPanel = new JPanel(new GridLayout(2,1));
		mainPanel.setBackground(Color.black);
		
		bottomPanel = new JPanel();
		bottomPanel.add(exitButton);
		bottomPanel.add(continueButton);
		bottomPanel.add(helpButton);
		bottomPanel.setBackground(Color.black);
		
		centerPanel = new JPanel();
		centerPanel.add(francaisButton);
		centerPanel.add(englishButton);
		centerPanel.setVisible(false);
		
		mainPanel.add(welcomeLabel);
		mainPanel.add(languageSelection);
		
		setLocation(300, 150);
		setPreferredSize(new Dimension(600,600));
		setVisible(true);
		setDefaultCloseOperation(this.EXIT_ON_CLOSE);
		pack();
		getContentPane().add(mainPanel,BorderLayout.NORTH);
		getContentPane().add(centerPanel,BorderLayout.CENTER);
		getContentPane().add(bottomPanel,BorderLayout.SOUTH);
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		String command = e.getActionCommand();
		if(command.equals(EXIT)){
			this.setVisible(false);
			this.dispose();
		}
		else if (command.equals(CONTINUE)){
			continueButton.setVisible(false);
			languageSelection.setVisible(true);
			centerPanel.setVisible(true);
		}
		else if(command.equals(FR)){
			CurrentConfiguration.selectedLanguage=FR;
			englishButton.setVisible(false);
		}
		else if(command.equals(EN)){
			CurrentConfiguration.selectedLanguage=EN;
			francaisButton.setVisible(false);
		}
	}
}
