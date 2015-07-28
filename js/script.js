window.onload = function () {
	var dropdownBars = document.getElementById("bars"),
		navItems = document.getElementById("nav-items"),
		as = navItems.getElementsByTagName('a');
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
}