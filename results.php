<?php
	require("key.php");
	
	$start = urlencode($_GET["start"]);
	$end = urlencode($_GET["end"]);
	$mode = urlencode($_GET["mode"]);
	$url = "https://maps.googleapis.com/maps/api/directions/json?origin=$start&destination=$end&key=$key&alternatives=true&mode=$mode";
	
	$route = json_decode(file_get_contents($url));
	
	foreach ($route->routes[0]->legs[0]->steps as $step) {
		echo $step->html_instructions . "<br>";
	}
