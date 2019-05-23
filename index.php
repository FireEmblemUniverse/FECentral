<?php
session_name("FEU");
session_start();
$servername = "localhost";
$username = "MY_USERNAME";
$password = "MY_PASSWORD";
$database = "MY_DATABASE";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?
require_once "libs/Mobile_Detect.php";
$detect = new Mobile_Detect;
?>
<html>
<head>
<?
	if ( $detect->isMobile())
	{
		echo '<link rel="stylesheet" href="./stylemobile4.css" />';
	}
	else 
	{
		echo '<link rel="stylesheet" href="./style11.css" />';
	}
?>

<title>Lair Of The Fooker</title>
<meta name="description" content="Get involved with the Markyjoe community, or check out FE hacking resources, or look at Marc's creative projects!">
<meta property="og:url" content="http://markyjoe.com" />
<meta property="og:type" content="website" />
<meta http-equiv="Cache-Control" content="max-age=200" />
<meta name="Keywords" content="markyjoe,markyjoe1990,video games,video game,let's play,LP,music,art,blog,fire emblem,fe,community,youtube,patreon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="Unicode UTF-8">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="jquery-3.3.1.min.js"></script>
<script src="script9.js"></script>
</head>
<body>
<div class="wrapper">
	<div class="banner">
		<div class="webname">Lair of the Fooker</div>
		<div class="bannerimage"><a href='http://markyjoe.com'><img src="./images/banner.jpg" width="100%" style="opacity:0;" /></a></div>
	</div>
	<div class="content">
		<?php
			if ($_GET['page']) include($_GET['page'] . ".php");
			if (!$_GET['page']) include("home.php");
		?>
	</div>
		<?
		include("nav.php");
	?>
</div>
<div class="footer" align="center">
	<a href="https://www.youtube.com/channel/UCFj3iwNV5w1wFxNBYjQPsig?view_as=subscriber"><img src="./images/youtube.png"/></a>
	<a href="https://www.facebook.com/markyjoe1990/"><img src="./images/im-facebook.png"/></a>
	<a href="https://twitter.com/markyjoe1990"><img src="./images/Twitter.png"/></a>
	<a href="https://discord.gg/SfBpKcn"><img src="./images/discord-new-logo.png"/></a>
	<a href="https://www.patreon.com/markyjoe1990"><img src="./images/download.png"/></a>
	<a href="https://www.twitch.tv/markyjoe"><img src="./images/twitch-logo.png"/></a>
	<a href="https://markyjoe1990.bandcamp.com"><img src="./images/bandcamplogo.png"/></a>
	<a href="mailto:markyjoe1990@gmail.com"><img src="./images/email.png"/></a>
</div>
<div class="copyright" align="center">Copyright Markyjoe 2018</div>
</body>
</html>