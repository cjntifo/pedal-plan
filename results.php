<?php
	function get($getName, $default = false) {
		if (isset($_GET[$getName])) {
			return $_GET[$getName];
		}
		return $default;
	}
	require('key.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	<script type='text/javascript' src='js/mapscript.js'></script>
	<script type="text/javascript" src="js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/navstyle.css" />
	<link rel="stylesheet" type="text/css" href="css/bodystyle.css" />
	<link rel="stylesheet" type="text/css" href="css/responsivestyle.css" />
	<title>Results</title>
</head>
<body>
	<div class="navbar">
		<div class="nav-container">
			<div id="bars">
			    <div class="bar"></div>
			    <div class="bar"></div>
			    <div class="bar"></div>
			</div>
			<div class="logo">LOGO</div>
			<ul id="nav-items">
				<a href="index.php"><li>Home</li></a>
				<a href="about.php"><li>About</li></a>
			</ul>
			<br class="clear" />
		</div>
	</div>
	<div class="container">
		<div id="map"></div>
		<div class="directions">
			<div class="title">
				Directions
			</div>
			<div class="instructions">
				
			</div>
		</div>
	</div>
</body>
</html>