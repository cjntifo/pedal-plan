<?php
	require("safest_route.php");
	
	$start = urlencode($_GET["start"]);
	$end = urlencode($_GET["end"]);
	$safe = $_GET["safe"] ? false : true;
	$congestion = $_GET["congestion"] ? false : true;
	
	$routes = getSafestRoute($start, $end, $safe, $congestion);
	
	foreach ($routes as $route) {
		echo "<br>" . $route["points"];
	}
	
	echo "<br>INCIDENTS " . count($incidents);
