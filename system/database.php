<?php

	$mysqli = new mysqli('remotemysql.com', 'QOSYrmTm62', 'KnraZQDXZm', 'QOSYrmTm62', 3306);

	if($mysqli->connect_errno) {
		$_SESSION['error'] = "Connection with database failed!";
		header("Location: error.php");
		exit;
	}
        $mysqli->query("SET SESSION sql_mode=''");

?>
