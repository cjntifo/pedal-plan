function initialize() {
	var mapOptions = {
			center: {lat: start_coords[0], lng: start_coords[1]},
			zoom: 12
		},
		map = new google.maps.Map(document.getElementById('map'), mapOptions),
		startMarker = new google.maps.Marker({
			position: new google.maps.LatLng(start_coords[0], start_coords[1]),
			map: map,
			title: start_address
		}),
		endMarker = new google.maps.Marker({
			position: new google.maps.LatLng(end_coords[0], end_coords[1]),
			map: map,
			title: end_address
		});
	
	for (var i = 0; i < polylines.length; i++) {
		var route = new google.maps.Polyline({
			path: google.maps.geometry.encoding.decodePath(polylines[i]),
			strokeColor: "#0000B3",
			strokeOpacity: 0.5,
			strokeWeight: 5,
			geodisc: true,
			map: map
		});
	}
}
google.maps.event.addDomListener(window, 'load', initialize);
