<?php
	require("key.php");
	require("polyline.php");
	require("distance_calc.php");
	
	$start = urlencode($_GET["start"]);
	$end = urlencode($_GET["end"]);
	$url = "https://maps.googleapis.com/maps/api/directions/json?origin=$start&destination=$end&key=$key&alternatives=true&mode=bicycling";
	$db = new SQLite3("accidents.db");
	
	$route = json_decode(file_get_contents($url));
	$instructions = [];
	$coords = [];
	$rounded_lat = [];
	$rounded_lng = [];
	
	function prepareForQuery(&$arr) {
		$arr = array_unique($arr);
	}
	
	foreach ($route->routes[0]->legs[0]->steps as $step) {
		$polyline = $step->polyline->points;
		$coords = array_merge($coords, decodePolyline($polyline));
		
		$instruction = strip_tags(str_replace("<div", ". <div", $step->html_instructions), "<b>") . ".";
		array_push($instructions, $instruction);
		echo "<p>$instruction</p>";
	}
	
	foreach ($coords as $coord) {
		array_push($rounded_lat, round($coord[0], 1));
		array_push($rounded_lng, round($coord[1], 1));
	}
	
	prepareForQuery($rounded_lat);
	prepareForQuery($rounded_lng);
	
	$sql = "SELECT lat,lng FROM accidents WHERE (";
	
	foreach ($rounded_lat as $rl) {
		$sql .= " lat LIKE \"{$rl}%\"";
		
		if ($rl != end($rounded_lat)) {
			$sql .= " OR";
		}
	}
	
	$sql .= ") AND (";
	
	foreach ($rounded_lng as $rl) {
		$sql .= " lng LIKE \"{$rl}%\"";
		
		if ($rl != end($rounded_lng)) {
			$sql .= " OR";
		}
	}
	
	$sql .= ");";
	
	echo $sql;
	
	$query = $db->query($sql);
	$accidents = [];
	
	while ($row = $query->fetchArray()) {
		foreach ($coords as $coord) {
			$distance = getDistance($coord[0], $coord[1], $row["lat"], $row["lng"]);
			
			if ($distance <= 0.1) {
				array_push($accidents, $row);
				break 1;
			}
		}
	}
	
	echo count($accidents);
