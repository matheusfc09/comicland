<?php

	session_start();
	require 'system/config.php';
	
	if(isset($_POST['rate']) and !empty($_POST['rate']) and
		 isset($_POST['user']) and !empty($_POST['user']) and
		 isset($_POST['comic']) and !empty($_POST['comic'])) {
		$user_id = (int) $_POST['user'];
		$comic_id = (int) $_POST['comic'];
		$rate = (int) $_POST['rate'];
		
		$stmt = $mysqli->prepare("SELECT COUNT(*) FROM comic_ratings WHERE user_id = ? AND comic_id = ?");
		$stmt->bind_param('ii', $user_id, $comic_id);
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		
		if($count != 0) {
			$stmt = $mysqli->prepare("DELETE FROM comic_ratings WHERE user_id = ? AND comic_id = ?");
			$stmt->bind_param('ii', $user_id, $comic_id);
			$stmt->execute();
			$stmt->close();
		}
		
		if($rate > 0) {
			$stmt = $mysqli->prepare("INSERT INTO comic_ratings (rate, user_id, comic_id) VALUES (?, ?, ?)");
			$stmt->bind_param('iii', $rate, $user_id, $comic_id);
			$stmt->execute();
			$stmt->close();
		}
	
	}
	exit;

?>