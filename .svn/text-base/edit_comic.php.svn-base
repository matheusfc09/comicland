<?php

	session_start();
	require 'system/config.php';
	$_SESSION["token"] = uniqid(md5(mt_rand()), true);
	
	if(isset($_GET['id'])) {
	
		$id = $_GET['id'];
	
		$stmt = $mysqli->prepare("SELECT series, title, issue, publisher, summary, img_name FROM comics WHERE id = ?");
		if(!$stmt) {
			$_SESSION['error'] = "Query failed!";
			header("Location: ".ROOT_PATH."error.php");
			exit;
		}
		
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($series, $title, $issue, $publisher, $summary, $img_name);

		if(!$stmt->fetch()) {
			$_SESSION['error'] = "Comic not found!";
			header("Location: ".ROOT_PATH."index.php");
			exit;	
		}
		$stmt->close();
		
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
    <title><?php echo SITE_TITLE." Edit Comic"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<style>
			#file_upload_handler img, #comic_image img {
				max-height: 440px;
			}
			#comic_image {
				overflow:hidden;
				float: left;
				position: relative;
			}
			#comic_image a {
				position:absolute;
				display:none;
				top: 50%;
				margin-top: -13px;
				left: 50%;
				margin-left: -69px;
			}
			#comic_image .overlay {
				border-radius: 5px;
				position: absolute;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0);
				-webkit-transition: background-color 0.2s linear;
				-moz-transition: background-color 0.2s linear;
				-o-transition: background-color 0.2s linear;
			}
			#comic_image:hover .overlay {
				background-color: rgba(0, 0, 0, 0.3);
				z-index: 10;
			}
			#comic_image:hover a {
				display:block;
				z-index: 20;
			}
		</style>
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/ajaxupload.js"></script>
		
		<!-- Search Box JS and CS -->
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/search_box.js"></script>
		
		<script>
		
		$(document).ready(function(){
		
			$(".masthead").load("<?php echo ROOT_PATH."system/nav.php" ?>", function(){ search_box("<?php echo ROOT_PATH; ?>"); });
			$(".footer").load("<?php echo ROOT_PATH."system/footer.php" ?>");
			
			$.get("<?php echo ROOT_PATH."system/characters_list.php?comic_id=".$id ?>", function(data) {
				$("#character_tokens").tokenInput("<?php echo ROOT_PATH."system/characters_list.php" ?>", {
					theme: 'facebook',
					preventDuplicates: true,
					prePopulate: data
				});
			});
			
		$("#search_box").tokenInput("<?php echo ROOT_PATH."system/search.php" ?>", {
			theme: 'facebook',
			tokenLimit: 1,
			resultsFormatter: function(item) {
				if(item.type == "name")
					return "<li>" + item.name + "<br><i>Character</i></li>"
				else if(item.type == "series")
					return "<li>" + item.name + "<br><i>Series of Comics</i></li>"
				else if(item.type == "title")
					return "<li>" + item.name + "<br><i>Title of Comics</i></li>"
			},
			onAdd: function(item) {
				if(item.type == "name")
					window.location.href = "<?php echo ROOT_PATH; ?>character.php?id=" + item.id;
				else
					window.location.href = "<?php echo ROOT_PATH; ?>comic.php?id=" + item.id;
			}
		});
		});
		
		$("#new_image").live('click', function(e){

			e.stopPropagation();
			$("#comic_image").slideUp(function() {$(this).remove()});
			$("#file_upload_handler").show();
			
			new AjaxUpload('file_upload', {
				action: 'system/upload_image.php',
				name: 'file_uploaded',
				responseType: 'json',
				onComplete : function(file, response){
					//console.log(response);
					if(response['success']) {
						$('#file_upload_handler').html(
							"<img src=\"" + response['filename'] + "\" alt=\"temp img\" >" +
							"<input type=\"hidden\" id=\"image_path\" name=\"image_path\" value=\"" + response['filename'] + "\" >"
						);
					}
				}	
			});
		});
		
		</script>

	</head>
  <body>
    <div class="container">
      <div class="masthead">
      </div>  <!-- / masthead -->

			<div class="row-fluid">
				<section>
					<h3>Edit Character</h3>
					<div class="content">
						<form class="form-horizontal" action="handle_comic.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<div class="control-group">
								<label class="control-label">Series</label>
								<div class="controls">
									<input type="text" id="series" name="series" value="<?php echo $series; ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Title</label>
								<div class="controls">
									<input type="text" id="title" name="title" value="<?php echo $title; ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Issue #</label>
								<div class="controls">
									<input type="text" id="issue" name="issue" value="<?php echo $issue; ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Comic Book Cover</label>
								<div class="controls">
									<div id="comic_image">
										<a id="new_image" class="btn btn-warning btn-small">Upload a new picture</a>
										<div class="overlay"></div>
										<img src="<?php echo $img_name; ?>.">
									</div>
									<div id="file_upload_handler" style="display:none">
										<input type="file" id="file_upload" placeholder="Choose an image..." accept="image/png, image/jpeg" /> 
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Characters on it</label>
								<div class="controls token" >
									<input type="text" id="character_tokens" name="character_ids"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Publisher</label>
								<div class="controls">
									<input type="text" id="publisher" name="publisher" value="<?php echo $publisher; ?>"/>
								</div>
							</div>								
							<div class="control-group">
								<label class="control-label">Summary</label>
								<div class="controls">
									<textarea id="summary" class="input-full" name="summary" rows="12"/><?php echo strip_tags($summary, '<b><i>'); ?></textarea>
								</div>
							</div>
							<div class="controls">
								<input type="submit" class="btn btn-primary" value="Update Comic" />
							</div>
						</form>
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
