<?php

	session_start();
	require 'system/config.php';
	$_SESSION["token"] = uniqid(md5(mt_rand()), true);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE." New Comic"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comic Books Enciclopedia">
    <meta name="author" content="Amanda e Matheus">
		
    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
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
    <script type="text/javascript" src="js/ajaxupload.js"></script>
		
		<!-- Search Box JS and CS -->
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/search_box.js"></script>
		
		<script>
		
		$(document).ready(function(){
		
			$(".masthead").load("<?php echo ROOT_PATH."system/nav.php" ?>", function(){ search_box("<?php echo ROOT_PATH; ?>")});
			$(".footer").load("<?php echo ROOT_PATH."system/footer.php" ?>");
		
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
			
			$("#character_tokens").tokenInput("<?php echo ROOT_PATH."system/characters_list.php" ?>", {
				theme: 'facebook',
				preventDuplicates: true,
			});
		});

		</script>

	</head>
  <body>
    <div class="container">
      <div class="masthead">
      </div>

			<div class="row-fluid">
				<section>
					<h3>New Comic</h3>
					<div class="content">
						<form class="form-horizontal" action="handle_comic.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
							<div class="control-group">
								<label class="control-label">Series</label>
								<div class="controls">
									<input type="text" id="series" name="series"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Title</label>
								<div class="controls">
									<input type="text" id="title" name="title"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Issue #</label>
								<div class="controls">
									<input type="text" id="issue" name="issue"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Comic Book Cover</label>
								<div class="controls">
									<div id="file_upload_handler">
										<input type="file" id="file_upload" placeholder="Choose an image..." accept="image/png, image/jpeg" /> 
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Characters on it</label>
								<div class="controls token">
									<input type="text" id="character_tokens" name="character_ids"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Publisher</label>
								<div class="controls">
									<input type="text" id="publisher" name="publisher"/>
								</div>
							</div>								
							<div class="control-group">
								<label class="control-label">Summary</label>
								<div class="controls">
									<textarea id="summary" class="input-full" name="summary" rows="12"/></textarea>
								</div>
							</div>
							<div class="controls">
								<input type="submit" class="btn btn-primary" value="Create Comic" />
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
