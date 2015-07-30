function loadPlaceholderScript () {
	var inputs = document.getElementsByTagName('input'),
		startPlaceholder = document.getElementById('start-placeholder'),
		endPlaceholder = document.getElementById('end-placeholder');
	for (var i = inputs.length - 1; i >= 0; i--) {
		inputs[i].onfocus = function () {
			if (this.value === '') {
				if (this.id == 'end') {
					endPlaceholder.className = 'active';
				} else {
					startPlaceholder.className = 'active';
				}
			}
		}
		inputs[i].onblur = function() {
			if (this.value === '') {
				if (this.id == 'end') {
					endPlaceholder.className = '';
				} else {
					startPlaceholder.className = '';
				}
			}
		}
	}
};
