function loadErrorCheckerScript() {
	var getRoute = document.getElementById('get-route'),
		inputs = document.getElementsByTagName('input');
	getRoute.onsubmit = function () {
		if(this.className == 'success') {
			return true;
		}
		var xmlhttp
			ajaxString = 'checker.php?';
		if (window.XMLHttpRequest) {
		  	xmlhttp = new XMLHttpRequest();
		} else {
		  	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		for (var i = inputs.length - 1; i >= 0; i--) {
			if (inputs[i].getAttribute('type') == 'text') {
				ajaxString += inputs[i].getAttribute('name') + '=' + inputs[i].value;
			} else if (inputs[i].getAttribute('type') == 'checkbox') {
				ajaxString += inputs[i].getAttribute('name') + '=';
				ajaxString += inputs[i].checked ? 'on' : 'off';
			}
			if(i != 0) {
				ajaxString += '&';
			}
		}
		xmlhttp.open("GET", ajaxString, true);
		xmlhttp.send();
		xmlhttp.onreadystatechange = function() {
		  	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		    	result = xmlhttp.responseText;
		    	result = result.split(' ');
		    	isCorrect = result[0] === 'true';
		    	if (isCorrect) {
		    		getRoute.className = 'success';
		    		getRoute.submit();
		    	} else {
		    		if (result.length == 3) {
		    			alert('Both locations are invalid');
		    		} else if (result[1] == '0') {
		    			alert('Your destination is invalid');
		    		} else {
		    			alert('Your location is invalid');
		    		}
		    	}
		    }
		}
		return false;
	}
}