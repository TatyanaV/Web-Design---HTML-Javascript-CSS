<?php
ini_set('display_errors',1);
error_reporting(E_ALL ^ E_NOTICE);

session_start();

if(!isset($_SESSION['username'])){
	header('Location: index.php');
}
if (!$_GET && $_SERVER['REQUEST_METHOD'] != "POST") {
	header('Location: activities.php');
}
$username = $_SESSION['username'];
$filename = $_GET['filename'];
$type = $_GET['type'];
?>
<!DOCTYPE html>
<!--

-->
<html>
<head>
<style>
html, body {
  border: 0px;
  margin: 0px;
  padding: 0px;
}

#map {
	height: 600px;
	border: 1px #888 solid;
	padding: 5px;
}

</style>
	<title>GPS Activity Analysis</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" >
	<script src="js/jquery.js"></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
	<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
	<script src="js/Google.js"></script>
	<script src="js/gpx.js"></script>
</head>
<body>

	<div id="map"></div>
	<script type="text/javascript">
		var filename = "<?php echo $filename; ?>";
		var username = "<?php echo $username; ?>";
		$(document).ready(function(){	
			$("#welcome").append(username + "!");
		});
		
		var type = "<?php echo $type; ?>";	
		var map = new L.Map('map');
		var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');	
		var track = new L.GPX("activities/"+username+"/"+filename, {
			async: true,
			marker_options: {
				startIconUrl: 'images/pin-icon-start.png',
				endIconUrl: 'images/pin-icon-end.png',
				shadowUrl: 'images/pin-shadow.png',
			}
			}).on('loaded', function(e){
			
			var gpx = e.target;
			map.fitBounds(gpx.getBounds());
			var name = gpx.get_name();
			var start  = gpx.get_start_time();
			var distance = gpx.get_distance_imp();
			var elevation = gpx.to_ft(gpx.get_elevation_gain());
			
			document.getElementById("name").innerHTML = name;
			document.getElementById("distance").innerHTML = distance.toFixed(2) + " mi";
			document.getElementById("elevation").innerHTML = elevation.toFixed(0) + " ft";
			$.ajax({
				type: 'POST',
				url: 'database.php',
				data: {'username': username, 'filename': filename, 'name': name, 'start1': start, 'distance': distance.toFixed(5),  'elevation': elevation.toFixed(5)}, 
			});
		});
		var ggl1 = new L.Google('ROADMAP');
		var ggl2 = new L.Google('TERRAIN');
		var ggl3 = new L.Google('SATELLITE');
			
		map.addLayer(track);
		map.addLayer(ggl1);
		map.addControl(new L.Control.Layers({'Map':ggl1,'Terrain':ggl2, 'Satellite':ggl3}));
	</script>
</body>
</html>