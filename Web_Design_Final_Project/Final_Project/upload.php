<?php
ini_set('display_errors',1);

session_start();

if(!isset($_SESSION['username'])){
	header('Location: index.php');
$username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<!--

-->
<html>
	<head>
		<title>File Upload</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="js/jquery.js"></script>
		<link rel="stylesheet" href="css/project.css" type="text/css"/>
		<style>
		.contents {
			height: 600px;
		}
		.upform {
			margin-top: 35px;
		}
		
		input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
	align:center;
	background-color:white;
}
		</style>
		
		<script type='text/javascript'>
		var username = "<?php echo $_SESSION['username']; ?>";
		$(document).ready(function(){	
			$("#header1").append(username + "!");
		});
		
		function validateForm() {
			var http = new XMLHttpRequest();
			var form = document.forms["upload"];
			var filename = form["myfile"].value
			var extension = form["myfile"].value.split('.').pop();
			
			
			var url = "activities/"+username+"/"+filename;
			
			if (filename == ""){
				document.getElementById("alert").innerHTML = "Please input a file.";
				return false;
			}
			if (extension != "gpx" && extension != "GPX"){
				document.getElementById("alert").innerHTML = "The file must be a *.GPX file.";
				return false;
			}
			
			http.open('HEAD', url, false);
			http.send();

			if (http.status!=404){
				document.getElementById("alert").innerHTML = "<a href = http://en.wikipedia.org/wiki/HTTP_404> Error 404 </a>";
				return false;				
			} else {
				document.getElementById("alert").innerHTML = "Uploading...";
				return true;
			}
		}
		</script>
	</head>
	<body>
	<header>
		
	<h1 id = "header1">UPLOAD YOUR .GPX FILE, </h1>
		<div id="navigation">
<ul id="nav">
	<li><a href="welcome.php">UBOUT US</a></li>
	<li><a href="gpx.php">HOW TO CREATE .GPX FILE</a></li>
	<li id="upload"><a href="upload.php">UPLOAD GPX FILE</a></li>
	<li id="activity"><a href="activities.php">TRIPS</a></li>
	<li><a href="picture.php">UPLOAD PICTURES</a></li>
	<li><a href="list_files.php">PICTURES</a></li>
	<li><a href="references.php">REFFERENCES</a></li>
	<li id="logout"><a href="logout.php">LOGOUT</a></li>
    </ul>
		</div>
	</header>	
	<img alt="full screen background image" src="road-trip-on-historic-u-s-route-66-images-antony-ingram_100430531_l.jpg" id="full-screen-background-image" /> 
	<br>
		

		
		<form action="filesave.php" id="upload_form" method="post" name="upload" enctype="multipart/form-data" onsubmit="return validateForm()">
			<div id="upload_title">Please Select a .GPX File for Analysis:
			<br>
			<br>
			<br>
			<label for="filename" class="custom-file-upload">
				<i class="glyphicon glyphicon-upload"></i> BROWSE
			</label>
		
		<input type="file" name="myfile" id="filename">
				<div class="upform"><input type="submit" value="Upload" id="activity_type" class = "mytext2"></div>
				<div id="alert"></div>
			</div>
		</form>

	</body>
</html>