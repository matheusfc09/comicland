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
	
	if(isset($_POST['name']) and !empty($_POST['name'])) {
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$description = nl2br(strip_tags($_POST['description'], '<b><i>'));
		$powers = nl2br(strip_tags($_POST['powers'], '<b><i>'));
		
		// Create a new character
		if(!isset($_POST['id']) and isset($_POST['image_path']) and !empty($_POST['image_path'])) {
			
			$image_path = $_POST['image_path'];
			$extension = explode(".", $image_path);
			$extension = end($extension);
			$x_crop = $_POST['x_crop'];
			$y_crop = $_POST['y_crop'];
			$width_crop = $_POST['width_crop'];
			$height_crop = $_POST['height_crop'];
			$width = $_POST['width'];
			$height = $_POST['height'];
					
			$stmt = $mysqli->prepare("INSERT INTO characters (name, gender, description, powers) values (?, ?, ?, ?)");
			if(!$stmt) {
				$_SESSION['error'] = "Insertion Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
					
			$stmt->bind_param('ssss', $name, $gender, $description, $powers);
			$stmt->execute();
			$id = $stmt->insert_id;
			$stmt->close();

			smart_resize_image($image_path, $width, $height, 0, 0, -1, -1, false, 'file', true, false);
			
			$filename = "img/characters/".$id.".".$extension;
			smart_resize_image($image_path, 312, 442, $x_crop, $y_crop, $width_crop, $height_crop, false, $filename, true, false);
			
			$stmt = $mysqli->prepare("UPDATE characters SET img_name = ? WHERE id = ?");
			if(!$stmt) {
				$_SESSION['error'] = "Edition Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			$stmt->bind_param('si', $filename, $id);
			$stmt->execute();
			$stmt->close();
			
			// News Feed
			$feed_action = "created a new";
			$feed_type = "character";
			$feed_content = $name;
			$feed_link = "character.php?id=".$id;
			$feed_user_id = current_user_id();
			$stmt = $mysqli->prepare("INSERT INTO news_feed (action, type, content, link, user_id) VALUES (?, ?, ?, ?, ?)");	
			$stmt->bind_param('ssssi', $feed_action, $feed_type, $feed_content, $feed_link, $feed_user_id);
			$stmt->execute();
			$stmt->close();
					
			$_SESSION['success'] = "Character created successfully";
			header("Location: ".ROOT_PATH."index.php");
			exit;
			
		} else if (isset($_POST['id'])){
			
			$id = $_POST['id'];
			
			$stmt = $mysqli->prepare("UPDATE characters SET name = ? , gender = ?, description = ?, powers = ? WHERE id = ?");
			if(!$stmt) {
				$_SESSION['error'] = "Edition Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			$stmt->bind_param('ssssi', $name, $gender, $description, $powers, $id);
			$stmt->execute();
			$stmt->close();
			
			// Update Character Picture
			if(isset($_POST['image_path']) and !empty($_POST['image_path'])) {

				$image_path = $_POST['image_path'];
				$extension = explode(".", $image_path);
				$extension = end($extension);
				$x_crop = $_POST['x_crop'];
				$y_crop = $_POST['y_crop'];
				$width_crop = $_POST['width_crop'];
				$height_crop = $_POST['height_crop'];
				$width = $_POST['width'];
				$height = $_POST['height'];
				
				smart_resize_image($image_path, $width, $height, 0, 0, -1, -1, false, 'file', true, false);
				
				$filename = "img/characters/".$id.".".$extension;
				smart_resize_image($image_path, 312, 442, $x_crop, $y_crop, $width_crop, $height_crop, false, $filename, true, false);
				
				$stmt = $mysqli->prepare("UPDATE characters SET img_name = ? WHERE id = ?");
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
			$feed_type = "character";
			$feed_content = $name;
			$feed_link = "character.php?id=".$id;
			$feed_user_id = current_user_id();
			$stmt = $mysqli->prepare("INSERT INTO news_feed (action, type, content, link, user_id) VALUES (?, ?, ?, ?, ?)");	
			$stmt->bind_param('ssssi', $feed_action, $feed_type, $feed_content, $feed_link, $feed_user_id);
			$stmt->execute();
			$stmt->close();

			$_SESSION['success'] = "Character updated successfully";
			header("Location: ".ROOT_PATH."index.php");
			exit;
					
		}
	}
	
	$_SESSION['error'] = "An error ocurred while processing the character. Try again!";
	header("Location: ".ROOT_PATH."error.php");
	exit;
	
?>
