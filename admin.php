<?php

	session_start();
	require 'system/config.php';
	$_SESSION["token"] = uniqid(md5(mt_rand()), true);

	if(!admin()){
		$_SESSION['error'] = "Only Administrators!";
 		header("Location: ".ROOT_PATH."index.php");
		exit;
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE." Administration"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">
		<style>
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
			
			$(".masthead").load("<?php echo ROOT_PATH."system/nav.php" ?>", function(){ search_box("<?php echo ROOT_PATH; ?>")});
			$(".footer").load("<?php echo ROOT_PATH."system/footer.php" ?>");
			
		});
		</script>

	</head>
  <body>
    <div class="container">
      <div class="masthead">
      </div>  <!-- / masthead -->

			<div class="row-fluid">
				<section>
					<h3>Administration</h3>
					<div class="content" style="padding: 30px">
						<?php require "system/alert.php"; ?>
						<table class="table table-striped" style="margin-bottom: 0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Login</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
									$stmt = $mysqli->prepare("SELECT id, login, full_name, role FROM users order by full_name");
									if(!$stmt) {
										$_SESSION['error'] = "Query Failed!";
										header("Location: error.php");
										exit;
									}

									$stmt->execute();
									$stmt->bind_result($id, $login, $full_name, $role);
									while($stmt->fetch()){
										if($role != "admin") {
								?>
									<tr>
										<td><?php echo $id; ?></td>
										<td><?php echo $full_name; ?></td>
										<td><?php echo $login; ?></td>
										<td>
											<form class="form" action="change_roles.php" method="post" style="margin: 0">
												<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
												<input type="hidden" name="user_id" value="<?php echo $id; ?>">
												<?php
													if($role == "user") {
												?>
													<input type="hidden" name="role" value="manager" />
													<input type="submit" class="btn btn-primary btn-small" value="Set As Manager" />
												<?php
													} else if($role == "manager") {
												?>
													<input type="hidden" name="role" value="user" />
													<input type="submit" class="btn btn-primary btn-small" value="Set As User" />
												<?php
													}
												?>
											</form>
										</td>
									</tr>
								<?php
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</section>
			</div>
			
			<div class="row-fluid">
				<div class="footer">
				</div>
			</div>

		</div> <!-- /container -->

  </body>
</html>
