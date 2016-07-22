<?php
	//https://github.com/mangi07/assignment4-part1/tree/master/src
	error_reporting(E_All);
	ini_set('display_errors', 'On');
	//session_start() creates a session or 
	//resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie. 
	//http://php.net/manual/en/function.session-start.php
	session_start();
	//http://stackoverflow.com/questions/12126420/isset-php-isset-getsomething-getsomething
	//checks if get is set to logout
	if (isset($_GET['logout'])) {
		$_SESSION = array();//clears out all data stored in SESSION
		//session_destroy — Destroys all data registered to a session
		//http://php.net/manual/en/function.session-destroy.php
		session_destroy();//destroy the session - cookie that identifies it is destroyed

		//https://api.drupal.org/api/drupal/includes!file.inc/function/file_download/6
		/*
		'PHP_SELF'
		The filename of the currently executing script, relative to the document root. For instance, 
		$_SERVER['PHP_SELF'] in a script at the address http://example.com/foo/bar.php would be 
		/foo/bar.php. The __FILE__ constant contains the full path and filename of the current (i.e. included) file.
		If PHP is running as a command-line processor this variable contains the script name since PHP 4.3.0. Previously 
		it was not available.
		The idea is that I find the current location and seperate the parts by "/". 
		I would then go through the array and see if anything is there beyond the actual page I was on, 
		and if so, I could use it to find the current folder I am using and for other stuff*/
		//http://www.webdeveloper.com/forum/showthread.php?72403-explode%28%29-and-PHP_SELF
		$filePath = explode('/', $_SERVER['PHP_SELF'], -1);//The -1 keeps everything except the last element (the filename)
		//// Merge remainder of arguments from GET['q'], into relative file path.
		//http://codereview.stackexchange.com/questions/15348/php-config-class
		//The implode() function returns a string from the elements of an array.
		$filePath = implode('/', $filePath);//This gives the path up to the filename
		//Returns the Host header from the current request 
		//http://www.w3schools.com/php/php_superglobals.asp
		$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;//gives the redirect path
		header("Location: {$redirect}/login.php", true);//this lets the browser know that
														//when it receives the header, it must go somewhere else
														//the 'true' lets it know it can replace the existing header
														// http_redirect("login.php")
		die(); //The die() function prints a message and exits the current script.
	}
	echo '<!DOCTYPE html>
	<html>
	<head>
	<meta charset="UTF-8">
	<title>content1</title>
	<h1>content1.php</h1>
	</head>
	<body>
	<div>';
	//If the username is any other string it should display the text "Hello [username] you have visited this page [n] 
	//times before. Click here to logout.". n should display 0 on the first visit, 1 on the 2nd and so on.
	//The text 'here' should log the user out, destroying the session, and return them to the login screen.
	function welcome() {
		echo "Hello " . $_SESSION['username']. " you have visited this page ". $_SESSION['visit']. " times before.";
		// The text 'here' should log the user out, destroying the session, and return them to the login screen.
		echo " Click ". '<a href="content1.php?logout=true">here</a> '. "to logout.<br><br>";
		//content1.php must have a link to content2.php that is displayed only after a user has logged in 
		//(this includes subsequent visits not from login.php).
		echo 'Click <a href="content2.php">here</a> to go to the content2.php page.';
	}
	
	//if there is an acceptable username and session is set
	//If the user navigates away from the page and returns, the session should persist. The user may not navigate back via a POST. 
	//This is OK, the count should persist. The POST is only needed for the initial login.
	//http://stackoverflow.com/questions/10490678/difference-between-if-isset-session-and-if-session
	if(isset($_SESSION['username'])){
		$_SESSION['visit']++; //number of visits are incremented
		welcome(); //user is greeted
	}
	//If a user tries to access either content1.php or content2.php without going through the login page at some previous point 
	//in time the user should should simply be redirected back to login.php. There are different ways to accomplish this. 
	//One might be to set a variable when a session is started the 'correct' way and check if that variable exists when 
	//loading the page.
	//count of visits is set to zero at the begining
	elseif (isset($_POST['username']) && $_POST['username'] != "" && !is_null($_POST['username'])){
		$_SESSION['visit'] = 0;
		$_SESSION['username'] = $_POST['username'];
		welcome();
	}
	//If the username is an empty string or null, content1.php should display the message "A username must be entered.
	//Click here to return to the login screen.".
	else{
		echo "A username must be entered. Click ". '<a href="login.php">here</a>'. " to return to the login screen.";
	}
	?>
	</div>
</body>
