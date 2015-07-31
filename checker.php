<?php
	require("key.php");
	
	function get($getName, $default = false) {
		if (isset($_GET[$getName])) {
			return urlencode($_GET[$getName]);
		}
		return $default;
	}
	
	$congestion = get('congestion', 'off');
	$safest = get('safest', 'off');
	$start = get('start');
	$end = get('end');
	$rtn = '';
	$route1Query = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=$start&key=$google";
	$route2Query = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=$end&key=$google";

	$route1 = json_decode(file_get_contents($route1Query));
	$startRoute = false;
	$route2 = json_decode(file_get_contents($route2Query));
	$endRoute = false;
	
	function checkAddress($address, &$route) {
		global $rtn;
		
		if (strpos($address, ", UK") || strpos($address, ", United Kingdom")) {
			$route = true;
			$rtn .= "+$address";
			return true;
		}
		
		return false;
	}
	
	foreach ($route1->results as $result) {
		if (checkAddress($result->formatted_address, $startRoute)) {
			break;
		}
	}
	
	foreach ($route2->results as $result) {
		if (checkAddress($result->formatted_address, $endRoute)) {
			break;
		}
	}

	if (!$startRoute || !$endRoute) {
		$rtn = 'false';
		if (!$startRoute) {
			$rtn .= '+0';
		}
		if (!$endRoute) {
			$rtn .= '+1';
		}
	} else {
		$rtn = "true$rtn";
	}
	echo $rtn;
?>
