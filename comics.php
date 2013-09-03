<?php

	session_start();
	require 'system/config.php';
	
	$queries_filter = array();
	if(isset($_GET['series'])) {
		$form_series = $_GET['series'];
		$search_series = "%".$_GET['series']."%";
		array_push($queries_filter, "series LIKE ?");
	}
	if(isset($_GET['publisher'])) {
		$form_publisher = $_GET['publisher'];
		$search_publisher = "%".$_GET['publisher']."%";
		array_push($queries_filter, "publisher LIKE ?");
	}
	if(isset($_GET['issue'])) {
		$form_issue = $_GET['issue'];
		$search_issue = "%".$_GET['issue']."%";
		array_push($queries_filter, "issue LIKE ?");
	}
	
	if(!empty($queries_filter))
		$queries_filter_sql = "WHERE ".implode(" AND ", $queries_filter);
	else
		$queries_filter_sql = "";

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
			#comics .row-fluid+.row-fluid {
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
						<h3>Comics</h3>
						<div  id="comics" class="content center-image" >
							<?php 

								$stmt = $mysqli->prepare("SELECT id, title, series, issue, img_name, publisher FROM comics $queries_filter_sql ORDER BY series, title ASC");
				
								if(!$stmt){
									$_SESSION['error'] = "Query Failed!";
									header("Location: error.php");
									exit;
								}
								
								if(isset($search_series) and isset($search_publisher) and isset($search_issue))
									$stmt->bind_param('sss', $search_series, $search_publisher, $search_issue);
								else if(isset($search_series) and isset($search_publisher))
									$stmt->bind_param('ss', $search_series, $search_publisher);
								else if(isset($search_series) and isset($search_issue))
									$stmt->bind_param('ss', $search_series, $search_issue);
								else if(isset($search_issue) and isset($search_publisher))
									$stmt->bind_param('ss', $search_issue, $search_publisher);
								else if(isset($search_series))
									$stmt->bind_param('s', $search_series);
								else if(isset($search_publisher))
									$stmt->bind_param('s', $search_publisher);
								else if(isset($search_issue))
									$stmt->bind_param('s', $search_issue);
									
								$stmt->execute();
								$stmt->bind_result($cb_id, $title, $series, $issue, $img_name, $publisher);	
								$n = 0;
								echo "<div class='row-fluid'>";
								while($stmt->fetch()) {
																	
									echo "<div class='span2' style='position:relative'>";
										echo "<a href='comic.php?id=".$cb_id."' title='".$series.": ". $title . " - " . $publisher . "'>";
											echo "<img src='".$img_name."' alt='".$series.": ". $title . " - " . $publisher . "' />";
											echo "<span class=\"issue\">Issue #".$issue."</span> ";
										echo "</a>";
									echo "</div>";
									$n++;
									if(($n % 6) == 0){
										echo "</div>";
										echo "<div class='row-fluid'>";
									}
									
								}
								echo "</div>";
								$stmt->close();
								
							?>
						</div>
					</section>
		
				</div>
				
				<div class="span3 side-col">
					<section>
						<div class="content">
							<?php
								if(manager() or admin()) {			
							?>
								<a class="btn btn-primary btn-block" style="margin-bottom: 10px" href="<?php echo ROOT_PATH."new_comic.php"; ?>">New Comic</a>
							<?php
								}
							?>
							<p><b>Advanced Filtering:</b></p>
							<form class="form" action="comics.php" method="get" style="margin: 0">
								<input type="text" placeholder="Enter series" class="input-full" name="series" value="<?php echo (isset($form_series)) ? $form_series : ""; ?>" />
								<input type="text" placeholder="Enter publisher" class="input-full" name="publisher" value="<?php echo (isset($form_publisher)) ? $form_publisher : ""; ?>" />
								<input type="text" placeholder="Enter issue" class="input-full" name="issue" value="<?php echo (isset($form_issue)) ? $form_issue : ""; ?>" />
								<input type="submit" class="btn btn-primary btn-small" value="Filter" />
							</form>
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
