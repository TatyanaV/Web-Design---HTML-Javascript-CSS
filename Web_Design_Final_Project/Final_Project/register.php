<!DOCTYPE html>


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
		margin-top: 5px;
	}
	h4 {
		padding-top: 0px;
		margin-top: -5px;
	}
	</style>
	<title>Registration Form</title>
<script type="text/javascript">
$(document).ready(function(){
   	$("#register_button").click(function(){
		username = $("#username").val();
        password = $("#password").val();
		email = $("#email").val();
		action = "register";

		var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
		
		if (username.length < 4){
			$("#alert").html("Your username must be at least 4 characters long.");
		} else if (password.length < 8){
			$("#alert").html("Your password must be at least 8 characters long.");
		} else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length){
            $("#alert").html("Not a valid e-mail address.");
        } else {
			$.ajax({
				type: "POST",
				url: "verify.php",
				data: {'username': username, 'password': password, 'email': email, 'action': action},

				success: function(html){
					if( html=='true'){
						$("#login_form").fadeOut("normal");
						$("#shadow").fadeOut();
						window.location="activities.php";
					} else {
						$("#alert").html("Username is already taken.");
					}
				},
				beforeSend:function(){
					$("#alert").html("Loading...");
				}
			});
		}
        return false;
    });	
});
</script>
</head>
<body>
<header>
	<h1 id = "header1">REGISTER: </h1>
		<div id="navigation">
<ul id="nav">
<ul id="nav">
	<li><a href="index.php">UBOUT US</a></li>
	<li><a href="gpx1.php">HOW TO CREATE .GPX FILE</a></li>
	<li id="login"><a href="login.php">LOGIN</a></li>
	<li id="name"><a href="register.php">REGISTER</a></li>
    </ul>
    </ul>
		</div>
	</header>	
	<img alt="full screen background image" src="road-trip-on-historic-u-s-route-66-images-antony-ingram_100430531_l.jpg" id="full-screen-background-image" /> 
	<br>
	<br>
	<br>
	<br>
	<h2 id="name1">PLEASE REGISTER TO USE THE WEBSITE:</h2>
	<div class="box">

			<form action="verify.php">
				<h3 class="upform">Username: <span> (must be at least 4 characters) </span> </h3> 	
					<input type="text"  placeholder="Username" required="" id="username" name="username" class = "mytext"/>
			
				<h3 class="upform">Password:<span> (must be at least 8 characters)</span></h3>
					<input type="password" placeholder="Password" required="" id="password" name="password"class = "mytext"/>
			
				<h3 class="upform">Email:<span> (must be a valid email address)</span></h3>
					<input type="email"  placeholder="Email" required="" id="email" name="email" class = "mytext"/>
	
				<br>
				<br>
				<div>
					<input type="submit" value="Register" id="register_button" class = "mytext2"/>
				</div>
				<div class="err" id="alert"></div>
			</form>
		
	</div>
</body>
</html>