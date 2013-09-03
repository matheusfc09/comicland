<?php

	session_start();
	require 'system/database.php';
	require 'system/config.php';

	if($_SESSION['token'] !== $_POST['token']){
   		die("Request forgery detected");
	}
	
	if(isset($_POST['user']) and !empty($_POST['user']['username']) and !empty($_POST['user']['password'])) {
		$username = $_POST['user']['username'];
		$password = $_POST['user']['password'];

		$stmt = $mysqli->prepare("SELECT COUNT(*), id, full_name, crypted_password, role FROM users WHERE login = ?");
		
		if(!$stmt) {
			$_SESSION['error'] = "Query Failed!";
			header("Location: error.php");
			exit;
		}

		if(isset($_SESSION['user']))
			unset($_SESSION['user']);

		$stmt->bind_param('s', $username);
		$stmt->execute();

		$stmt->bind_result($cnt, $id, $full_name, $password_hash, $role);
		$stmt->fetch();

		if($cnt == 1 && crypt($password, $password_hash) == $password_hash) {

			$_SESSION['user'] = array(
				"id" => $id,
				"username" => $username,
				"full_name" => $full_name,
				"role" => $role
			);

			$_SESSION['success'] = "Logged in successfully. Welcome ".$full_name."!";
			header("Location: home.php");
			exit;

		} else {
			$_SESSION['error'] = "Invalid user or password. Try again!";
			header("Location: login.php");
		}

	} else {
		$_SESSION['error'] = "An error ocurred while logging in. Try again!";
		header("Location: login.php");
	}

?>
