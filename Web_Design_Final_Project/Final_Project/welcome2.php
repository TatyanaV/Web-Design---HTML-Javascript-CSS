<?php
ini_set('display_errors',1);
session_start();
if(!isset($_SESSION['username'])){
header('Location: index.php');
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<!--
-->
<html>
<head>
<title>GPS Activity Analysis</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" >
<link rel="stylesheet" href="css/project.css" type="text/css"/>
<script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script src="js/Google.js"></script>
<script src="js/gpx.js"></script>
	<script src="js/jquery.js"></script>
	<script>
		var username = "<?php echo $username; ?>";
		$(document).ready(function(){	
			$("#header1").append(username + "!");
		});
	</script>
<style>
.boxed {
  border: 1px solid blue;
  background-color: white;
} 

section {
  float: left;
  margin: 0 1.5%;
  width: 30%;
}

</style>
</head>



<body>
<header>
<h1 id = "header1">WELCOME, </h1>
   
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
  </header>

<img alt="full screen background image" src="road-trip-on-historic-u-s-route-66-images-antony-ingram_100430531_l.jpg" id="full-screen-background-image" /> 
	<br>
	<h2 id="name1">HOW TO USE OUR WEBSITE:</h2>
<section>
<div class="boxs">
<p> 1. CREATE A <a href ="gpx.php"> .GPX </a> FILE OF YOU TRIP</p>
<p>2. GO ON YOUR TRIP AND DO NOT FORGET TO TAKE PICUTES DURING THE TRIP</p>
<p>3. WHEN YOU COME BACK FROM THE TRIP <a href = "upload.php">LOAD</a> YOUR .GPX FILE TO OUR WEBSITE </p>
<p>4. YOU CAN <a href = "activities.php">REVIEW ALL YOUR ROUTES</a> IN ONE TABLE</p>
<p>5. YOU ALSO HAVE AN OPTION TO SEE A LARGE MAP OF EACH TRIP BY PRESSING 'VIEW' BUTTON NEXT TO EACH <a href = "activities.php"> TRIP</a></p>
<p>6. YOU CAN <a href = "picture.php"> DOWNLOAD</a> YOUR FAVORITE PHOTOS </a> OF THE TRIP</p>
<p>7. YOU CAN <a href = "list_files.php"> REVIEW </a>ALL DOWLOADED IMAGES</a> IN ONE TABLE</p>
<p>8. YOU CAN DOWNLOAD EACH PICTURE TO SAVE IT ON YOUR COMPUTER BY PRESSING 'DOWNLOAD' BUTTON  NEAXT TO THE <a href = "list_files.php">IMAGE</a> </p>
</div>
</section>
</body>
</html>
