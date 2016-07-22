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
	<title>Activities</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/project.css" type="text/css"/>
	<script src="js/jquery.js"></script>
	<script>
		var username = "<?php echo $username; ?>";
		$(document).ready(function(){	
			$("#header1").append(username + "!");
		});
	</script>
	<style>

	
	</style>
</head>
<body>
	<header>
		
	<h1 id = "header1">LIST OF YOUR TRIPS, </h1>
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
	<div class="contents">
	
		<div id="activities">
	
	<?php
	$mysql_db_hostname = "oniddb.cws.oregonstate.edu";
	$mysql_db_user = "vlaskint-db";
	$mysql_db_password = "tb0NGWMdrkGhe2mA";
	$mysql_db_database = "vlaskint-db";

	//http://www.sitepoint.com/avoid-the-original-mysql-extension-1/
	$con = mysqli_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password) or die("Could not connect database");

	mysqli_select_db($con, $mysql_db_database) or die("Could not select database");
	//mysqli_select_db($mysql_db_database, $con) or die("Could not select database");
	
	// Procedural API connection method #1
	//$db = mysqli_connect('host', 'username', 'password');
	//mysqli_select_db($con, $mysql_db_database);
	
	//http://php.net/manual/en/mysqli.query.php
	//http://stackoverflow.com/questions/20875113/php-mysql-select-using-mysqli-query
	//http://stackoverflow.com/questions/20875113/php-mysql-select-using-mysqli-query
	//http://www.w3schools.com/php/func_mysqli_num_rows.asp
	

$query = "SELECT * FROM activities WHERE username='$username' ORDER BY start1 DESC";
$result = mysqli_query($con, $query)or die(mysqli_error($con));
$num_row = mysqli_num_rows($result);
	
	echo "<table><tr id='top_row'><th>View Larger Size</th><th>Mini Map</th><th>Name</th><th>Start</th><th>Distance</th><th>Elevation Gain</th><th>Delete</th></tr>";
	while ($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo 
		"<td><form method = 'GET' action = 'analysis.php'> 	
		<input type='hidden' name='filename' value='" . $row['filename'] . "'>
		<input type='submit' value='View'></form></td>";
		echo "<td> <iframe src='analysis1.php?filename={$row['filename']}'></iframe></td>";
		echo "<td>" . $row['name'] . "</td>";
		$datetime = strtotime($row['start1']);
		$mysqldate = date("m/d/y g:i A", $datetime);
		echo "<td>" . $mysqldate . "</td>";
		
		echo "<td>" . round($row['distance'], 1) . " mi</td>";
		echo "<td>" . round($row['elevation'], 0) . " ft</td>";
		
		$delete = 'Are you sure you want to delete \"' . $row['name'] . '\"?'; 
		
		echo
		"<td><form method = 'POST' action = 'database.php'> 	
		<input type='hidden' name='filename' value='" . $row['filename'] . "'>
		<input type='hidden' name='type' value='delete'>	
		<input type='submit' value='Delete' onclick='return confirm(\"Delete \u0022" . $row['name'] ."\u0022?\")'></form></td></tr>";
			
	}
	echo "</table>";
?>
</div>
</div>
</body>
</html>