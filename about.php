<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/navstyle.css">
	<link rel="stylesheet" type="text/css" href="css/bodystyle.css">
	<link rel="stylesheet" type="text/css" href="css/responsivestyle.css">
	
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<header>
		<div class="nav-container">
			<div id="bars">
			    <div class="bar"></div>
			    <div class="bar"></div>
			    <div class="bar"></div>
			</div>
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="Pedal Plan"></a>
			</div>
			<ul id="nav-items">
				<a href="index.php"><li>Home</li></a>
				<a href="about.php"><li>About</li></a>
			</ul>
			<br class="clear">
		</div>
	</header>
	
	<div class="container">
		<h2>About Pedal Plan</h2>
		<p class="justify">Pedal Plan tries to find the safest possible route for your journey by bike. Our algorithm take into account historic accident, weather and live traffic congestion data to try and find the route with the fewest risks without compromising on journey time. When you're on the move you sometimes may not have a data connection; if you can't access our website for whatever reason, you can send us a text and we'll reply with directions for the safest route by bike.</p>
		<p class="justify">Our website uses a SQLite3 database to store historic accident data and enable us to filter and this data quickly. PHP controls the database and processes most of the data, as well as making all necessary API calls to Google Maps, Bing Maps, the Open Weather Map and Clockwork. The results are then presented to the user with the help of HTML, CSS and a bit of JavaScript.</p>
		<p class="justify">Pedal Plan is built in such a way as to allow for easy expansion. In the future we envision producing native mobile apps for major platforms such as Android and iOS and developing a way to access live step-by-step instructions for navigation while riding your bike.</p>
		
		<h2>Contact us</h2>
		<p class="justify">To get in touch please <a href="mailto:alex@pedalplan.tk">email us</a> or tweet us at <a href="http://twitter.com/hitecherik">@hitecherik</a>, <a href="http://twitter.com/cjntifo">@cjntifo</a> or <a href="http://twitter.com/hive66">@hive66</a>.</p>
	</div>
</body>
</html>
