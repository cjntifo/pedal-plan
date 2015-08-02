<?php
	require("safest_route.php");
	
	function getVar($getName, $default = false) {
		if (isset($_GET[$getName])) {
			return $_GET[$getName];
		}
		return $default;
	}
	
	function getStats($one, $two) {
		$safer = ceil((100 / $one) * $two);
		$fatalities = ceil(($two - $one) / 3);
		return [$safer - 100, $fatalities];
	}
	
	$start = urlencode(getVar("start"));
	$end = urlencode(getVar("end"));
	$safe = getVar("safest") == "on" ? true : false;
	$congestion = getVar("congestion") == "on" ? true : false;
	
	$routes = getSafestRoute($start, $end, $safe, $congestion);
	
	$stats = getStats($routes[0]["points"], $routes[($routes[0]["points"] == $routes[1]["points"] && count($routes) > 2) ? 2 : 1]["points"]);
	$safer = $stats[0];
	$fatalities = $stats[1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	
	<link rel="shortcut icon" href="images/logo.png">
	
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
		
		<?php foreach ($routes as $route) {
			echo "console.log('{$route['points']}');";
		} ?>
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
		<h2>Your <?php echo $safe ? "safest " : " "; ?>route <?php echo $congestion ? "with the least congestion" : ""; ?></h2>
		
		<p>It takes <?php echo $routes[0]["time"]; ?> to travel from <b><?php echo $routes[0]["start"][1]; ?></b> to <b><?php echo $routes[0]["end"][1]; ?></b> by bike.</p>
		
		<?php if ($safer > 0) { ?>
			<div class="safest">
				<p>This route is <?php echo $safer; ?>% safer than alternative routes. That means about <?php echo $fatalities; ?> fewer fatal historic accidents on this route.</p>
			</div>
		<?php } ?>
		
		<div id="map"></div>
		<div class="instructions">
			<ol>
			<?php
				foreach ($routes[0]["instructions"] as $instruction) {
					echo "<li><p>$instruction<p></li>";
				}
			?>
			</ol>
		</div>
	</div>
	<footer>
		<p>Copyright &copy; Alexander Nielsen, Carl Ntifo and Ollie Cole 2015. Licenced under a <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY-NC-SA 4.0 Licence</a>.</p>
	</footer>
</body>
</html>
