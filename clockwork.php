<?php
	echo "Hello";

	require("safest_route.php");
	require_once("key.php");
	require("clockwork/class-Clockwork.php");
	
	function interpretClockwork($text){
		$message = substr($text, 9);
		$arr = explode(" to ", $message);
	
		return array("start"=>urlencode($arr[0]), "end"=>urlencode($arr[1])); 
	}
	
	$phone = $_GET["from"];
	
	$locations = interpretClockwork($_GET["content"]);
	
	$clockwork = new Clockwork($clock_key);
	
	$route = getSafestRoute($locations["start"], $locations["end"], true, true)[0];
	
	$message = "(1 / 2)";

	foreach ($route["instructions"] as $instruction) {
		$message .= " " . strip_tags($instruction) . "\n";
	}
	
	echo $message; 

	var_dump($clockwork->send(array(array("to"=>$phone, "message"=>"(2 / 2) The rest of your journey and a map can be viewed at http://pedalplan.tk/results.php?start={$locations['start']}&end={$locations['end']}&congestion=on&safest=on."), array("to"=>$phone, "message"=>$message))));
?>
