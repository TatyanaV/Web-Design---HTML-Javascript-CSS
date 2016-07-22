<!DOCTYPE html>
<!--
-->
<html>
<head>
<title>GPS Activity Analysis</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/project.css" type="text/css"/>

<style>
.boxed {
  border: 1px solid blue;
  background-color:  #EBF4FA;
  font-size: 14;
  font-family: Arial;

} 

</style>
</head>



<body>
<header>
<h1 id = "header1">INSTRUCTIONS TO CREATE .GPX FILE FOR YOUR TRIP </h1>
   
		<div id="navigation">
<ul id="nav">
	<li><a href="index.php">UBOUT US</a></li>
	<li><a href="gpx1.php">HOW TO CREATE .GPX FILE</a></li>
	<li id="login"><a href="login.php">LOGIN</a></li>
	<li id="name"><a href="register.php">REGISTER</a></li>
    </ul>
		</div>
	</header>

<img alt="full screen background image" src="road-trip-on-historic-u-s-route-66-images-antony-ingram_100430531_l.jpg" id="full-screen-background-image" /> 
	<br>
	

<div class="contents">
<div class="boxed">
	
<h2 align = "center">Creating GPS Routes from Google Maps: </H2>
<h3 align = "center">[Please NOTE: TA is provided with .gpx files to test this project.]</h3>
<h3 align = "center">[This is just an explanation what I had to do create .gpx files. ]</h3>
<ol >
<li>
<p>
The first step is to get the route in <a href="https://www.google.com/maps"> Google Maps. </a> </p>
<p>[I prefer to use the ‘Walking’ route over the driving route in the (probably vain) hope it takes less busy roads.] </p>
 then manually adjust the route until it’s sensible</p> </li>
<img src="map.png">

<li><p>Copy the URL address of the route. </p></li>
<li><p> You need to download the program ‘TyretoTravel’ from  <a href="http://www.tyretotravel.com/">www.tyretotravel.com</a> .    </p></li>
<li><p>Once the program is started, select File|Import from Web Site. In the window that opens put the cursor, remove the ‘http://’, 
and go CTRL V to paste in the copied information from Google Maps. </p> </li>
<img src="image_thumb2.png">
<li><p>Click the Import button (bottom right), and select ‘Route tracks’. Select OK.  </p></li>
<img src="image_thumb3.png">
<li><p>Your route will be imported as a series of Waypoints. </p></li>
<img src="image_thumb4.png">
<li><p>Save the file as a .GPX  </p></li>
<li><p> The GPX file is only the x-y co-ordinates, but what about elevations? Fortunately, there is a fix for that as well.
 You go to: <a href=" http://www.gpsvisualizer.com/elevation"> http://www.gpsvisualizer.com/elevation</a> and upload your GPX file. You then select Convert & add elevation. 
 This creates a new GPX file with the elevation data estimated from terrain models. </p> </li>
<img src="image_thumb6.png">
<li> <p>Once the .gpx file is created, download it from the gpsvisualizer.com and save on your computer. </p> </li>
<li>Your file is ready to be added to our database for analysis and for keeping track of your activities and favourite routes. </li>
</ol>
</div>
</div>