window.onload = function () {
	var dropdownBars = document.getElementById("bars"),
		navItems = document.getElementById("nav-items"),
		as = navItems.getElementsByTagName('a'),
		getRoute = document.getElementById('get-route'),
		inputs = document.getElementsByTagName('input');
	for (var i = inputs.length - 1; i >= 0; i--) {
		if (inputs[i].getAttribute('type') == 'text') {
			inputs[i].setAttribute('autocomplete', 'off');
			inputs[i].setAttribute('spellcheck', 'false');
		};
	};
	for (var i = as.length - 1; i >= 0; i--) {
		as[i].onfocus = function () {
			this.blur();
		}
	}
	dropdownBars.onclick = function () {
		if (navItems.className == "toggled") {
			navItems.className = "";
		} else {
			navItems.className = "toggled";
		}
	}
	if (typeof loadErrorCheckerScript == 'function') {
		loadErrorCheckerScript();
	}
	if (typeof loadPlaceholderScript == 'function') {
		loadPlaceholderScript();
	}
}