var map;
var marker;

function initMap() {
    var center = {
        lat: 12.865416,
        lng: -85.207229
    };
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: center
    });

    map.addListener('click', function(e) {
        var latLng = e.latLng;
        var lat = latLng.lat();
        var lng = latLng.lng();

        alert('Latitude: ' + lat + ', Longitude: ' + lng);

        if (marker) {
            marker.setPosition(latLng);
        } else {
            marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
        }
        document.getElementById('google_map_direction').value = lat + ', ' + lng;
    });
}

// Asignar la función a window
window.initMap = initMap;
