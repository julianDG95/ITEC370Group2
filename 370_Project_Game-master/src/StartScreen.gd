#	Code Produced as part of a project for Dr. Joe Chase
#	Radford University: ITEC370
#	Date: 	April 22nd, 2018
#	By: 	Andrew McGuiness, Ryan Kelley, Andrew Albanese, Michael Hall
#	All rights are reserved by the above entities.
#
#	Purpose: The Start Screen is the Main Menu of the game.  It is the first
#	thing that is displayed to the user.  This script is designed to handle the
#	click events for all of the buttons on the Main Menu.  This script also 
#	initializes the theme assets and loads them into memory.  The start script
#	will also download and begin parsing the target file.

extends Control

onready var global = get_node("/root/Global")

#Themes to use
export(Resource) var carnivalTheme
export(Resource) var spaceTheme

#Background to use
export(Texture) var spaceBackground
export(Texture) var carnivalBackground

#When the program loads, prep the theme and targets
func _ready():
	#Download and parse the target JSON file
	if !global.targetsParsed:
		$targetDownloader.request(global.address + "target_hunter/targetFile.json")
	
	#Set the theme and background
	$Panel.theme = global.currentTheme
	$background.texture = global.currentBackground

#Start a new game for the user
func _on_New_Game_pressed():
	#Ensure the target parser is done, then change the scene
	if global.targetsParsed:
		get_tree().change_scene("res://screens/PlayScreen.tscn")

	#Target parser is not done, need to wait
	else:
		print("Loading Targets")

#Change to the high score scene
func _on_High_Scores_pressed():
	get_tree().change_scene("res://screens/ScoreScreen.tscn")

#When the target file is done downloading, parse it
func _on_TargetDownload_completed(result, response_code, headers, body):
	global.parseTargets( body.get_string_from_utf8() )

#When the currentData file is done downloading, parse that
func _on_dataDownload_completed(result, response_code, headers, body):
	global.parseCurrentDataset(body.get_string_from_utf8() )


#Change the theme based on which is currently is
func _on_ChangeTheme_pressed():
		#Switch to Space
		if global.themeLabel == "Carnival":
			global.themeLabel   = "Space"
			global.currentTheme = preload("res://themes/SpaceTheme.tres")
			global.currentBackground = preload("res://assets/spaceBG.jpg")
		
		#Switch to Carnival
		elif global.themeLabel == "Space":
			global.themeLabel   = "Carnival"
			global.currentTheme = preload("res://themes/CarnivalTheme.tres")
			global.currentBackground = preload("res://assets/carnivalBG.jpg")
		
		#Update the background and the UI to match the current theme
		$background.texture = global.currentBackground
		$Panel.theme = global.currentTheme



#Exit button was clicked, try to exit the game
func _on_Exit_pressed():
	#If we are in an HTML file, then call the javascript
	if global.jsEnv:
		JavaScript.eval("exit()", true)
	
	#Otherwise, just close the window
	else:
		get_tree().quit()
