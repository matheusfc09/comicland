<?php

	session_start();
	require 'config.php';

?>
<a href="<?php echo ROOT_PATH."index.php" ?>"><img class="logo" src="img/logo_final.png" /></a>
<div class="right-col">
	<div class="login_btns">
		<?php if(!logged_in()) { ?>
			<a class="btn btn-small" href="<?php echo ROOT_PATH."login.php" ?>">Login</a>
			<a class="btn btn-small" href="<?php echo ROOT_PATH."signup.php" ?>">Sign Up</a>
		<?php } else { ?>
			<a class="btn btn-small pull-right" href="<?php echo ROOT_PATH."logout.php" ?>">Logout</a>
			<span class="welcome_user">Welcome <?php echo current_user_fullname(); ?>! </span>
		<?php } ?>
	</div>
	<div class="navbar navbar-inner pull-right">
		<ul id="menu" class="nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="<?php
				if(logged_in()){ 
					echo ROOT_PATH."home.php";}
				else {
					echo ROOT_PATH."login.php";
				}
			?>" onclick="selected(this)">Profile</a></li>
			<li><a href="comics.php" ">Comics</a></li>
			<li><a href="characters.php" ">Characters</a></li>
			<?php
				if(logged_in() and admin()){
					echo "<li><a href='admin.php'>Admin</a></li>";
				}
			?>
			<li class="divider-vertical hidden-tablet"></li>
		</ul>
		<form id="search_form" class="navbar-search hidden-tablet">
			<input id="search_box" type="text" class="search-query" placeholder="Search">
		</form>
	</div>
</div>