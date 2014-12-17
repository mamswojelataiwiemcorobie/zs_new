function sfGmapWidgetWidget(options){
    // this global attributes
    this.lng            = null;
    this.lat            = null;
    this.lookup         = null;
    this.address        = null;
    this.map            = null;
    this.geocoder       = null;
    this.options        = options;
    this.province       = null;
    this.city           = null;
    this.district       = null;
    this.street         = null;
    this.street_number  = null;
    this.post_code      = null;
    this.addMarker      = null;
    this.markersArray   = [];
    this.marker         = null;

    this.deleteMarkers = function() {
        if(this.markersArray) {
            for(i in this.markersArray) {
                this.markersArray[i].setMap(null);
            }
            this.markersArray.length[0];
        }
    }

    this.addMarker = function(location, new_title) {
        this.marker = new google.maps.Marker({
            position: location,
            map: this.map,
            draggable: true,
            title: new_title
        });
        this.deleteMarkers();
        this.markersArray.push(this.marker);
        add_move_listener(this.marker, this);
    }
	
	this.resetMarker = function() {
		var lat = this.lat.val();
		var lon = this.lng.val();
		var point = new google.maps.LatLng(lat, lon);
		this.addMarker(point, this.address.val());
		this.map.setZoom(15);
		this.map.setCenter(point);
	}

    this.init = function() {
        // retrieve dom element
        this.lng      = jQuery("#" + this.options.longitude);
        this.lat      = jQuery("#" + this.options.latitude);
        this.address  = jQuery("#" + this.options.address);
        this.lookup   = jQuery("#" + this.options.lookup);
        this.province       = jQuery("#" + this.options.province);
        this.city           = jQuery("#" + this.options.city);
        this.district       = jQuery("#" + this.options.district);
        this.street         = jQuery("#" + this.options.street);
        this.street_number  = jQuery("#" + this.options.street_number);
        this.post_code      = jQuery("#" + this.options.post_code);

        // create the google geocoder object
        this.geocoder = new google.maps.Geocoder();

        var point = new google.maps.LatLng(this.lat.val(), this.lng.val());

        var myOptions = {
            zoom: 15,
            center: point,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        // create the map
        this.map = new google.maps.Map(jQuery("#" + this.options.map).get(0), myOptions);

        // add the default location
        this.addMarker(point, this.address.val());
    }

    this.init();

    add_click_listener(this);
}

function set_from_components(components, myGmap) {
    myGmap.province.val('');
    myGmap.city.val('');
    myGmap.district.val('');
    myGmap.street.val('');
    myGmap.street_number.val('');
    myGmap.post_code.val('');

    for(var i = 0; i < components.length; i++) {
        if(components[i].types[0] == "street_number") {
            myGmap.street_number.val(components[i].long_name);
        } else if(components[i].types[0] == "route") {
            myGmap.street.val(components[i].long_name);
        } else if(components[i].types[0] == "sublocality") {
            myGmap.district.val(components[i].long_name);
        } else if(components[i].types[0] == "locality") {
            myGmap.city.val(components[i].long_name);
        } else if(components[i].types[0] == "administrative_area_level_1") {
            myGmap.province.val(components[i].long_name.toLowerCase());
        } else if(components[i].types[0] == "postal_code") {
            myGmap.post_code.val(components[i].long_name);
        }
    }
}

function add_move_listener(marker, myGmap) {
    google.maps.event.addListener(marker, "dragend", function(event) {
        myGmap.geocoder.geocode(
            {'latLng': event.latLng },
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        set_from_components(results[0].address_components, myGmap);
                        myGmap.map.setZoom(15);
                        myGmap.map.setCenter(event.latLng);

                        myGmap.marker.setTitle(results[0].formatted_address);

                        myGmap.address.val(results[0].formatted_address);
                        myGmap.lat.val(event.latLng.lat());
                        myGmap.lng.val(event.latLng.lng());
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            }
        );
    });
}

function add_click_listener(myGmap) {
    google.maps.event.addListener(myGmap.map, "click", function(event) {
        myGmap.geocoder.geocode(
            {'latLng': event.latLng },
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        set_from_components(results[0].address_components, myGmap);
                        myGmap.map.setZoom(15);
                        myGmap.map.setCenter(event.latLng);

                        myGmap.addMarker(event.latLng, results[0].formatted_address);

                        myGmap.address.val(results[0].formatted_address);
                        myGmap.lat.val(event.latLng.lat());
                        myGmap.lng.val(event.latLng.lng());
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            }
        );
    });

    // bind the click action on the lookup field
    myGmap.lookup.bind('click', function() {
        myGmap.geocoder.geocode(
            {'address': myGmap.address.val()},
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        set_from_components(results[0].address_components, myGmap);
                        myGmap.map.setZoom(15);
                        myGmap.map.setCenter(results[0].geometry.location);

                        myGmap.addMarker(results[0].geometry.location, results[0].formatted_address);

                        myGmap.address.val(results[0].formatted_address);
                        myGmap.lat.val(results[0].geometry.location.lat());
                        myGmap.lng.val(results[0].geometry.location.lng());
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            }
        );

        return false;
    });
}
