<?php
	require("safest_route.php");
	
	function getVar($getName, $default = false) {
		if (isset($_GET[$getName])) {
			return $_GET[$getName];
		}
		return $default;
	}
	
	$start = urlencode(getVar("start"));
	$end = urlencode(getVar("end"));
	$safe = getVar("safe") == "on" ? true : false;
	$congestion = getVar("congestion") == "on" ? true : false;
	
	$routes = getSafestRoute($start, $end, $safe, $congestion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	
	<script>
		var polylines = [<?php 
				foreach ($routes[0]["polylines"] as $key=>$polyline) {
					echo "\"$polyline\"";
					echo ($key + 1 == count($routes[0]["polylines"])) ? "" : ",";
				}
			?>],
			start_address = "<?php echo $routes[0]["start"][1]; ?>",
			start_coords = [<?php echo $routes[0]["start"][0]->lat; ?>, <?php echo $routes[0]["start"][0]->lng; ?>],
			end_address = "<?php echo $routes[0]["end"][1]; ?>",
			end_coords = [<?php echo $routes[0]["end"][0]->lat; ?>, <?php echo $routes[0]["end"][0]->lng; ?>];
	</script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
	<script type='text/javascript' src='js/mapscript.js'></script>
	<script type="text/javascript" src="js/script.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/navstyle.css">
	<link rel="stylesheet" type="text/css" href="css/bodystyle.css">
	<link rel="stylesheet" type="text/css" href="css/resultsstyle.css">
	<link rel="stylesheet" type="text/css" href="css/responsivestyle.css">
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
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="Pedal Plan"></a>
			</div>
			<ul id="nav-items">
				<a href="index.php"><li>Home</li></a>
				<a href="about.php"><li>About</li></a>
			</ul>
			<br class="clear">
		</div>
	</div>
	<div class="container">
		<div id="map"></div>
		<div class="directions">
			<div class="title">
				Directions
			</div>
			<div class="instructions">
				<ol>
				<?php
					foreach ($routes[0]["instructions"] as $key=>$instruction) {
						$type = ($key % 2 == 0) ? "even" : "odd";
						
						echo "<li class='$type'><p>$instruction<p></li>";
					}
				?>
				</ol>
			</div>
		</div>
	</div>
</body>
</html>
