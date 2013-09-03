<?php

	session_start();
	require 'system/config.php';

	if($_SESSION['token'] !== $_POST['token']){
   		die("Request forgery detected");
	}
	
	if(isset($_POST['user']) and !empty($_POST['user']['username']) and !empty($_POST['user']['password']) and !empty($_POST['user']['full_name'])) {
		$username = $_POST['user']['username'];
		$password = $_POST['user']['password'];
		$password_confirmation = $_POST['user']['password_confirmation'];
		$full_name = $_POST['user']['full_name'];
	
		if($password != $password_confirmation){
			$_SESSION['error'] = "The password and the password confirmation don't match!";
			header("Location: ".ROOT_PATH."signup.php");
			exit;
		}
		
		$stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
		
		if(!$stmt) {
			$_SESSION['error'] = "Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}

		$stmt->bind_param('s', $username);
		$stmt->execute();

		$stmt->bind_result($cnt);
		$stmt->fetch();

		if($cnt > 0) {
			$_SESSION['error'] = "This username already exists. Please try again with a new username!";
			header("Location: ".ROOT_PATH."signup.php");
			exit;
		}
		$stmt->close();		
	
		$stmt = $mysqli->prepare("INSERT INTO users (login, full_name, crypted_password) VALUES (?, ?, ?)");
		
		if(!$stmt) {
			$_SESSION['error'] = "Insertion failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
		
		$stmt->bind_param('sss', $username, $full_name, crypt($password));
		$stmt->execute();
		$id = $stmt->insert_id;
		$stmt->close();

		$_SESSION['user'] = array(
			"id" => $id,
			"username" => $username,
			"full_name" => $full_name,
			"role" => 'user'
		);

		$_SESSION['success'] = "Signed in successfully. Welcome ".$full_name."!";
		header("Location: ".ROOT_PATH."index.php");
		exit;

	} else {  
		$_SESSION['error'] = "An error ocurred while signing up. Try again!";
		header("Location: ".ROOT_PATH."signup.php");
		exit;
	}

?>
