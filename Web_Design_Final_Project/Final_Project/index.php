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
		height: 600px;
	}
	.upform {
		margin-top: 20px;
	}
	#register {
		text-align: center;
		margin-right: 415px;
		margin-top: 40px;
		font-size: 14pt;
	}

	</style>
	<title>Home</title>
<script type="text/javascript">
$(document).ready(function(){
   $("#login_button").click(function(){
		username = $("#username").val();
        password = $("#password").val();
		action = "login";

         $.ajax({
            type: "POST",
			url: "login.php",
            data: {'username': username, 'password': password, 'action': action},

            success: function(html){
				if (html=='true'){
					$("#login_form").fadeOut("normal");
					$("#shadow").fadeOut();
					window.location="activities.php";
				} else {
					$("#add_err").html("Wrong username or password");
				}
            },
            beforeSend:function() {
                $("#add_err").html("Loading...");
            }
        });
         return false;
    });
});
</script>
</head>
<body>
	<header>
<h1 id = "header1">UBOUT US </h1>
   
<ul id="nav">
	<li><a href="index.php">UBOUT US</a></li>
	<li><a href="gpx1.php">HOW TO CREATE .GPX FILE</a></li>
	<li id="login"><a href="login.php">LOGIN</a></li>
	<li id="name"><a href="register.php">REGISTER</a></li>
    </ul>
  </header>

<img alt="full screen background image" src="road-trip-on-historic-u-s-route-66-images-antony-ingram_100430531_l.jpg" id="full-screen-background-image" /> 
	<br>
	<h2 id="name1">HOW TO USE OUR WEBSITE:</h2>
<section>
<div class="boxs">
<p> 1. CREATE A <a href ="gpx1.php"> .GPX </a> FILE OF YOU TRIPS</p>
<p>2. GO ON YOUR TRIP AND DO NOT FORGET TO TAKE PICUTES DURING THE TRIP</p>
<p>3. WHEN YOU COME BACK FROM THE TRIP LOAD YOUR .GPX FILE TO OUR WEBSITE </p>
<p>4. YOU CAN REVIEW ALL YOUR ROUTES IN ONE TABLE</p>
<p>5. YOU ALSO HAVE AN OPTION TO SEE A LARGE MAP OF EACH TRIP</p>
<p>6. YOU CAN DOWNLOAD YOUR FAVORITE PHOTOS OF THE TRIP</p>
<p>7. YOU CAN REVIEW ALL DOWLOADED IMAGES IN ONE TABLE</p>
<p>8. YOU CAN DOWNLOAD EACH PICTURE TO SAVE IT ON YOUR COMPUTER</p>
</div>
</section>




</body>
</html>