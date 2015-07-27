window.onload = function () {
	dropdownBars = document.getElementById('bars');
	navItems = document.getElementById('nav-items');
	dropdownBars.onclick = function () {
		if (navItems.className == 'toggled') {
			navItems.className = '';
		} else {
			navItems.className = 'toggled';
		};
	}
}