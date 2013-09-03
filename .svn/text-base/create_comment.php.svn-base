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

	if(isset($_POST['comment']) and !empty($_POST['comment'])) {
		$comment = nl2br(strip_tags($_POST['comment'], '<b><i>'));
		$user_id = current_user_id();
		$bc_id = (int) $_POST['bc_id'];
		$character_id = $_POST['character_id'];
				
		$stmt = $mysqli->prepare("INSERT INTO board_comments (comment, topic_id, user_id) VALUES (?, ?, ?)");
		if(!$stmt) {
			$_SESSION['error'] = "Insertion Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
				
		$stmt->bind_param('sii', $comment, $bc_id, $user_id);
		$stmt->execute();
		$stmt->close();
		
		// News Feed
		$feed_action = "commented on a";
		$feed_type = "discussion board";
		$feed_content = "'".substr(htmlentities($comment), 0, 20)."...'";
		$feed_link = "character.php?id=".$character_id;
		$feed_user_id = current_user_id();
		$stmt = $mysqli->prepare("INSERT INTO news_feed (action, type, content, link, user_id) VALUES (?, ?, ?, ?, ?)");	
		$stmt->bind_param('ssssi', $feed_action, $feed_type, $feed_content, $feed_link, $feed_user_id);
		$stmt->execute();
		$stmt->close();
		
		$_SESSION['success'] = "Comment created successfully!";
		header("Location: ".ROOT_PATH."character.php?id=".$character_id);
		exit;
				
	}
	
	$_SESSION['error'] = "An error ocurred while processing the character. Try again!";
	header("Location: ".ROOT_PATH."error.php");
	exit;
	
?>
