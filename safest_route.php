<?php
	require("key.php");
	require("polyline.php");
	require("distance_calc.php");
	
	function getSafestRoute($start, $end, $safe, $congestion) {
		$url = "https://maps.googleapis.com/maps/api/directions/json?origin=$start&destination=$end&key={$_GLOBALS['google']}&alternatives=true&mode=bicycling";
		$db = new SQLite3("accidents.db");
		$route_data = json_decode(file_get_contents($url));
		$routes = [];
		$query_results = [];
		$rounded_lat = [];
		$rounded_lng = [];
	
		$weather_url = "http://api.openweathermap.org/data/2.5/weather?lat={$route_data->routes[0]->legs[0]->start_location->lat}&lon={$route_data->routes[0]->legs[0]->start_location->lng}";
		$weather_data = json_decode(file_get_contents($weather_url));
		$light = (time() <= $weather_data->sys->sunrise || time() >= $weather_data->sys->sunset) ? "Darkness%" : "Daylight";
		$rain = (strpos($weather_data->weather[0]->description, "rain") !== false) ? "Rain%" : "Fine%";
	
		$incidents_url = "http://dev.virtualearth.net/REST/v1/Traffic/Incidents/{$route_data->routes[0]->bounds->southwest->lat},{$route_data->routes[0]->bounds->southwest->lng},{$route_data->routes[0]->bounds->northeast->lat},{$route_data->routes[0]->bounds->northeast->lng}?key={$_GLOBALS['bing']}&s=3,4&t=1,2,3,4,8,9";
		$incidents_data = json_decode(file_get_contents($incidents_url));
		$incidents = [];
	
		foreach ($incidents_data->resourceSets[0]->resources as $incident) {
			array_push($incidents, $incident->point->coordinates);
		}
	
		function compareRoutes($a, $b) {
			if ($a["points"] > $b["points"]) {
				return 1;
			} else if ($b["points"] > $a["points"]) {
				return -1;
			} else {
				return 0;
			}
		}
	
		function getOddKeys($array) {
			$new_arr = [];
		
			foreach ($array as $key=>$value) {
				if ($key % 2 == 1) {
					array_push($new_arr, $value);
				}
			}
		
			return $new_arr;
		}
	
		foreach ($route_data->routes as $route) {
			$instructions = [];
			$coords = [];
			$polylines = [];
	
			foreach ($route->legs[0]->steps as $step) {
				$polyline = $step->polyline->points;
				$coords = array_merge($coords, getOddKeys(decodePolyline($polyline)));
				array_push($polylines, addslashes($polyline));
		
				$instruction = strip_tags(str_replace("<div", ". <div", $step->html_instructions), "<b>") . ".";
				array_push($instructions, $instruction);
			}
		
			foreach ($coords as $coord) {
				array_push($rounded_lat, round($coord[0], 2));
				array_push($rounded_lng, round($coord[1], 2));
			}
		
			array_push($routes, array("instructions"=>$instructions, "coords"=>$coords, "polylines"=>$polylines, "start"=>[$route->legs[0]->start_location, $route->legs[0]->start_address], "end"=>[$route->legs[0]->end_location, $route->legs[0]->end_address]));
		}
	
		$rounded_lat = array_unique($rounded_lat);
		$rounded_lng = array_unique($rounded_lng);
	
		$sql = "SELECT lat,lng,severity FROM accidents WHERE (";

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

		$sql .= ") AND light LIKE \"$light\" AND weather LIKE \"$rain\" AND speed_limit < 70;";

		$query = $db->query($sql);

		while ($row = $query->fetchArray()) {
			array_push($query_results, $row);
		}
	
		foreach ($routes as &$route) {
			$accidents = [];
			$points = 0;
			if ($safe) {
				foreach ($query_results as $row) {
					foreach ($route["coords"] as $coord) {
						$distance = getDistance($coord[0], $coord[1], $row["lat"], $row["lng"]);
		
						if ($distance <= 0.1) {
							array_push($accidents, $row);
							break 1;
						}
					}
				}
	
				$route["accidents"] = $accidents;
			
				foreach ($accidents as $accident) {
					if ($accident["severity"] == "Slight") {
						$points++;
					} else if ($accident["severity"] == "Serious") {
						$points += 2;
					} else {
						$points += 3;
					}
				}
			}
		
			if ($congestion) {
				foreach ($incidents as $incident) {
					foreach ($route["coords"] as $coord) {
						$distance = getDistance($coord[0], $coord[1], $incident[0], $incident[1]);
			
						if ($distance <= 0.1) {
							$points++;
							break 1;
						}
					}
				}
			}
	
			$route["points"] = $points;
		}
	
		usort($routes, "compareRoutes");
		
		return $routes;
	}
?>
