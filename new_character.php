<?php

	session_start();
	require 'system/config.php';
	$_SESSION["token"] = uniqid(md5(mt_rand()), true);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE." New Character"; ?></title>
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
    <script type="text/javascript" src="js/ajaxupload.js"></script>
    <script src="js/jquery.jcrop.min.js" type="text/javascript"></script>
		
		<!-- Search Box JS and CS -->
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/search_box.js"></script>
		
		<script>
		
		$(document).ready(function(){
			
			$(".masthead").load("<?php echo ROOT_PATH."system/nav.php" ?>", function(){ search_box("<?php echo ROOT_PATH; ?>")});
			$(".footer").load("<?php echo ROOT_PATH."system/footer.php" ?>");
			
			new AjaxUpload('file_upload', {
				action: 'system/upload_image.php',
				name: 'file_uploaded',
				responseType: 'json',
				onComplete : function(file, response){
					//console.log(response);
					if(response['success']) {
						$('#file_upload_handler').html(
							"<img src=\"" + response['filename'] + "\" alt=\"temp img\" >" +
							"<input type=\"hidden\" id=\"image_path\" name=\"image_path\" value=\"" + response['filename'] + "\" >" +
							"<input type=\"hidden\" id=\"x_crop\" name=\"x_crop\" >" +
							"<input type=\"hidden\" id=\"y_crop\" name=\"y_crop\" >" +
							"<input type=\"hidden\" id=\"width_crop\" name=\"width_crop\" >" +
							"<input type=\"hidden\" id=\"height_crop\" name=\"height_crop\" >" +
							"<input type=\"hidden\" id=\"width\" name=\"width\" >" +
							"<input type=\"hidden\" id=\"height\" name=\"height\" >"
							);
						$('#file_upload_handler img').Jcrop({
							onChange: function(c) {
								$("#x_crop").val(c.x);  
								$("#y_crop").val(c.y);  
								$("#width_crop").val(c.w);  
								$("#height_crop").val(c.h);
								$("#width").val($('#file_upload_handler img').width());  
								$("#height").val($('#file_upload_handler img').height()); 
							},
							allowSelect: false,
							setSelect: [0, 0, 312, 442],
							minSize: [50, 50],
							bgColor: 'clear'
						});
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
					<h3>New Character</h3>
					<div class="content">
						<form class="form-horizontal" action="handle_character.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
							<div class="control-group">
								<label class="control-label">Name</label>
								<div class="controls">
									<input type="text" id="name" name="name"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gender</label>
								<div class="controls">
									<label class="radio"><input type="radio" name="gender" id="gender_m" value="m" checked> Male</label>
									<label class="radio"><input type="radio" name="gender" id="gender_f" value="f"> Female</label>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Character Picture</label>
								<div class="controls">
									<div id="file_upload_handler">
										<input type="file" id="file_upload" placeholder="Choose an image..." accept="image/png, image/jpeg" /> 
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Description</label>
								<div class="controls">
									<textarea id="description" class="input-full" name="description" rows="12"/></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Powers and Abilities</label>
								<div class="controls">
									<textarea id="powers" class="input-full" name="powers" rows="12"/></textarea>
								</div>
							</div>
							<div class="controls">
								<input type="submit" class="btn btn-primary" value="Create Character" />
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
