<?php
	
	session_start();
	require "config.php";
	
	header("Content-Type: application/json");
	
	$list = array();
	
	if(isset($_GET['q'])) {
		$query = "%".mysql_real_escape_string($_GET['q'])."%";
	}

	$stmt = $mysqli->prepare(
		"(SELECT id, name, 'name' FROM characters WHERE name LIKE ?) ".
		"UNION ".
		"(SELECT id, CONCAT(series, ': ', title), 'series' FROM comics WHERE series LIKE ?) ".
		"UNION ".
		"(SELECT id, CONCAT(series, ': ', title), 'title' FROM comics WHERE title LIKE ?)"		
	);
	
	if(!$stmt) {
		$_SESSION['error'] = "Query failed!";
		header("Location: ".ROOT_PATH."error.php");
		exit;
	}
	
	$stmt->bind_param('sss', $query, $query, $query);
	$stmt->execute();
	$stmt->bind_result($id, $name, $type);
	
	while($stmt->fetch()) {
		array_push($list, array("id" => "$id", "name" => $name, "type" => $type));
	}
	
	$stmt->close();
	
	echo json_encode($list);
	exit;
	
?>