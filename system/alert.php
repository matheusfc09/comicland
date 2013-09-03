<?php

	if(isset($_SESSION['error'])) {
		echo "<div class=\"alert alert-error\">  
				<a class=\"close\" data-dismiss=\"alert\">&times;</a>
				<strong>Error!</strong> ".$_SESSION['error']."
			</div>";
		unset($_SESSION['error']);
	}

	if(isset($_SESSION['success'])) {
		echo "<div class=\"alert alert-success\">
				<a class=\"close\" data-dismiss=\"alert\">&times;</a>
				<strong>Success!</strong> ".$_SESSION['success']."
			</div>";
		unset($_SESSION['success']);
	}

	if(isset($_SESSION['normal'])) {
		echo "<div id=\"alert alert-info\">
				<a class=\"close\" data-dismiss=\"alert\">&times;</a>
				<strong>Info!</strong> ".$_SESSION['normal']."
			</div>";
		unset($_SESSION['normal']);
	}



?>
