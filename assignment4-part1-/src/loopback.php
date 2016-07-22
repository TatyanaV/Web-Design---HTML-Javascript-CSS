<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
	</head>
	<body>
		<h2>Please fill out either POST or GET form below to get a JSON object:</h2>
		Once the form is filled, press submit. RESULTS WILL BE DISPLAYED AT THE BOTTON OF THE PAGE.
		<p>
		<fieldset><h2>GET Test</h2>
		<form action="loopback.php" method="GET">
			Name:<input type="text" name="name" ><br><br>
			Age: <input type="number" name="age" ><br><br>
			UserName: <input type = "text" name = "username" > <br><br>
			E- Mail: <input type = "text" name = "email" > <br><br>
			Password: <input type = "password" name = "password" > <br><br>
			<input type="submit" value="Submit GET Form">
		</form>
		</p>
		<p>
		</fieldset>
		<br>

		<fieldset><h2> POST Test</h2>
		<form action="loopback.php" method="POST">
			Name:<input type="text" name="name" ><br><br>
			Age: <input type="number" name="age" ><br><br>
			UserName: <input type = "text" name = "username" > <br><br>
			E- Mail: <input type = "text" name = "email" > <br><br>
			Password: <input type = "password" name = "password" > <br><br>
			<input type="submit" value="Submit POST Form">
		</form>
		</p>
		</fieldset>
	</body>
</html>

<?php
	//https://www.youtube.com/watch?v=4P-LgF0Rhdg
	//http://www.sitepoint.com/forums/showthread.php?418153-Is-_SERVER-REQUEST_METHOD-always-either-GET-or-POST
	//http://www.tutorialspoint.com/json/json_php_example.htm
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$array = [];
		$array['Type'] = 'GET';
		$request = $_GET;
		if($_GET == []){
			$array = array("Type" => $type, "parameters" => null );
			echo (json_encode($array));
		}
		else{
			$temporary = array();
			//we look at each value in the $_GET array
			foreach ($request as $key => $value){
				// If a value is empty, warn the user and set it to null
				if($value == ""){	
					echo "<b>WARNING: </b> There is no value for $key.  The value is set to NULL.<br>";
					$temporary[$key] = null;
				}
				else{
					$temporary[$key] = $value;
				}
			}
		}
		// Output JSON to browser
		echo json_encode(array("Type" => 'GET' , "parameters" => $temporary ));
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$array = [];
		$array['Type'] = 'POST';
		$request = $_POST;
		if($_POST == []){
			$array = array("Type" => $type, "parameters" => null );
			echo (json_encode($array));
		}
		else{
			$temporary = array();
			//we look at each value in the $_POST array
			foreach ($request as $key => $value){
				// If a value is empty, warn the user and set it to null
				if($value == ""){	
					echo "<b>WARNING: </b> There is no value for $key.  The value is set to NULL.<br>";
					$temporary[$key] = null;
				}
				else{
					$temporary[$key] = $value;
				}
			}
		}
		// Output JSON to browser
		echo json_encode(array("Type" => 'POST' , "parameters" => $temporary ));
	}
?>