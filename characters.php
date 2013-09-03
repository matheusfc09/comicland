<?php

	session_start();
	require 'system/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE." - Home"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>		
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<style>
			#characters .row-fluid+.row-fluid {
				margin-top: 10px;
			}
		</style>
		
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<!-- Rating stars -->
		<script src="js/jquery.rating.pack.js"></script>
		<script src="js/jquery.metadata.js"></script>
		<link href="css/jquery.rating.css" rel="stylesheet">	
		
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
						<h3>Characters</h3>
						<div  id="favorite_characters" class="content center-image">
						<?php 
														
							$stmt = $mysqli->prepare("SELECT id, name, img_name FROM characters ORDER BY name DESC");

							if(!$stmt){
								$_SESSION['error'] = "Query Failed!";
								header("Location: error.php");
								exit;
							}	


							$stmt->execute();
							$stmt->bind_result($c_id, $name, $img_name);	
							$n = 0;
							echo "<div class='row-fluid'>";
							while($stmt->fetch()) {
						
								echo "<div class='span2' style='position:relative'> <a href='character.php?id=".$c_id."' title='".$name."'>";
								echo "<img src='".$img_name."' alt='".$name."' />";
								echo "<span class=\"issue\">".$name."</span> ";
								echo "</a> </div>";
								$n++;
								if(($n % 6) == 0){
									echo "</div><div class='row-fluid'>";
								} 
								
							}
							echo "</div>";
							$stmt->close();
							
						?>

						</div>
					</section>
				</div>
				<?php
						if(manager() or admin()) {			
					?>
						<div class="span3 side-col">
							<section>
								<div class="content">
										<a class="btn btn-primary btn-block" href="<?php echo ROOT_PATH."new_character.php"; ?>">New Character</a>
								</div>
							</section>
						</div>
					<?php
						}
					?>
				
				<div class="span3 side-col">
					<section>
						<h3>News Feed</h3>
						<div id="feeds" class="content">
							<?php require "system/news_feed.php"; ?>
						</div>	

						
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
