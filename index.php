<?php
	require("functions.php");
	createHeader("index");
?>

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
							<input type="checkbox" name='congestion' id='congestion' checked="checked">
							<label for='congestion'>Avoid congestion</label>
						</p>
						<p>
							<input type="checkbox" name='safest' id='safest' checked="checked">
							<label for='safest'>Pick the safest route</label>
						</p>
					</div>
				</div>
				<div class="button-submit">
					<button type="submit">Get Route</button>
				</div>
			</form>
			
			<p class="sms">(or text <b>PEDALPLAN [start] to [end]</b> to 84433)</p>
		</div>

<?php
	createFooter();
?>
