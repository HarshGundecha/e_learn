	"use script";

	var map = null;
	google.maps.event.addDomListener(window, 'load', init);

	function init() {
		// Basic options for a simple Google Map
		// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
		var mapOptions = {
			// How zoomed in you want the map to start at (always required)
			zoom: 15,
			scrollwheel: false,

			// The latitude and longitude to center the map (always required)
			center: new google.maps.LatLng(40.8723929,-73.5362968), // New York

			// How you would like to style the map.
			// This is where you would paste any style found on Snazzy Maps.
			styles: [
						{
							"featureType": "all",
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"saturation": 0
								},
								{
									"color": "#000000"
								},
								{
									"lightness": 0
								}
							]
						},
						{
							"featureType": "all",
							"elementType": "labels.text.stroke",
							"stylers": [
								{
									"visibility": "off"
								},
								{
									"color": "#000000"
								},
								{
									"lightness": 16
								}
							]
						},
						{
							"featureType": "all",
							"elementType": "labels.icon",
							"stylers": [
								{
									"visibility": "off"
								}
							]
						},
						{
							"featureType": "administrative",
							"elementType": "geometry.fill",
							"stylers": [
								{
									"color": "#000000"
								},
								{
									"lightness": 20
								}
							]
						},
						{
							"featureType": "administrative",
							"elementType": "geometry.stroke",
							"stylers": [
								{
									"color": "#2c2c2c"
								},
								{
									"lightness": 0
								},
								{
									"weight": 1.2
								}
							]
						},
						{
							"featureType": "landscape",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ebebeb"
								},
								{
									"lightness": 0
								}
							]
						},
						{
							"featureType": "poi",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ebebeb"
								},
								{
									"lightness": 0
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#2c2c2c"
								},
								{
									"gamma": "0"
								},
								{
									"weight": "0"
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry.fill",
							"stylers": [
								{
									"color": "#000000"
								},
								{
									"lightness": 17
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry.stroke",
							"stylers": [
								{
									"color": "#000000"
								},
								{
									"lightness": 29
								},
								{
									"weight": 0.2
								}
							]
						},
						{
							"featureType": "road.arterial",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#c3c3c3"
								},
								{
									"lightness": 18
								}
							]
						},
						{
							"featureType": "road.local",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 0
								}
							]
						},
						{
							"featureType": "transit",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#2d2d2d"
								},
								{
									"lightness": 19
								}
							]
						},
						{
							"featureType": "water",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#4d4d4d"
								},
								{
									"lightness": 0
								}
							]
						}
					]
		};

		// Get the HTML DOM element that will contain your map
		// We are using a div with id="map" seen below in the <body>
		var mapElement = document.getElementById('map');

		// Create the Google Map using our element and options defined above
		map = new google.maps.Map(mapElement, mapOptions);

		// Let's also add a marker while we're at it
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(40.8723929,-73.5362968),
			map: map,
			title: 'Snazzy!',
			icon: 'images/location-pin.png'
		});
		// init styles
		//mapStylesInit();

	}