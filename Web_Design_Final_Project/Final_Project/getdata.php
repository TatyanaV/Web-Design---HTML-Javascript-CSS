<?php
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
	<title>Pictures</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/project.css" type="text/css"/>
	<script src="js/jquery.js"></script>
	<script>
		var username = "<?php echo $username; ?>";
		$(document).ready(function(){	
			$("#header1").append(username + "!");
		});
		

	</script>
	
</head>
<body>
	<header>
		
	<h1 id = "header1">DOWNLOADED PICTURES, </h1>
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
<?php
// Connect to the database
$dbLink = new mysqli("oniddb.cws.oregonstate.edu", "vlaskint-db", "tb0NGWMdrkGhe2mA", "vlaskint-db");
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}
 
// Query for a list of all existing files
$sql = "SELECT `id`, `name`, `mime`, `size`, `created` FROM `file` WHERE username = '".$_SESSION['username']."';";

$result = $dbLink->query($sql);
 
// Check if it was successfull

if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no files in the database</p>';
    }
    else {
		echo '<div class= contents>';
        // Print the top of a table
        echo '<table width="100%">
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Mime</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Created</b></td>
					  <td><b>Picture</b></td>
					  <td><b>Download</b></td>
					    <td><b>Delete</b></td>
                    <td><b>&nbsp;</b></td>

                </tr>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['mime']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['created']}</td>
                     	<td><img src='get_file.php?id={$row['id']}' height = 100 width = 100 / ></td>
						<td><a href='get_file.php?id={$row['id']}'>Download</a></td>
						
						<td><a onclick='deletedata('<?php echo $row['id']; ?>')' Delete</a> </td>
						
                
        }
 
        // Close table
        echo '</table>';
		echo '</div>';
    }
 
    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}
 
// Close the mysql connection
$dbLink->close();
?>
</body>
</html>