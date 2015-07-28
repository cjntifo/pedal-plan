<?php
	require("key.php");
	
	$start = urlencode($_GET["start"]);
	$end = urlencode($_GET["end"]);
	$url = "https://maps.googleapis.com/maps/api/directions/json?origin=$start&destination=$end&key=$key&alternatives=true&mode=bicycling";
	
	$route = json_decode(file_get_contents($url));
	$postcodes = [];
	$instructions = [];
	
	foreach ($route->routes[0]->legs[0]->steps as $step) {
		$lat = urlencode(($step->start_location->lat + $step->end_location->lat) / 2);
		$lng = urlencode(($step->start_location->lng + $step->end_location->lng) / 2);
		$api_call = simplexml_load_file("http://uk-postcodes.com/postcode/nearest?lat=$lat&lng=$lng&miles=0.05&format=xml");
		
		$instruction = strip_tags(str_replace("<div", ". <div", $step->html_instructions), "<b>") . ".";
		
		foreach ($api_call->postcodes->postcode as $postcode) {
			array_push($postcodes, $postcode->postcode);
		}
		
		array_push($instructions, $instruction);
		echo "<p>$instruction</p>";
	}
