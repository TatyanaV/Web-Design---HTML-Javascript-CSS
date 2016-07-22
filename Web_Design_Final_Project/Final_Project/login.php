<!DOCTYPE html>
<!--

-->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/project.css" type="text/css"/>
	<style>
	.contents {
			height: 450px;
		}
		.upform {
			margin-top: 25px;
		}
	</style>
	<title>Login Form</title>
<script type="text/javascript">
$(document).ready(function(){
   $("#login_button").click(function(){
		username = $("#username").val();
        password = $("#password").val();
		action = "login";

         $.ajax({
            type: "POST",
			url: "verify.php",
            data: {'username': username, 'password': password, 'action': action},

            success: function(html){
				if (html=='true'){
					window.location="welcome.php";
				} else {
					$("#alert").html("Wrong username or password");
				}
            },
            beforeSend:function() {
                $("#alert").html("Loading...");
            }
        });
         return false;
    });
});
</script>
</head>
<body>
<header>
	<h1 id = "header1">LOGIN: </h1>
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
	<br>
	
	
	<h2 id="name1">PLEASE LOGIN TO THE WEBSITE:</h2>
		<br>

			<div class="box">
				
				
					<form action="verify.php">
						
						<h3 class="upform">Username:</h3><div><input type="text" class = "mytext" placeholder="Username" required="" id="username" name="username"/></div>
						<h3 class="upform">Password:</h3><div><input type="password" class = "mytext" placeholder="Password" required="" id="password" name="password"/></div>
						<br>
						<div><input type="submit" class = "mytext2" value="Log In" id="login_button"/></div>
						
						<br>
						<div class="err" id="alert"></div>
					</form>
				
				
			</div>
</body>
</html>