<?php

	session_start();
	require 'system/config.php';
	$_SESSION["token"] = uniqid(md5(mt_rand()), true);
	
	if(isset($_GET['id'])) {
	
		$id = $_GET['id'];
	
		$stmt = $mysqli->prepare("SELECT c.series, c.title, c.issue, c.publisher, c.summary, c.img_name, AVG(cr.rate) ".
														 "FROM comics AS c JOIN comic_ratings AS cr ON c.id = cr.comic_id WHERE c.id = ?");
		if(!$stmt) {
			$_SESSION['error'] = "Query failed! (".$stmt->error.")";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
		
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($series, $title, $issue, $publisher, $summary, $img_name, $rate);
		if(!$stmt->fetch()) {
			$_SESSION['error'] = "Comic not found!";
			header("Location: ".ROOT_PATH."index.php");
			exit;	
		}
		$stmt->close();
		
		if($rate and $rate != 0)
				$rate = round($rate*5)-1 ;
		else
			$rate = -1;
			
		$stmt = $mysqli->prepare("SELECT rate FROM comic_ratings WHERE comic_id = ? AND user_id = ?");

		if(!$stmt) {
			$_SESSION['error'] = "Query failed for Reviews!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
		 
		if(logged_in()) {
			$user_id = current_user_id();
			$stmt->bind_param('ii', $id, $user_id);
			$stmt->execute();
			$stmt->bind_result($current_user_rate);
			$stmt->fetch();
			$stmt->close();
			
			if($current_user_rate == null)
				$current_user_rate = -1;
			else
				$current_user_rate = $current_user_rate - 1;
		}
		
	} else {
		$_SESSION['error'] = "Comic not found!";
		header("Location: ".ROOT_PATH."index.php");
		exit;	
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE." - ".$series; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>		
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<style>
			#characters_list li {
				margin-left: 10px;
				display: inline;
			}
			#comic_rate {
				display: inline-block;
			}
			@media (max-width: 979px) and (min-width: 768px) {
				#user_rate {
					padding-left: 20px !important;
				}			
			}
			#user_rate {
				display: inline-block;
				margin-bottom: 10px;
				padding-left: 45px;
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
		
			$.get("<?php echo ROOT_PATH."system/characters_list.php?comic_id=".$id ?>", function(data) {
				jQuery.each(data, function(index, item) {
					$("#characters_list").append(
						"<li>"+
						"<a class=\"btn btn-small btn-primary\" href=\"<?php echo ROOT_PATH; ?>character.php?id="+ item["id"] +"\">" + item["name"] +
						"</li>"
					);
				});
			});
			
			$("#comic_rate input").addClass("{split:5}");
			$("#comic_rate input").rating();
			$("#comic_rate input").rating('select', <?php echo $rate ?>);
			$("#comic_rate input").rating('readOnly', true);

			<?php
			if(logged_in()) {
			?>
				$("#user_rate input").rating({
					callback: function(value){
						if(value == undefined)
							value = -1;
						$.ajax({
							type: "POST",
							url: "rate_comic.php",
							data: {
								rate: value,
								user: <?php echo current_user_id() ?>,
								comic: <?php echo $id ?>
							}
						});
					}
				});
				$("#user_rate input").rating('select', <?php echo $current_user_rate ?>);
			<?php
				}
			?>
		});
		
		</script>

	</head>
  <body>
    <div class="container">
      <div class="masthead">
      </div>  <!-- / masthead -->
			
			<div class="row-fluid">
				<div class="span3">
					<section>
						<div class="content">
							<img src="<?php echo $img_name; ?>" alt="<?php echo $series.": ".$title; ?>" />
						</div>
					</section>
					<?php
						if(logged_in()) {			
					?>
						<div class="side-col near">
							<section>
								<div class="content">
									<div class="row-fluid">
										<p><b>Rate this comic:</b></p>
										<div id="user_rate">
											<input name="user_rating" type="radio" value="1"/>
											<input name="user_rating" type="radio" value="2"/>
											<input name="user_rating" type="radio" value="3"/>
											<input name="user_rating" type="radio" value="4"/>
											<input name="user_rating" type="radio" value="5"/>
										</div>
									</div>
									<?php
										if(manager() or admin()) {			
									?>
										<a class="btn btn-primary btn-block" href="<?php echo ROOT_PATH."edit_comic.php?id=".$id; ?>">Edit Character</a>
									<?php
										}
									?>
								</div>
							</section>
						</div>
					<?php
						}
					?>
				</div>	
			
				<div class="span9">
					<section>
						<h3><?php echo $series.": ".$title; ?></h3>
						<div class="content">
							<p><b>Series:</b> <?php echo $series; ?></p>
							<p><b>Title:</b> <?php echo $title; ?></p>
							<p><b>Issue:</b> #<?php echo $issue; ?></p>
							<p>
								<b>Users Rating:</b>
								<span id="comic_rate" style="margin-left: 6px; vertical-align: middle; margin-top: -5px;">
									<input name="comic_rating" type="radio" value="1"/>
									<input name="comic_rating" type="radio" value="2"/>
									<input name="comic_rating" type="radio" value="3"/>
									<input name="comic_rating" type="radio" value="4"/>
									<input name="comic_rating" type="radio" value="5"/>
									<input name="comic_rating" type="radio" value="6"/>
									<input name="comic_rating" type="radio" value="7"/>
									<input name="comic_rating" type="radio" value="8"/>
									<input name="comic_rating" type="radio" value="9"/>
									<input name="comic_rating" type="radio" value="10"/>
									<input name="comic_rating" type="radio" value="11"/>
									<input name="comic_rating" type="radio" value="12"/>
									<input name="comic_rating" type="radio" value="13"/>
									<input name="comic_rating" type="radio" value="14"/>
									<input name="comic_rating" type="radio" value="15"/>
									<input name="comic_rating" type="radio" value="16"/>
									<input name="comic_rating" type="radio" value="17"/>
									<input name="comic_rating" type="radio" value="18"/>
									<input name="comic_rating" type="radio" value="19"/>
									<input name="comic_rating" type="radio" value="20"/>
									<input name="comic_rating" type="radio" value="21"/>
									<input name="comic_rating" type="radio" value="22"/>
									<input name="comic_rating" type="radio" value="23"/>
									<input name="comic_rating" type="radio" value="24"/>
									<input name="comic_rating" type="radio" value="25"/>
								</span>
							</p>
							<p><b>Publisher:</b> <?php echo $publisher; ?></p>
							<p><b>Characters On This Comic:</b></p>
							<ul id="characters_list" class="unstyled"></ul>
							<p><b>Plot Summary:</b></p>
							<p><?php echo $summary; ?></p>
						</div>
					</section>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12 side-col">
					<section>
						<h3>Reviews</h3>
						<div class="content accordion" id="reviews">
							<?php
								$stmt = $mysqli->prepare("SELECT r.id, entry, r.creation, u.full_name ".
																				 "FROM reviews AS r JOIN users AS u ON r.user_id = u.id WHERE comic_id = ?");

								if(!$stmt) {
									$_SESSION['error'] = "Query failed for Reviews!";
									header("Location: ".ROOT_PATH."error.php");
									exit;
								}
								
								$stmt->bind_param('i', $id);
								$stmt->execute();
								$stmt->bind_result($review_id, $review_entry, $review_creation, $review_author);
								$stmt->store_result();
								
								if($stmt->num_rows != 0) {
									while($stmt->fetch()) {	
							?>
								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#discussion_board" href="#collapse<?php echo $review_id; ?>">
											<span class="author">by <?php echo $review_author; ?></span>
											<span class="date"><?php echo date("F d \a\\t h:ia", strtotime($review_creation)); ?></span>
										</a>
									</div>
									<div id="collapse<?php echo $review_id; ?>" class="accordion-body collapse">
										<div class="accordion-inner">
											<span><?php echo $review_entry; ?></span>
										</div>
									</div>
								</div>
							<?php
									}
								} else {
									echo "<div class=\"none\">";
										echo "No reviews for this comic yet. Be the first one!";
									echo "</div>";
								}
								$stmt->close();
							?>
							<div class="new_review" style="margin-top:10px;">
								<form method="POST" action="create_review.php" style="margin:0" >
									<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
									<input type="hidden" name="comic_id" value="<?php echo $id; ?>">
									<textarea rows="5" placeholder="Enter a new review" name="entry" class="input-full"></textarea>
									<input class="btn" type="Submit" value="Create Review">
								</form>
							</div>
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
