function loadIEScript () {
	var inputs = document.getElementsByTagName('input');
	for (var i = inputs.length - 1; i >= 0; i--) {
		inputs[i].value = inputs[i].getAttribute('placeholder');
		inputs[i].onfocus = function () {
			if (this.value != '') {
				this.value = '';
			}
		}
		inputs[i].onblur = function() {
			if (this.value == '') {
				this.value = this.getAttribute('placeholder');
			}
		}
	}
};