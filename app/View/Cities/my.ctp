<!DOCTYPE html>
<html>
<body>

<ul id="myList"><li>Coffee</li><li>Tea</li></ul>

<p id="demo">Click the button to append an item to the list</p>

<button onclick="myFunction()">Try it</button>
<button onclick="My('rzeszów')">getll</button>
<button onclick="al('rzeszów')">getll</button>
<script>
function al(pos){
	alert(pos);
	var geocoder = new google.maps.Geocoder();
		geocoder.geocode({ 'address': pos }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var lat = location.lat().toString().substr(0, 12);
				var lng = location.lng().toString().substr(0, 12);
				alert(lat, lng);
			}
			else{
				alert('error: ' + status);
			}
		});
	alert(pos);
}
function myFunction()
{
var node=document.createElement("LI");
var textnode=document.createTextNode("Water");
node.appendChild(textnode);
document.getElementById("myList").appendChild(node);
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

</script>

<p><strong>Note:</strong><br>First create an LI node,<br> then create a Text node,<br> then append the Text node to the LI node.<br>Finally append the LI node to the list.</p>

</body>
</html>