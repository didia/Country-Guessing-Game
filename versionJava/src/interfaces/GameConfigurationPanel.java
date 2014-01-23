package interfaces;

import helperClass.ButtonFactory;
import helperClass.Default;

import java.awt.*;
import java.awt.event.ActionEvent;

import javax.swing.*;

import GameData.CurrentConfiguration;

public class GameConfigurationPanel extends WelcomePanel{
	private JLabel playerName;
	private JLabel selectLevelText;
	private JPanel centerContainer;
	private JButton francaisButton;
	private JButton englishButton;
	private JButton levelEasyButton;
	private JButton levelMediumButton;
	private JButton levelHardButton;
	private JButton submit;
	private JButton startGame;
	private JTextField nameField;
	
	GridBagConstraints gbc = new GridBagConstraints();
	
	public GameConfigurationPanel(){
		centerContainer=new JPanel( new GridBagLayout()); 
		
		ImageIcon frenchImage= new ImageIcon(getClass().getResource("../images/frenchFlag.png"));
		ImageIcon englishImage= new ImageIcon(getClass().getResource("../images/englishFlag.png"));
		
		francaisButton = new ButtonFactory(Default.FR,200,80);
		francaisButton.setIcon(frenchImage);
		francaisButton.addActionListener(this);
		gbc.gridx=0;
		gbc.gridy=0;
		centerContainer.add(francaisButton,gbc);

		englishButton = new ButtonFactory(Default.EN,200,80);
		englishButton.setIcon(englishImage);
		englishButton.addActionListener(this);
		gbc.gridx=1;
		gbc.gridy=0;
		centerContainer.add(englishButton,gbc);
		
		playerName = new JLabel(Default.PLAYER_NAME);
		playerName.setForeground(Color.black);
		gbc.gridx=1;
		gbc.gridy=0;
		playerName.setVisible(false);
		centerContainer.add(playerName,gbc);
		
		nameField=new JTextField(20);
		nameField.setVisible(false);
		gbc.gridx=1;
		gbc.gridy=1;
		centerContainer.add(nameField,gbc);
		
		submit = new ButtonFactory(Default.SUBMIT,50,20);
		submit.addActionListener(this);
		gbc.gridx=2;
		gbc.gridy=1;
		submit.setVisible(false);
		centerContainer.add(submit,gbc);
		
		selectLevelText = new JLabel("Choose the level");
		selectLevelText.setForeground(Color.black);
		gbc.gridx=1;
		gbc.gridy=0;
		selectLevelText.setVisible(false);
		centerContainer.add(selectLevelText,gbc);
		
		
		
		levelEasyButton = new ButtonFactory(Default.EASY_LEVEL,100,40);
		levelEasyButton.setForeground(Color.GREEN);
		levelEasyButton.setVisible(false);
		levelEasyButton.addActionListener(this);
		gbc.gridx=0;
		gbc.gridy=1;
		centerContainer.add(levelEasyButton,gbc);
		
		levelMediumButton = new ButtonFactory(Default.MEDIUM_LEVEL,100,40);
		levelMediumButton.setForeground(Color.orange);
		levelMediumButton.setVisible(false);
		levelMediumButton.addActionListener(this);
		gbc.gridx=1;
		gbc.gridy=1;
		centerContainer.add(levelMediumButton,gbc);
		
		levelHardButton= new ButtonFactory(Default.HARD_LEVEL,100,40);
		levelHardButton.setForeground(Color.red);
		gbc.gridx=3;
		gbc.gridy=1;
		levelHardButton.setVisible(false);
		levelHardButton.addActionListener(this);
		centerContainer.add(levelHardButton,gbc);
		
		startGame = new ButtonFactory(Default.START_GAME, 120,50);
		startGame.setVisible(false);
		gbc.gridx=1;
		gbc.gridy=0;
		centerContainer.add(startGame, gbc);
		
		add(WelcomePanel.topPanel,BorderLayout.NORTH);
		add(centerContainer,BorderLayout.CENTER);
		
	}
	public void actionPerformed(ActionEvent e) {
		String action=e.getActionCommand();
		switch(action){
		case Default.FR:
			CurrentConfiguration.selectedLanguage=Default.FR;
			englishButton.setVisible(false);
			francaisButton.setVisible(false);
			playerName.setVisible(true);
			break;
		case Default.EN:
			CurrentConfiguration.selectedLanguage=Default.EN;
			englishButton.setVisible(false);
			francaisButton.setVisible(false);
			playerName.setVisible(true);
			nameField.setVisible(true);
			submit.setVisible(true);
			break;
		case Default.CONTINUE:
			MainFrame.setPanel(new PlayingPanel());
			break;
		case Default.SUBMIT:
			if(nameField.getText().toString().isEmpty()){
				JFrame frame = new JFrame();
				JOptionPane.showMessageDialog(frame, "Please enter a name");
			}else{
				CurrentConfiguration.playerName=nameField.getText().toString();
				playerName.setVisible(false);
				nameField.setVisible(false);
				submit.setVisible(false);
				selectLevelText.setText("Weclcome "+ nameField.getText().toString()+", "+ selectLevelText.getText().toString());
				selectLevelText.setVisible(true);
				levelEasyButton.setVisible(true);
				levelMediumButton.setVisible(true);
				levelHardButton.setVisible(true);
			}
			break;
		case Default.EASY_LEVEL:
		case Default.MEDIUM_LEVEL:
		case Default.HARD_LEVEL:
			CurrentConfiguration.selectedLevel=action;
			System.out.println(CurrentConfiguration.selectedLevel);
			levelEasyButton.setVisible(false);
			levelMediumButton.setVisible(false);
			levelHardButton.setVisible(false);
			selectLevelText.setVisible(false);
			startGame.setVisible(true);
			break;
		}	
			
	}
}
