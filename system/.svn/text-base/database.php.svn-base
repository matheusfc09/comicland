<?php

	$mysqli = new mysqli('localhost', 'comic_inst', 'comic_pass', 'comic_land');

	if($mysqli->connect_errno) {
		$_SESSION['error'] = "Connection with database failed!";
		header("Location: error.php");
		exit;
	}

?>
