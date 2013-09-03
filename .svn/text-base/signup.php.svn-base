<?php

	session_start();
	require 'system/config.php';

	$_SESSION["token"] = uniqid(md5(mt_rand()), true);

	if(logged_in()) {
		$_SESSION['normal'] = "You are already logged in.";
		header("Location: index.php");
		exit;
	}
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE." Sign Up"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">	
    <link href="css/jquery.jcrop.min.css" rel="stylesheet" type="text/css" />
		<style>
			#file_upload_handler img {
				max-height: 440px;
			}
		</style>
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<!-- Search Box JS and CS -->
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/search_box.js"></script>
		
		<script>
		
		$(document).ready(function(){
			
			$(".masthead").load("<?php echo ROOT_PATH."system/nav.php" ?>", function(){ search_box("<?php echo ROOT_PATH; ?>"); });
			$(".footer").load("<?php echo ROOT_PATH."system/footer.php" ?>");		
		
		});
		</script>

	</head>
  <body>
    <div class="container">
      <div class="masthead">
      </div>  <!-- / masthead -->

			<div class="row-fluid">
				<div class="span9">
					<section>
						<h3>Sign Up</h3>
						<div class="content">
							<?php require "system/alert.php"; ?>
							<form class="form-horizontal" action="create_user.php" method="POST">
								<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
								<div class="control-group">
									<label class="control-label">Username</label>
									<div class="controls">
										<input type="text" name="user[username]" placeholder="Enter your username" class="input-medium">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Full Name</label>
									<div class="controls">
										<input type="text" name="user[full_name]" placeholder="Enter your full name" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" name="user[password]" placeholder="Enter your password" class="input-medium">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Confirm Password</label>
									<div class="controls">
										<input type="password" name="user[password_confirmation]" placeholder="Re-enter your password" class="input-medium">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<input type="submit" class="btn" value="Sign in">
										<div style="margin-top: 20px">Already a user? <a href="<?php echo ROOT_PATH."login.php" ?>">Login</a></div>
									</div>
								</div>
							</form>
						</div>
					</section>
				</div>
				
				<div class="span3  side-col">
					<section style="height: 50px">
						<h3>News Feed</h3>
					</section>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="footer">
				</div>
			</div>

		</div> <!-- /container -->

  </body>
</html>
