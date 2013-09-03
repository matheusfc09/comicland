<?php
	
	session_start();
	require "system/config.php";
	require "system/smart_resize_image.php";
	
	if($_SESSION['token'] !== $_POST['token']){
   		die("Request forgery detected");
	}
	
	if(!logged_in()) {
		$_SESSION['error'] = "You need to be logged in.";
		header("Location: ".ROOT_PATH."login.php");
		exit;
	}
	
	if(isset($_POST['series']) and !empty($_POST['series']) and isset($_POST['title']) and !empty($_POST['title'])) {
		$series = $_POST['series'];
		$title = $_POST['title'];
		$issue = $_POST['issue'];
		$publisher = $_POST['publisher'];
		$summary = nl2br(strip_tags($_POST['summary'], '<b><i>'));
		$character_ids = explode(",", $_POST['character_ids']);
		
		// Create a new character
		if(!isset($_POST['id']) and isset($_POST['image_path']) and !empty($_POST['image_path'])) {
			
			$image_path = $_POST['image_path'];
			$extension = explode(".", $image_path);
			$extension = end($extension);
					
			$stmt = $mysqli->prepare("INSERT INTO comics (series, title, issue, publisher, summary) VALUES (?, ?, ?, ?, ?)");
			if(!$stmt) {
				$_SESSION['error'] = "Insertion Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
					
			$stmt->bind_param('ssiss', $series, $title, $issue, $publisher, $summary);
			$stmt->execute();
			$id = $stmt->insert_id;
			$stmt->close();

			$filename = "img/comics/".$id.".".$extension;
			smart_resize_image($image_path, 286, 440, 0, 0, -1, -1, false, $filename, true, false);
			
			$stmt = $mysqli->prepare("UPDATE comics SET img_name = ? WHERE id = ?");
			if(!$stmt) {
				$_SESSION['error'] = "Insertition Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			$stmt->bind_param('si', $filename, $id);
			$stmt->execute();
			$stmt->close();
			
			// Insert character_ids in comics_characters
			$stmt = $mysqli->prepare("INSERT INTO comics_characters (comic_id, character_id) VALUES (?, ?)");
			if(!$stmt) {
				$_SESSION['error'] = "Insertition Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			foreach($character_ids as $character_id) {
				$stmt->bind_param('ii', $id, $character_id);
				$stmt->execute();
			}
			$stmt->close();
			
			// News Feed
			$feed_action = "created a new";
			$feed_type = "comic book";
			$feed_content = $series.": ".$title;
			$feed_link = "comic.php?id=".$id;
			$feed_user_id = current_user_id();
			$stmt = $mysqli->prepare("INSERT INTO news_feed (action, type, content, link, user_id) VALUES (?, ?, ?, ?, ?)");	
			$stmt->bind_param('ssssi', $feed_action, $feed_type, $feed_content, $feed_link, $feed_user_id);
			$stmt->execute();
			$stmt->close();
					
			$_SESSION['success'] = "Comic created successfully";
			header("Location: ".ROOT_PATH."index.php");
			exit;
		
			// Updating comic
		} else if (isset($_POST['id'])){
			
			$id = $_POST['id'];
			
			$stmt = $mysqli->prepare("UPDATE comics SET series = ? , title = ?, issue = ?, publisher = ?, summary = ? WHERE id = ?");
			if(!$stmt) {
				$_SESSION['error'] = "Edition Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			$stmt->bind_param('ssissi', $series, $title, $issue, $publisher, $summary, $id);
			$stmt->execute();
			$stmt->close();
			
			// Insert character_ids in comics_characters
			$stmt = $mysqli->prepare("DELETE FROM comics_characters WHERE comic_id = ?");
			if(!$stmt) {
				$_SESSION['error'] = "Edition Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->close();

			$stmt = $mysqli->prepare("INSERT INTO comics_characters (comic_id, character_id) VALUES (?, ?)");
			if(!$stmt) {
				$_SESSION['error'] = "Edition Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			foreach($character_ids as $character_id) {
				$stmt->bind_param('ii', $id, $character_id);
				$stmt->execute();
			}
			$stmt->close();
			
			// Update Comic Picture
			if(isset($_POST['image_path']) and !empty($_POST['image_path'])) {

				$image_path = $_POST['image_path'];
				$extension = explode(".", $image_path);
				$extension = end($extension);
				
				$filename = "img/comics/".$id.".".$extension;
				smart_resize_image($image_path, 286, 440, 0, 0, -1, -1, false, $filename, true, false);
				
				$stmt = $mysqli->prepare("UPDATE comics SET img_name = ? WHERE id = ?");
				if(!$stmt) {
					$_SESSION['error'] = "Edition Query failed!";
					header("Location: ".ROOT_PATH."error.php");
					exit;
				}
				
				$stmt->bind_param('si', $filename, $id);
				$stmt->execute();
				$stmt->close();
			
			}
			
			// News Feed
			$feed_action = "updated a";
			$feed_type = "comic book";
			$feed_content = $series.": ".$title;
			$feed_link = "comic.php?id=".$id;
			$feed_user_id = current_user_id();
			$stmt = $mysqli->prepare("INSERT INTO news_feed (action, type, content, link, user_id) VALUES (?, ?, ?, ?, ?)");	
			$stmt->bind_param('ssssi', $feed_action, $feed_type, $feed_content, $feed_link, $feed_user_id);
			$stmt->execute();
			$stmt->close();

			$_SESSION['success'] = "Comic updated successfully";
			header("Location: ".ROOT_PATH."index.php");
			exit;
					
		}
	}
	
	$_SESSION['error'] = "An error ocurred while processing the comic. Try again!";
	header("Location: ".ROOT_PATH."error.php");
	exit;
	
?>
