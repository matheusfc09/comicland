<?php

	session_start();
	require 'system/config.php';

?>
<!DOCTYPE html>
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
			#favorite_characters .row-fluid+.row-fluid, #rated_comics .row-fluid+.row-fluid {
				margin-top: 10px;
			}
			
			#favorite_characters .none, #rated_comics .none {
				color: #999;
				border: 1px solid #AAA;
				border-radius: 3px;
				padding: 8px;
				background-color: #F4F4F4;
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
			
			<?php require "system/alert.php"; ?>
			
			<div class="row-fluid">
				<div class="span9">
					<section>
						<h3>My Rated Comics</h3>
						<div  id="rated_comics" class="content center-image">
							<?php 
														
								$stmt = $mysqli->prepare("SELECT c.id, title, series, issue, img_name, rate FROM comics as c JOIN comic_ratings as r ON ".
								" r.comic_id = c.id  WHERE r.user_id = ".current_user_id()." ORDER BY c.id, r.rate DESC");
				
								if(!$stmt){
									$_SESSION['error'] = "Query Failed!";
									header("Location: error.php");
									exit;
								}

								$stmt->execute();
								$stmt->bind_result($cb_id, $title, $series, $issue, $img_name, $rate);
								$stmt->store_result();
								
								if($stmt->num_rows != 0) {
									$n = 0;
									echo "<div class='row-fluid'>";
									while($stmt->fetch()) {		
										echo "<div class='span2' style='position:relative'> <a href='comic.php?id=".$cb_id."' title='".$series.": ". $title . " - Rate: " . $rate . " / 5'>";
										echo "<img src='".$img_name."' alt='".$series.": ". $title . " - Rate: " . $rate . "out of 5' />";
										echo "<span class=\"issue\">Issue #".$issue."</span> ";
										echo "</a> </div>";
										$n++;
										if(($n % 6) == 0){
											echo "</div>";
											echo "<div class='row-fluid'>";
										}
									}
									echo "</div>";
								} else {
									echo "<div class=\"none\">";
										echo "You haven't rated any comic yet!";
									echo "</div>";									
								}

								$stmt->close();
								
							?>
						</div>
					</section>
		
					<section>
						<h3>My Favorite Characters</h3>
						<div  id="favorite_characters" class="content center-image">
							<?php 
															
								$stmt = $mysqli->prepare("SELECT id, name, img_name FROM characters as c JOIN favorite_characters as f ON ".
										" f.character_id = c.id WHERE f.user_id = ".current_user_id()." ORDER BY c.id DESC");

								if(!$stmt){
									$_SESSION['error'] = "Query Failed!";
									header("Location: error.php");
									exit;
								}	

								$stmt->execute();
								$stmt->bind_result($c_id, $name, $img_name);	
								$stmt->store_result();
								
								if($stmt->num_rows != 0) {
									$n = 0;
									echo "<div class='row-fluid'>";
									while($stmt->fetch()) {
										echo "<div class='span2' style='position:relative'> <a href='character.php?id=".$c_id."' title='".$name."'>";
										echo "<img src='".$img_name."' alt='".$name."' />";
										echo "<span class=\"issue\">".$name."</span> ";
										echo "</a> </div>";
										$n++;
										if(($n % 6) == 0){
											echo "</div>";
											echo "<div class='row-fluid'>";
										} 	
									}
									echo "</div>";
								} else {
									echo "<div class=\"none\">";
										echo "You don't have any favorite character yet!";
									echo "</div>";									
								}
								
								$stmt->close();
								
							?>
						</div>
					</section>
				</div>
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
