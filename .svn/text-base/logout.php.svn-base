<?php

	session_start();
	require 'system/config.php';
	require 'system/authentication.php';

	if(logged_in()) {
		logout();
		$_SESSION['success'] = "You have logged out successfully";
		header("Location: index.php");
		exit;
	} else {
		$_SESSION['error'] = "You are currently not logged in!";
		header("Location: index.php");
		exit;
	}

?>
