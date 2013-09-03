<?php
	
	session_start();
	require "system/config.php";
	
	if($_SESSION['token'] !== $_POST['token']){
   		die("Request forgery detected");
	}
	
	if(!logged_in()) {
		$_SESSION['error'] = "You need to be logged in.";
		header("Location: ".ROOT_PATH."login.php");
		exit;
	}

	if(isset($_POST['entry']) and !empty($_POST['entry'])) {
		$entry = nl2br(strip_tags($_POST['entry'], '<b><i>'));
		$user_id = current_user_id();
		$comic_id = $_POST['comic_id'];
				
		$stmt = $mysqli->prepare("INSERT INTO reviews (entry, comic_id, user_id) VALUES (?, ?, ?)");
		if(!$stmt) {
			$_SESSION['error'] = "Insertion Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
				
		$stmt->bind_param('sii', $entry, $comic_id, $user_id);
		$stmt->execute();
		$stmt->close();
		
		// News Feed
		$feed_action = "reviewed a";
		$feed_type = "comic book";
		$feed_content = "'".substr(htmlentities($entry), 0, 20)."...'";
		$feed_link = "comic.php?id=".$comic_id;
		$feed_user_id = current_user_id();
		$stmt = $mysqli->prepare("INSERT INTO news_feed (action, type, content, link, user_id) VALUES (?, ?, ?, ?, ?)");	
		$stmt->bind_param('ssssi', $feed_action, $feed_type, $feed_content, $feed_link, $feed_user_id);
		$stmt->execute();
		$stmt->close();
		
		$_SESSION['success'] = "Comment created successfully!";
		header("Location: ".ROOT_PATH."comic.php?id=".$comic_id);
		exit;
				
	}
	
	$_SESSION['error'] = "An error ocurred while processing the character. Try again!";
	header("Location: ".ROOT_PATH."error.php");
	exit;
	
?>