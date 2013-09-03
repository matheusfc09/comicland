<?php
	
	session_start();
	require "config.php";
	
	header("Content-Type: application/json");

	if(isset($_FILES['file_uploaded'])) {

		$file = $_FILES['file_uploaded'];
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = explode(".", $file['name']);
		$extension = end($extension);

		if ((($file["type"] == "image/gif")
			|| ($file["type"] == "image/jpeg")
			|| ($file["type"] == "image/png")
			|| ($file["type"] == "image/pjpeg")
			&& ($file["size"] < 50000)
			&& in_array($extension, $allowedExts))) {
		
			if ($file["error"] > 0) {
				echo json_encode(array(
					"success" => false,
					"message" => "File Error! Return Code: " . $file["error"]
				));
				exit;
			} else {
				
				$filename = "tmp/".md5(mt_rand()).".".$extension;
				move_uploaded_file($file["tmp_name"], "../".$filename);
				
				echo json_encode(array(
					"success" => true,
					"filename" => $filename,
					"message" => "File uploaded successfully"
				));
				exit;

			}	
		}	
	}
	
	echo json_encode(array(
		"success" => false,
		"message" => "Invalid file"
	));
	exit;
	
?>