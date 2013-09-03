<?php
	
	session_start();
	require "config.php";
	
	header("Content-Type: application/json");
	
	$list = array();
	
	if(!isset($_GET['comic_id'])) {
	
		if(isset($_GET['q'])) {
			$query = "%".mysql_real_escape_string($_GET['q'])."%";
		}
	
		$stmt = $mysqli->prepare("SELECT id, name FROM characters WHERE name LIKE ?");
		if(!$stmt) {
			$_SESSION['error'] = "Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
	
		$stmt->bind_param('s', $query);
	
	} else {
	
		$comic_id = $_GET['comic_id'];
		
		$stmt = $mysqli->prepare("SELECT id, name FROM characters JOIN comics_characters ON id = character_id WHERE comic_id = ?");
		if(!$stmt) {
			$_SESSION['error'] = "Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
	
		$stmt->bind_param('i', $comic_id);
	}
	
	$stmt->execute();
	$stmt->bind_result($id, $name);
	
	while($stmt->fetch()) {
		array_push($list, array("id" => "$id", "name" => $name));
	}
	
	$stmt->close();
	
	echo json_encode($list);
	exit;
	
?>