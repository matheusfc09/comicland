<?php

	session_start();
	require 'system/config.php';
	$_SESSION["token"] = uniqid(md5(mt_rand()), true);
	
	if(isset($_GET['id'])) {
	
		$id = $_GET['id'];
	
		$stmt = $mysqli->prepare("SELECT name, gender, description, powers, img_name FROM characters WHERE id = ?");
		if(!$stmt) {
			$_SESSION['error'] = "Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
		
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($name, $gender, $description, $powers, $img_name);
		if(!$stmt->fetch()) {
			$_SESSION['error'] = "Character not found!";
			header("Location: ".ROOT_PATH."index.php");
			exit;	
		}
		$stmt->close();
		
		if(logged_in()) {
			$stmt = $mysqli->prepare("SELECT COUNT(*) FROM favorite_characters WHERE user_id = ? AND character_id = ?");
			if(!$stmt) {
				$_SESSION['error'] = "Query failed!";
				header("Location: ".ROOT_PATH."error.php");
				exit;
			}
			
			$user_id = current_user_id();
			$stmt->bind_param('ii', $user_id, $id);
			$stmt->execute();
			$stmt->bind_result($favorite);
			$stmt->fetch();
			$stmt->close();
		}
		
	} else {
		$_SESSION['error'] = "Character not found!";
		header("Location: ".ROOT_PATH."index.php");
		exit;	
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE.": ".$name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>		
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<style>
			.content .row-fluid {
				margin-top: 5px;
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
		
		$(document).ready(function() {
		
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
				<div class="span3">
					<section>
						<div class="content">
							<img src="<?php echo $img_name; ?>" alt="<?php echo $name; ?>"/>
						</div>
					</section>

					<?php
						if(logged_in()) {			
					?>
						<div class="side-col near">
							<section>
								<div class="content">
									<?php
										if($favorite == 1) {
									?>
										<a class="btn btn-warning btn-block" href="<?php echo ROOT_PATH."favoriting.php?action=remove&amp;id=$id"; ?>">Remove as Favorite</a>
									<?php
										} else if($favorite == 0) {
									?>
										<a class="btn btn-warning btn-block" href="<?php echo ROOT_PATH."favoriting.php?action=add&amp;id=$id"; ?>">Add as Favorite</a>
									<?php
										}
										
										if(manager() or admin()) {
									?>
										<a class="btn btn-primary btn-block" href="<?php echo ROOT_PATH."edit_character.php?id=".$id; ?>">Edit Character</a>
									<?php
										}
									?>
								</div>
							</section>
						</div>
					<?php
						}
					?>
					<?php
						$stmt = $mysqli->prepare("SELECT c.id, c.issue, c.img_name ".
																					 "FROM comic_ratings AS cr RIGHT JOIN comics AS c ON cr.comic_id = c.id ".
																																		"JOIN comics_characters AS cc ON c.id = cc.comic_id ".
																																		"JOIN characters AS ch ON cc.character_id = ch.id ".
																					 "WHERE ch.id = ? GROUP BY c.id ORDER BY AVG(cr.rate) DESC LIMIT 4");
						
						if(!$stmt) {
							$_SESSION['error'] = "Query failed for Related Comics!";
							header("Location: ".ROOT_PATH."error.php");
							exit;
						}
						
						$stmt->bind_param('i', $id);
						$stmt->execute();
						$stmt->bind_result($relcomic_id, $relcomic_issue, $relcomic_img_name);
						$stmt->store_result();
						
						if($stmt->num_rows != 0) {
					?>
						<div class="side-col">
							<section>
								<h3>Related Comics</h3>
								<div class="content">
									<div class='row-fluid'>
										<?php
												$n = 0;
												while($stmt->fetch()) {
													echo "<div class=\"span6\" style=\"position:relative\">";
														echo "<a href=\"".ROOT_PATH."comic.php?id=".$relcomic_id."\">";
															echo "<img src=\"".ROOT_PATH.$relcomic_img_name."\" alt=\"Comic\" />";
															echo "<span class=\"issue\">Issue #".$relcomic_issue."</span> ";
														echo "</a>";
													echo "</div>";
													$n++;
													if(($n % 2) == 0){
														echo "</div>";
														echo "<div class='row-fluid'>";
													}
												}
										?>
									</div>
								</div>
							</section>
						</div>
					<?php
						}
							
						$stmt->close();
					?>
				</div>
			
				<div class="span9">
					<section>
						<h3><?php echo $name; ?></h3>
						<div class="content">
							<h5>Description:</h5>
							<p><?php echo $description; ?></p>
							<h5>Powers:</h5>
							<p><?php echo $powers; ?></p>
						</div>
					</section>
				</div>
			</div>

			<?php 

				$stmt = $mysqli->prepare("SELECT id, title, entry FROM board_topics WHERE character_id = ?");
				if(!$stmt) {
					$_SESSION['error'] = "Query failed for Topics!";
					header("Location: ".ROOT_PATH."error.php");
					exit;
				}
				
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$stmt->bind_result($bt_id, $bt_title, $bt_entry);
				$stmt->store_result();
				
				if($stmt->num_rows != 0) {
			?>
				<div class="row-fluid">
					<div class="span12 side-col">
						<section>
							<h3>Discussion Board</h3>
							<div class="content accordion" id="discussion_board">
								<?php	
									while($stmt->fetch()) {	
								?>
									<div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#discussion_board" href="#collapse<?php echo $bt_id; ?>">
												<?php echo $bt_title; ?>
											</a>
										</div>
										<div id="collapse<?php echo $bt_id; ?>" class="accordion-body collapse">
											<div class="accordion-inner">
												<span><?php echo $bt_entry; ?></span>
												<div class="comments">
													<b>Comments:</b>
													<?php
														$inner_stmt = $mysqli->prepare("SELECT bc.comment, bc.creation, u.full_name ".
																													 "FROM board_comments AS bc INNER JOIN users AS u ON u.id = bc.user_id ".
																													 "WHERE bc.topic_id = ? ORDER BY bc.creation ASC");
														
														if(!$inner_stmt) {
															$_SESSION['error'] = "Query failed for Topics!";
															header("Location: ".ROOT_PATH."error.php");
															exit;
														}
														
														$inner_stmt->bind_param('i', $bt_id);
														$inner_stmt->execute();
														$inner_stmt->bind_result($bc_comment, $bc_creation, $bc_full_name);
														$inner_stmt->store_result();
														
														if($inner_stmt->num_rows != 0) {
															while($inner_stmt->fetch()) {
																echo "<div class=\"comment\">";
																	echo "<div class=\"meta\">";
																		echo "<span class=\"date\">".date("F d \a\\t h:ia", strtotime($bc_creation))."</span> ";
																		echo "<span class=\"author\">".$bc_full_name."</span> ";
																	echo "</div>";
																	echo "<div class=\"text\">".$bc_comment."</div>";
																echo "</div>";
															}
														} else {
																echo "<div class=\"comment\" style=\"color: #999\">No comments yet. Be the first one!</div>";
														}
															
														$inner_stmt->close();
													?>
													<div class="new_comment" style="margin-top:10px;">
														<form method="POST" action="create_comment.php" style="margin:0" >
															<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
															<input type="hidden" name="bc_id" value="<?php echo $bt_id; ?>">
															<input type="hidden" name="character_id" value="<?php echo $id; ?>">
															<textarea rows="3" placeholder="Enter a new comment" name="comment" class="input-full"></textarea>
															<input class="btn" type="Submit" value="Create Comment">
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
									}
								?>
							</div>
						</section>
					</div>
				</div>
			<?php
				}
				$stmt->close();
			?>
			
			<div class="row-fluid">
				<div class="footer">
				</div>
			</div>
			
	</div> <!-- /container -->

  </body>
</html>
