<?php
    require 'database1.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM `file` WHERE `id`=(?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: list_files.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
</head>
<body>
	<header>
		<title>Pictures</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/project.css" type="text/css"/>
	<script src="js/jquery.js"></script>
		
	<h1 id = "header1">DELETING A PICTURE: </h1>
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
	<h2 id="name1">ARE YOU SURE THAT YOU WANT TO DETELE THIS PICTURE?</h2>
	<div class="box">
                     
                    <form  action="delete.php" method="post">
					
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error"></p>
                      <div class="form-actions">
                        <button type="submit" class="btn btn-danger">Yes</button>
                         <a class="btn" href="list_files.php">No</a></button>
						 
                        </div>
                    </form>
              
         </div>        
  </body>
</html>
