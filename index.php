<?php

	session_start();
	require 'system/config.php';

	$stmt = $mysqli->prepare("SELECT c.id, c.name, c.img_name FROM characters as c ORDER BY id ASC");
	
	if(!$stmt){
		$_SESSION['error'] = "Query Failed!";
		header("Location: error.php");
		exit;
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE." Home"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>		
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<style type="text/css">
			body {
				background-color: white;
			}
		</style>
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.waterwheel.min.js"></script>

		<!-- Search Box JS and CS -->
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/search_box.js"></script>
		
		<script type="text/javascript">
		$(document).ready(function () {
			
			$(".masthead").load("<?php echo ROOT_PATH."system/nav.php" ?>", function(){ search_box("<?php echo ROOT_PATH; ?>"); });
			$(".footer").load("<?php echo ROOT_PATH."system/footer.php" ?>");
		

		
			$(".carousel-images").append($(".carousel-images a").clone());
			$("#heroes-carousel").waterwheelCarousel({
				startingWaveSeparation: 0,
				centerOffset: 0,
				startingItemSeparation: 180,
				itemSeparationFactor: .65,
				itemDecreaseFactor: .65,
				opacityDecreaseFactor: 1,
				autoPlay: 3000,
				keyboardNav: true,
				animationEasing: 'swing',
				edgeReaction: 'reverse',
				speed: 400,
				flankingItems: 3
			});
		});
    </script>

	</head>
  <body>
    <div class="container">
      <div class="masthead">
      </div>  <!-- / masthead -->
			
			<div id="heroes-carousel">
				<div class="carousel-images">
					<?php
					
						$stmt->execute();
						$stmt->bind_result($char_id, $char_name, $char_img_name);
						
						while($stmt->fetch()){		
							echo "<a href=\"character.php?id=".$char_id."\" title=\"".$char_name."\">";
							echo "<img src=\"".$char_img_name."\" alt=\"".$char_name."\" />";
							echo "</a>";
						}
						$stmt->close();
						
					?>
				</div>
			</div>  <!-- / heroes-carousel -->
		</div>  <!-- / container -->
	
		<div class="bg_break">
			<div class="container">
				<?php require "system/alert.php"; ?>
				<div class="row-fluid">
					<div class="span9">
						<section>
							<h3>Featured Comics</h3>
							<div class="content center-image">
								<div class="row-fluid">
									<?php
										$stmt = $mysqli->prepare("SELECT c.id, c.issue, c.img_name ".
																									 "FROM comic_ratings AS cr RIGHT JOIN comics AS c ON cr.comic_id = c.id ".
																									 "GROUP BY c.id ORDER BY AVG(cr.rate) DESC LIMIT 6");
										
										if(!$stmt) {
											$_SESSION['error'] = "Query failed for Related Comics!";
											header("Location: ".ROOT_PATH."error.php");
											exit;
										}
										
										$stmt->execute();
										$stmt->bind_result($featcomic_id, $featcomic_issue, $featcomic_img_name);
										$stmt->store_result();
										
										if($stmt->num_rows != 0) {
											while($stmt->fetch()) {
												echo "<div class=\"span2\" style=\"position:relative\">";
													echo "<a href=\"".ROOT_PATH."comic.php?id=".$featcomic_id."\">";
														echo "<img src=\"".ROOT_PATH.$featcomic_img_name."\" alt=\"Comic\" >";
														echo "<span class=\"issue\">Issue #".$featcomic_issue."</span> ";
													echo "</a>";
												echo "</div>";
											}
										}
										$stmt->close();
									?>
								</div>
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
		</div> <!-- /container -->

  </body>
</html>
