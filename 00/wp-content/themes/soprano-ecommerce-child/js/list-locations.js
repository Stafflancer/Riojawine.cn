var map;
var bounds;
var infowindow;
function drawMap() {

    // locations = document.getElementById("locations");
    var centerMap = new google.maps.LatLng(42.461938, -2.439179);

    var myOptions = {
        zoom: 10,
        center: centerMap,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: true,
        fullscreenControl: false
    }

    infowindow = new google.maps.InfoWindow({
        maxWidth: 350,
        maxHeight: 200
        });

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    setMarkers(LOCATIONS);

    center = bounds.getCenter();
    map.setCenter(center);

    if( LOCATIONS.length == 1){

        map.setZoom(12);
    }else{

        map.fitBounds(bounds);
    }
}

function setMarkers(locations) {
    bounds = new google.maps.LatLngBounds();

    for (i = 0; i < locations.length; i++) {

        var location = locations[i];

        placeMarker(location);
    }

}

function placeMarker( location ) {

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(location.lat, location.lng),
        // icon: markerIcon,
        title: location.name,
        map: map
    });

    var contentString = '';

    contentString = '<div id="content">'+
         '<div id="siteNotice">'+
         '<img src="'+ location.image +'">'+
         '</div>'+
           '<div id="bodyContent">'+
             '<h1 id="firstHeading" >'+ location.name +'</h1>';

        if( location.email !== undefined || location.phone !== undefined ){
                 contentString += '<p class="bodyContentEtiqueta"></p>';

                 if( location.description !== undefined ){

                     contentString += '<p class="bodyContentAddress">'+ location.description +'</p>';
                 }
                 if( location.phone !== undefined ){

                     contentString += '<p class="bodyContentAddress">'+ location.phone +'</p>';
                 }

        }



        contentString += '</div>'+
                        '</div>';

    google.maps.event.addListener(marker, 'click', function() {
       infowindow.setContent( contentString );
       infowindow.open(map, this);
     });

    //extend the bounds to include each marker's position
    bounds.extend(marker.position);
}
