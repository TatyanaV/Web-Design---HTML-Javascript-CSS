<?php
	ini_set('display_errors',1);

	session_start();

	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}
	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		header('Location: activities.php');
	}

	$username = $_SESSION['username'];

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$errorinfo = $_FILES["myfile"]["error"];
		$filename = $_FILES["myfile"]["name"];
		$tmpfile = $_FILES["myfile"]["tmp_name"];
		$filesize = $_FILES["myfile"]["size"];
		$type = $_FILES["myfile"]["type"];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
	}	
	if (file_exists("activities/" . $_SESSION['username'] . "/" . $filename)){
		echo '<script language="javascript">';
		echo 'alert("TESTING THIS-FILE ALREADY EXIST.")';
		echo '</script>';
		
		echo '<script language="javascript">';
		echo 'window.location="upload.php"';
		echo '</script>';
	} elseif ($ext == "gpx"){
		move_uploaded_file($tmpfile, "activities/" . $_SESSION['username'] . "/" . $filename);
		header('Location: analysis.php?filename='.$filename.'&type='.$type);
	} else 
		echo "Only GPX files are allowed.";
?>