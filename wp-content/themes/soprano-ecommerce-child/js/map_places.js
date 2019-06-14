
// var map;
  var markersArray = [];
  var infowindow;
  var places = [];

//   var geocoder;
   function initialize()
   {
        geocoder = new google.maps.Geocoder();

        if( document.getElementById('map_canvas_city') !== null ){

          var lat = jQuery('#map_canvas_city_lat').val();
          var lng = jQuery('#map_canvas_city_lng').val();

          var latlng = new google.maps.LatLng(lat, lng);

          var myOptions = {
             zoom: 16,
             center: latlng,
             mapTypeId: google.maps.MapTypeId.ROADMAP,            
      
          };

            map_city = new google.maps.Map(document.getElementById('map_canvas_city'), myOptions);
        }

        

        var lat = jQuery('#lat').val();
        var lng = jQuery('#lng').val();

        var latlng = new google.maps.LatLng(lat, lng);
        infowindow = new google.maps.InfoWindow({
        	maxWidth: 350,
        	maxHeight: 200
        	});

        var myOptions = {
             zoom: 16,
             center: latlng,
             mapTypeId: google.maps.MapTypeId.ROADMAP,            
      
        };
        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);


        var styles = {
          default: null,
          hide: [
            {
              featureType: 'poi.business',
              stylers: [{visibility: 'off'}]
            },
            {
              featureType: 'transit',
              elementType: 'labels.icon',
              stylers: [{visibility: 'off'}]
            }
          ]
      };
      map.setOptions( {styles: styles['hide']} );



       var markers = [];
    // Create the search box and link it to the UI element.
       var input = /** @type {HTMLInputElement} */(
           document.getElementById('pac-input'));
       map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

       var searchBox = new google.maps.places.SearchBox( (input) );

       // [START region_getplaces]       
       // [END region_getplaces]

       function codeAddress(address) {
        //In this case it gets the address from an element on the page, but obviously you  could just pass it to the method instead
        //var address = document.getElementById("address").value;

        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            //In this case it creates a marker, but you can get the lat and lng from the location.LatLng
            map.setCenter(results[0].geometry.location);
            var bounds = new google.maps.LatLngBounds();
            var image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                  };
           var marker = new google.maps.Marker({
               map: map, 
               icon: image,
               tittle: '',
               position: results[0].geometry.location
           });
          markers.push(marker);
          bounds.extend(results[0].geometry.location);
            map.fitBounds(bounds);
           // map.setZoom(2);
            $('#div-no-results').hide();
          } else {
            //alert("Geocode was not successful for the following reason: " + status);
           $('#div-no-results').show();
          }
        });
      }   
       
      jQuery(document).ready(function($){

          var place_types = ['restaurants', 'hotels'];
          searchPlaces(place_types);
            

      });
       
       jQuery("#checkboxmunicipios").change(function() {

          var mapFilters = getMapFilters();
          searchPlaces( mapFilters );
      });
       jQuery("#checkboxrestaurantes").change(function() {
        
          var mapFilters = getMapFilters();
          searchPlaces( mapFilters );
      });
       jQuery("#checkboxalojamientos").change(function() {
        
          var mapFilters = getMapFilters();
          searchPlaces( mapFilters );
      });

       function searchPlaces( place_types ){

          
          if( places.length > 0 ){
              
              deleteOverlays();

            for (var i = 0; i < places.length; i++) {

                if (  place_types.includes( places[i]['type'] ) ){

                    console.log( places[i]['name'] );
                    
                    placeMarker( places[i] );  
                }

            }


          }else{

            // if( jQuery('#places_data').val().length ){
            //     places = JSON.parse(jQuery('#places_data').val());  
            //     for (var i = 0; i < places.length; i++) {

            //          console.log( places[i]['name'] );

            //           placeMarker( places[i] );
            //     }
            // }
            
           
            var parametros = {
                     security : MyAjax.security,
                     action: 'search_closeness_companies',
                  closeness : true,
                  lat : 42.466778400000000,
                  lng : -2.562567199999990,                  
                  place_types: place_types
            };

            jQuery.post(MyAjax.ajaxurl, parametros, function(response) {
                  
                  // alert('Got this from the server: ' + response);
                  places = JSON.parse(response);
                  // console.log(JSONObject);      // Dump all data of the Object in the console
                  // alert(JSONObject[0]["name"]); // Access Object data

                  // first remove all markers if there are any
                  deleteOverlays();

                  for (var i = 0; i < places.length; i++) {

                      console.log( places[i]['name'] );

                      placeMarker( places[i] );
                  }

            });
          }

            
       }


       function getMapFilters(){
              
              var place_types = [];


            if( jQuery("#checkboxmunicipios").is(':checked') ){
                place_types.push('cities');
            }
            if( jQuery("#checkboxrestaurantes").is(':checked') ){
                place_types.push('restaurants'); 
            }
            if ( jQuery("#checkboxalojamientos").is(':checked') ){
                place_types.push('hotels'); 
            }

            return place_types;

       }

       
       // Bias the SearchBox results towards places that are within the bounds of the
       // current map's viewport.
       google.maps.event.addListener(map, 'bounds_changed', function(event) {
         var bounds = map.getBounds();
         searchBox.setBounds(bounds);
       });

       function stopRKey(evt) { 
         var evt = (evt) ? evt : ((event) ? event : null); 
         var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
         if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
       } 

       document.onkeypress = stopRKey; 
      
       google.maps.event.addListenerOnce(map, 'idle', function() {
        google.maps.event.trigger(map, 'resize');
    });
   }
   
   function placeMarker( place ) {
       
       var location = new google.maps.LatLng( place['lat'], place['lng'] )
       var url_image = '';

       if( place['type'] == 'restaurants' ){
   
          url_image = 'https://www.riojawine.com/wp-content/themes/soprano-ecommerce-child/img_bodegas/restaurantes-pin-map.png'
        }else if( place['type'] == 'hotels' ){
          url_image = 'https://www.riojawine.com/wp-content/themes/soprano-ecommerce-child/img_bodegas/alojamientos-pin-map.png';
       }

       var image = {
                    url: url_image,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(48, 48)
                  };

       var marker = new google.maps.Marker({
           position: location, 
           map: map,
           icon: image,
           title: place['name']
       });

       // add marker in markers array
       markersArray.push(marker);

       //map.setCenter(location);

       var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '<img src="'+ place['url_logo'] +'">'+
            '</div>'+
              
              '<div id="bodyContent">'+
                '<h1 id="firstHeading" >'+ place['name'] +'</h1>'+
                '<p class="bodyContentEtiqueta">Dirección</p>'+
                '<p class="bodyContentAddress">'+ place['address'] + ', ' + place['city'] +'</p>'+
              '</div>'+
            '</div>';

       google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent( contentString );
          infowindow.open(map, this);
        });
   }
   
	// '<a href="mailto:'+ place['email'] +'" title="'+ place['email'] +'" target="_blank"><span class="bodyContentEmail">'+ place['email'] +'</span></a></br>'+

   
   // Deletes all markers in the array by removing references to them
   function deleteOverlays() {
       if (markersArray) {
           for (i in markersArray) {
               markersArray[i].setMap(null);
           }
            markersArray.length = 0;
       }
   }
