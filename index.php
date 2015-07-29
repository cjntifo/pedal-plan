<?php

function get($getName) {
	if (isset($_GET[$getName])) {
		return $_GET[$getName];
	}
	return false;
}
$autofill = get('auto');
if ($autofill) {
	$congestion = get('congestion');
	$safest = get('safest');
	$start = get('start');
	$end = get('end');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/navstyle.css" />
	<link rel="stylesheet" type="text/css" href="css/bodystyle.css" />
	<link rel="stylesheet" type="text/css" href="css/responsivestyle.css" />
	<!--[if gt ie 8]><!-->
	<link rel="stylesheet" type="text/css" href="css/notiestyle.css" />
	<!--<![endif]-->
	<script type="text/javascript" src="js/errorcheckerscript.js"></script>
	<!--[if IE]>
	<script type="text/javascript" src="js/iescript.js"></script>
	<![endif]-->
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="navbar">
		<div class="nav-container">
			<div id="bars">
			    <div class="bar"></div>
			    <div class="bar"></div>
			    <div class="bar"></div>
			</div>
			<div class="logo">LOGO</div>
			<ul id="nav-items">
				<a href="index.php"><li>Home</li></a>
				<a href="about.php"><li>About</li></a>
			</ul>
			<br class="clear" />
		</div>
	</div>
	<div class="container">
		<div class="desc">
			Fill out the form below to find out the best route for you and your bike to take
		</div>
		<div id="error-msg"></div>
		<div class="input-container">
			<form action="results.php" method="get" id='get-route'>
				<div class='locations'>
					<input type="text" name='start' placeholder="From..." <?php if ($autofill) {
						echo('value="'.$start.'"');
					} ?> />
					<input type="text" name='end' placeholder="To..." <?php if ($autofill) {
						echo('value="'.$end.'"');
					} ?> />
				</div>
				<div class="checkbox-container">
					<div class='checkboxes'>
						<p>
							<input type="checkbox" name='congestion' id='congestion' <?php if ($autofill) {
								if ($congestion == 'on') {
									echo "checked='checked'";
								}
							} else {echo "checked='checked'";} ?> />
							<label for='congestion'>Avoid congestion</label>
						</p>
						<p>
							<input type="checkbox" name='safest' id='safest' <?php if ($autofill) {
								if ($safest == 'on') {
									echo "checked='checked'";
								}
							} else {echo "checked='checked'";} ?> />
							<label for='safest'>Pick the safest route</label>
						</p>
					</div>
				</div>
				<div class="button-submit">
					<button type="submit">Get Route</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>