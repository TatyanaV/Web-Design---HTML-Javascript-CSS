<?php
	error_reporting (E_ALL);
	ini_set('display_errors', 'On');

	//http://php.net/manual/en/reserved.variables.get.php
	//https://www.youtube.com/watch?v=7TF00hJI78Y
	//i kept getting undefined index variables message, problem
	//was fixed with if statment https://www.youtube.com/watch?v=Qq8ZTMfs18k
	if(isset($_GET['send'])){
		$minMultiplicand = $_GET["min-multiplicand"];
		$maxMultiplicand = $_GET['max-multiplicand'];
		$minMultiplier = $_GET['min-multiplier'];
		$maxMultiplier = $_GET['max-multiplier'];
		$isTrue = True;
		//displayes users input 
		echo "<h3> NUMBERS THAT YOU'VE ENTERED: </h3>";
		echo  "min-multiplicand: ". $minMultiplicand;
		echo "<br />\n";  
		echo  " max-multiplicand: " .$maxMultiplicand;
		echo "<br />\n";  
		echo  "min-multiplier: " . $minMultiplier;
		echo "<br />\n";  
		echo  " max-multipler: " . $maxMultiplier;
		
	//check to make sure that numbers are integeres
	//http://php.net/manual/en/function.is-int.php
	//i kept getting an error even when the user was inputting an integer
	//per http://stackoverflow.com/questions/6416763/checking-if-a-variable-is-an-integer-in-php
	//All $_GET parameters have a string datatype, therefore, is_int will always return false. 
	$is_int_minMultiplicand = filter_var($minMultiplicand, FILTER_VALIDATE_INT);
	$is_int_maxMultiplicand = filter_var($maxMultiplicand, FILTER_VALIDATE_INT);
	$is_int_minMultiplier = filter_var($minMultiplier, FILTER_VALIDATE_INT);
	$is_int_maxMultiplier = filter_var($maxMultiplier, FILTER_VALIDATE_INT);
	
	
	if ($is_int_minMultiplicand === false){
		echo "You've entered:". $minMultiplicand ."for the min-multiplicand";
		echo "<p> min-multiplicand must be an integer. </p>";
		$isTrue = False;
	}
	if ($is_int_maxMultiplicand === false){
		echo "<br />\n";  
		echo "\n" . "You've entered:". $maxMultiplicand ."for the max-multiplicand";
		echo "<p> max-multiplicand must be an integer. </p>";
		$isTrue = False;
	}
	if ($is_int_minMultiplier === false){
		echo "<br />\n";  
		echo "\n" . "You've entered:". $minMultiplier ."for the min-multiplier";
		echo "<p> min-multiplier must be an integer. </p>";
		$isTrue = False;
	}
	if ($is_int_maxMultiplier === false){
		echo "<br />\n";  
		echo "\n" . "You've entered:". $maxMultiplier ."for the max-multiplier";
		echo "<p> max-multiplier must be an integer. </p>";
		$isTrue = False;
	}

	if ( $minMultiplicand >  $maxMultiplicand){
		echo  "<p> Minimum multiplicand larger than maximum </p>";
		$isTrue = False;
	}
	if ( $minMultiplier >  $maxMultiplier){
		echo "<p> Minimum multiplier larger than maximum </p>";
		$isTrue = False;
	}
	if (!isset($minMultiplicand)){
		echo "<p> Missing parameter min-multiplicand. </p>";
		$isTrue = False;
	}
	if (!isset($maxMultiplicand)){
		echo "<p> Missing parameter max-multiplicand. </p>";
		$isTrue = False;
	}
	if (!isset($minMultiplier)){
		echo "<p> Missing parameter min-multiplier. </p>";
		$isTrue = False;
	}
	if (!isset($maxMultiplier)){
		echo "<p> Missing parameter max-multiplier. </p>";
		$isTrue = False;
	}

	// if all entered numbers are valid
	if ($isTrue == True){
		echo '<p> <h3> MULTIPLICATION TABEL: </h3> </p>
		<table border="1"><td>';
		for($j = 0; $j < ($maxMultiplier - $minMultiplier + 1); $j++){
			echo '<td>' . ($minMultiplier + $j);
		}
		for($i = 0; $i < ($maxMultiplicand - $minMultiplicand + 1); $i++){
			echo '<tr><td>' . ($minMultiplicand + $i);
			for($j = 0; $j < ($maxMultiplier - $minMultiplier + 1); $j++){
				echo '<td>' . (($minMultiplicand + $i) * ($minMultiplier + $j));
			}
		}
	}
	else echo "<p>Try again";
	echo '</table>';
	echo '</body>';
	echo '</html>';
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>multtable</title>
	</head>
	<body>
		<br>
		<form action= "multtable.php" method="GET">
			<table border="0">
			<p> <h3> Please enter min-multiplicand, max-multiplicand , min-multiplier and max-multiplier to produce Multiplication Table. </h3></p>
			 
			<tr>
				<td>min-multiplicand</td>
				<td align="center"><input type="text" name="min-multiplicand" size="30" /></td>
			</tr>
			 
			<tr>
				<td>max-multiplicand</td>
				<td align="center"><input type="text" name="max-multiplicand" size="30" /></td>
			</tr>
			 
			<tr>
				<td>min-multiplier</td>
				<td align="center"><input type="text" name="min-multiplier" size="30"  /></td>
			</tr>
			 
			 <tr>
				<td>max-multiplier</td>
				<td align="center"><input type="text" name="max-multiplier" size="30"  /></td>
			</tr>
			<tr>
			<td colspan="2" align="center"><input type="submit" name = "send" value="Submit"/></td>
			</tr>
			 
			</table>
		</form>
	</body>
</html>



