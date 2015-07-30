<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Home</title>
	
	<script type="text/javascript" src="js/errorcheckerscript.js"></script>
	<script type="text/javascript" src="js/placeholderscript.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/navstyle.css">
	<link rel="stylesheet" type="text/css" href="css/bodystyle.css">
	<link rel="stylesheet" type="text/css" href="css/responsivestyle.css">
	<!--[if gt ie 8]><!-->
	<link rel="stylesheet" type="text/css" href="css/notiestyle.css">
	<!--<![endif]-->
</head>
<body>
	<div class="navbar">
		<div class="nav-container">
			<div id="bars">
			    <div class="bar"></div>
			    <div class="bar"></div>
			    <div class="bar"></div>
			</div>
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="Pedal Plan"></a>
			</div>
			<ul id="nav-items">
				<a href="index.php"><li>Home</li></a>
				<a href="about.php"><li>About</li></a>
			</ul>
			<br class="clear">
		</div>
	</div>
	<div class="container">
		<div class="desc">Enter your journey details and preferences to find the safest route by bike.</div>
		<div id="error-msg"></div>
		<div class="input-container">
			<form action="results.php" method="get" id='get-route'>
				<div class='locations'>
					<label for="start" id='start-placeholder'>From...</label>
					<input type="text" name='start' id='start' placeholder='From...'>
					<div class="arrow">&rarr;</div>
					<div class="arrow-down">&darr;</div>
					<label for="end" id='end-placeholder'>To...</label>
					<input type="text" name='end' id='end' placeholder='To...'>
				</div>
				<div class="checkbox-container">
					<div class='checkboxes'>
						<p>
							<input type="checkbox" name='congestion' id='congestion'>
							<label for='congestion'>Avoid congestion</label>
						</p>
						<p>
							<input type="checkbox" name='safest' id='safest'>
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
