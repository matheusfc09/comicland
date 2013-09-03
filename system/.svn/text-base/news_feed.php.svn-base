<?php
	$stmt = $mysqli->prepare("SELECT u.login, nf.id, nf.action, nf.type, nf.content, nf.date, nf.link ".
													 "FROM news_feed AS nf JOIN users AS u ON u.id = nf.user_id ".
													 "ORDER BY nf.date DESC LIMIT 4");

	if(!$stmt){
		$_SESSION['error'] = "Query Failed!";
		header("Location: error.php");
		exit;
	}

	$stmt->execute();
	$stmt->bind_result($user, $id, $action, $type, $content, $date, $link);				

	while($stmt->fetch()) {		
		echo "<div class=\"feed\">";
			echo "<div class=\"entry\"><b>@$user</b> $action $type, <a href=\"".ROOT_PATH."$link\">$content</a></div>";
			echo "<div class=\"date\">".date("F d \a\\t h:ia", strtotime($date))."</div>";
		echo "</div>";
	}
	$stmt->close();	
?>