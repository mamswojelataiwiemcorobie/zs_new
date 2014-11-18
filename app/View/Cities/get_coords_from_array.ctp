<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
          function My(address) {
          	var node=document.createElement("LI");
var textnode=document.createTextNode("Water");
node.appendChild(textnode);
document.getElementById("address").appendChild(node);
          	alert('d');
          }

          function GetLocation(address) {
          var geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'address': address }, function (results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  ParseLocation(results[0].geometry.location);

              }
              else
                alert('error: ' + status);

          });
      }

  }

  function ParseLocation(location) {

      var lat = location.lat().toString().substr(0, 12);
      var lng = location.lng().toString().substr(0, 12);

      //use $.get to save the lat lng in the database
      $.get('MatchLatLang.ashx?action=setlatlong&lat=' + lat + '&lng=' + lng,
            function (data) {
                // fill textboss (feedback purposes only) 
                //with the found and saved lat lng values
                $('#tbxlat').val(lat);
                $('#tbxlng').val(lng);
                $('#spnstatus').text(data);


            });
    }





function geocodePosition(pos) {
	geocoder.geocode({
		latLng: pos
	}, function(responses) {
		if (responses && responses.length > 0) {
			updateMarkerAddress(responses[0].formatted_address);
		} else {
			updateMarkerAddress('Cannot determine address at this location.');
		}
	});
}

function updateMarkerStatus(str) {
	document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
	document.getElementById('info').innerHTML = [
		latLng.lat(),
		latLng.lng()
	].join(', ');
}

function updateMarkerAddress(str) {
	document.getElementById('address').innerHTML = str;
}

function initialize() {
	var latLng = new google.maps.LatLng(-34.397, 150.644);
	var map = new google.maps.Map(document.getElementById('mapCanvas'), {
		zoom: 8,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	var marker = new google.maps.Marker({
		position: latLng,
		title: 'Point A',
		map: map,
		draggable: true
	});
	
	// Update current position info.
	updateMarkerPosition(latLng);
	geocodePosition(latLng);
	
	// Add dragging event listeners.
	google.maps.event.addListener(marker, 'dragstart', function() {
		updateMarkerAddress('Dragging...');
	});
	
	google.maps.event.addListener(marker, 'drag', function() {
		updateMarkerStatus('Dragging...');
		updateMarkerPosition(marker.getPosition());
	});
	
	google.maps.event.addListener(marker, 'dragend', function() {
		updateMarkerStatus('Drag ended');
		geocodePosition(marker.getPosition());
	});
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
<body>
	<style>
	#mapCanvas {
		width: 500px;
		height: 400px;
		float: left;
	}
	#infoPanel {
		float: left;
		margin-left: 10px;
	}
	#infoPanel div {
		margin-bottom: 5px;
	}
	</style>
	
	<input type="button" value="Capacity Chart" onclick="GetLocation('rzeszów');">
	<input type="button" value="2" onclick="My('rzeszów');">
	<div id="infoPanel">
		<b>Marker status:</b>
		<div id="markerStatus"><i>Click and drag the marker.</i></div>
		<b>Current position:</b>
		<div id="info"></div>
		<b>Closest matching address:</b>
		<div id="address"></div>
	</div>
</body>
</html>