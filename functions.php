<?php
	function createHeader ($page) {
		echo "<!DOCTYPE html>
				<html lang='en'>
				<head>
					<meta charset='utf-8'>
					<meta name='viewport' content='width=device-width'>
					
					<link rel='shortcut icon' href='images/logo.png'>
					
					<script type='text/javascript' src='js/script.js'></script>
					
					<link rel='stylesheet' type='text/css' href='css/style.css'>
					<link rel='stylesheet' type='text/css' href='css/navstyle.css'>
					<link rel='stylesheet' type='text/css' href='css/bodystyle.css'>
					<link rel='stylesheet' type='text/css' href='css/responsivestyle.css'>";
		if ($page == 'index') {
			echo "<title>Home</title>
					<!--[if gt ie 8]><!-->
					<link rel='stylesheet' type='text/css' href='css/notiestyle.css'>
					<!--<![endif]-->
					<script type='text/javascript' src='js/errorcheckerscript.js'></script>
					<script type='text/javascript' src='js/placeholderscript.js'></script>
				";
		} else {
			echo("<title>About</title>");
		}
		echo "</head>
				<body>
				<header>
					<div class='nav-container'>
						<div class='logo'>
							<a href='http://www.pedalplan.tk/'><img src='images/logo.png' alt='Pedal Plan'></a>
						</div>
						<div id='bars'>
						    <div class='bar'></div>
						    <div class='bar'></div>
						    <div class='bar'></div>
						</div>
						<ul id='nav-items'>
							<a href='http://www.pedalplan.tk/'><li>Home</li></a>
							<a href='about.php'><li>About</li></a>
						</ul>
						<br class='clear'>
					</div>
				</header>
				<div class='container'>
			";
	}
	
	function createFooter () {
		echo "	</div>
					<footer>
						<p>Copyright &copy; Alexander Nielsen, Carl Ntifo and Ollie Cole 2015. Licenced under a <a href='http://creativecommons.org/licenses/by-nc-sa/4.0/'>CC BY-NC-SA 4.0 Licence</a>.</p>
					</footer>
				</body>
				</html>";
	}
?>
