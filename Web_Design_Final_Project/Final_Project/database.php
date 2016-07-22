<?php
	ini_set('display_errors',1);

	session_start();

	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}
	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		header('Location: activities.php');
	}
	
	$filename = $_POST['filename'];
	$type = $_POST['type'];
	if ($type != "delete"){
		$username = $_POST['username'];
		$name = $_POST['name'];
		$start = $_POST['start1'];
		$distance = $_POST['distance'];	
		$elevation = $_POST['elevation'];
		
	}
	
	$dbhost = "oniddb.cws.oregonstate.edu";
	$dbname = "vlaskint-db";
	$dbpass = "tb0NGWMdrkGhe2mA";
	$dbuser = "vlaskint-db";
	

	$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	$filename = mysqli_real_escape_string($con, $filename);
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} 
	else {
		if ($type == "delete"){
			mysqli_query($con, "DELETE FROM activities WHERE filename='$filename'");
			$file = "activities/" . $_SESSION['username'] . "/" . $filename;
			unlink($file);			
			header('Location: activities.php');			
		}
		else {
			$test = mysqli_query($con, "SELECT * FROM activities WHERE username='$username' AND name='$name'");
			$num_row = mysqli_num_rows($test);
			if ($num_row == 0) {
				$result = mysqli_query($con, "INSERT INTO activities (username, filename, name, start1, distance,  elevation) VALUES 
				('{$username}', '{$filename}', '{$name}', '{$start}', '{$distance}',  '{$elevation}')");
			}
		}
	}	
?>