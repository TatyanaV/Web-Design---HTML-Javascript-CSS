<?php
ini_set('display_errors',1);

session_start();

if(!isset($_SESSION['username'])){
	header('Location: index.php');
$username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MySQL file upload example</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
		
    </head>
    <body>
	
		<h1 id = "header1">REFERENCES: </h1>
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
		
	<br>
	<br>
	<br>
	<br>
	<h2 id="name1">USED OVER 200 WEBSITES FOR REFFERENCES</h2>
	<h2 id="name1">STILL HAVE CS340 PROJECT TO DO, SO REFERENCES ARE NOT ADDED TO THIS SITE</h2>
	<h2 id="name1">REFFERENCES WILL BE PROVIDED UPON REQUEST</h2>
    </body>
    </html>

 
		