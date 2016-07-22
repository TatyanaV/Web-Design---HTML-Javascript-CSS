<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h1>content2.php</h1>
<?php
	//see content1.php for explanation of the code
	if (!isset($_SESSION['username'])) {
		$_SESSION = array();
		session_destroy();
		$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
		$filePath = implode('/', $filePath);
		$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath. "/login.php";
		//if the user tried to opren content2.php page without login they will be taken to the log in page
		echo "<script type='text/javascript'>window.location = '$redirect';
		</script>";
		die();
	}
	echo "Link to content1.php <a href='content1.php'>here</a>.";
?>
</body>
</html>