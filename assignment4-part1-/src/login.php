<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>login</title>
	</head>
	<body>
		<!--login.php should have a form where a user can enter a username. It should have a button that says "Login". 
		//Upon clicking the login button the page should POST the username to the page content1.php. 
		//The username should be posted via a parameter called username-->
		<form action="content1.php" method="POST">
			<label>Name: <input type="text" name="username"></label>
			<input type="submit" name="Login">
		</form>
	</body>
</html>