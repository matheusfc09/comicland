<?php

	require "config.php";
	require "authentication.php";

	echo "<ul>";
		echo "<li><a href=\"".ROOT_PATH."index.php\">Homepage</a></li>";
		if(admin() or registered())
			echo "<li><a href=\"".ROOT_PATH."posts/new.php\">New Post</a></li>";
		if(logged_in())
			echo "<li><a href=\"".ROOT_PATH."logout.php\">Logout</a></li>";
		if(!logged_in())
			echo "<li><a href=\"".ROOT_PATH."signup.php\">Sign Up</a></li>";		
		if(!logged_in())
			echo "<li><a href=\"".ROOT_PATH."login.php\">Login</a></li>";
	echo "</ul>";

?>
