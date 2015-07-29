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
	$rtn = '';

	if (!$start || !$end) {
		$rtn = 'false';
		if (!$start) {
			$rtn .= ' 0';
		}
		if (!$end) {
			$rtn .= ' 1';
		}
	} else {
		$rtn = 'true';
	}
	echo $rtn;
?>