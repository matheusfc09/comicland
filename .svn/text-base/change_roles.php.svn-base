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
	
	if(!admin()) {
		$_SESSION['error'] = "You need to be an admin to access this area.";
		header("Location: ".ROOT_PATH."login.php");
		exit;
	}
	
	if(isset($_POST['user_id']) and !empty($_POST['user_id'])){
		$user_id = $_POST['user_id'];
		$role = $_POST['role'];
					
		$stmt = $mysqli->prepare("UPDATE users SET role = ? WHERE id = ?");
		if(!$stmt) {
			$_SESSION['error'] = "Insertion Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
					
		$stmt->bind_param('si', $role, $user_id);
		if($stmt->execute()) {
			$_SESSION['success'] = "User role changed successfully!";
			$_SESSION['error'] = null;
		} else {
			$_SESSION['success'] = null;
			$_SESSION['error'] = "An error ocurred: ".$stmt->error;
		}
		$stmt->close();

		header("Location: ".ROOT_PATH."admin.php");
		exit;

	}
	
	$_SESSION['error'] = "An error ocurred while processing the user. Try again!";
	header("Location: ".ROOT_PATH."error.php");
	exit;
	
?>
