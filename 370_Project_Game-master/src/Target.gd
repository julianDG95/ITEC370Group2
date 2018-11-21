#	Code Produced as part of a project for Dr. Joe Chase
#	Radford University: ITEC370
#	Date: 	April 22nd, 2018
#	By: 	Andrew McGuiness, Ryan Kelley, Andrew Albanese, Michael Hall
#	All rights are reserved by the above entities.
#
#	Purpose:  When a target is displayed on the screen, it needs to automatically
#	load and display the correct sprite based on which theme the game is using. 
#	This script allows the creator to select which sprite to display for each
#	theme.  When the target is displayed, the global settings will be queried
#	and the target will display the correct sprite for that theme. 

extends Node2D

onready var global = get_node("/root/Global")

# Texture to use for the carnival theme
export(Texture) var carnivalTex

# Texture to use for the space theme
export(Texture) var spaceTex

export var deltaX = 0.0
export var deltaY = 0.0

var hasBeenHit = false

# When the target loads, the theme is used to determine which texture to use
func _ready():
	# Set the theme to the space theme
	if global.themeLabel == "Space":
		$TargetSprite.texture = spaceTex
	
	# By default use the carnival theme
	else:
		$TargetSprite.texture = carnivalTex

func setVelocity(dx, dy):
	deltaX = dx
	deltaY = dy

func _process(delta):
	position += Vector2(deltaX, deltaY) * delta

func get_area():
	return $Area2D


func _on_Area2D_mouse_entered():
	hasBeenHit = true


func _on_Area2D_mouse_exited():
	hasBeenHit = false
