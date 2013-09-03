<?php

	session_start();
	require 'system/config.php';
	
	if(!logged_in()) {
		$_SESSION['error'] = "You need to be logged in.";
		header("Location: ".ROOT_PATH."login.php");
		exit;
	}
	
	if(isset($_GET['action']) and !empty($_GET['action']) and
		 isset($_GET['id']) and !empty($_GET['id'])) {
		$user_id = current_user_id();
		$character_id = (int) $_GET['id'];
		$action = $_GET['action'];
		
		if($action == "add" or $action == "remove") {	
			$stmt = $mysqli->prepare("DELETE FROM favorite_characters WHERE user_id = ? AND character_id = ?");
			$stmt->bind_param('ii', $user_id, $character_id);
			$stmt->execute();
			$stmt->close();
			
			if($action == "add") {
				$stmt = $mysqli->prepare("INSERT INTO favorite_characters (user_id, character_id) VALUES (?, ?)");
				$stmt->bind_param('ii', $user_id, $character_id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		header("Location: ".ROOT_PATH."character.php?id=".$character_id);
		exit;
	}
	exit;

?>