<?php
	function get($getName, $default = false) {
		if (isset($_GET[$getName])) {
			return $_GET[$getName];
		}
		return $default;
	}
	$congestion = get('congestion', 'off');
	$safest = get('safest', 'off');
	$start = get('start');
	$end = get('end');
	if (!$start || !$end) {
		header("Location: index.php?auto=yes&start=$start&end=$end&congestion=$congestion&safest=$safest");
	}
?>