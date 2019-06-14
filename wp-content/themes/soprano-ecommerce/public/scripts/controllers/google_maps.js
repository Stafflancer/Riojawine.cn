/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Load google maps dependency
 ***********************************************/
(function ($) {
    'use strict';

    // stop loading if google api key is not set
    if (PZTJS.phpData('google_maps_api_key', null) === null) {
        return;
    }

    // check if google api is already loaded
    if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
        var g_api_url = 'https://maps.google.com/maps/api/js?key=' + PZTJS.phpData('google_maps_api_key');

        $.getScript(g_api_url, function() {
            $(window).trigger('pzt.google_maps_loaded');
        });
    } else {
        $(window).trigger('pzt.google_maps_loaded');
    }

})(jQuery);


/***********************************************
 * Google maps integration
 ***********************************************/
jQuery(window).one('pzt.google_maps_loaded', function() {
    'use strict';

    // proxy $ var
    var $ = jQuery;

    // select map placements
    var $mapPlaces = $('.sp-map-place');

    // map colour theme
    var gmapStyle = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#dddddd"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"dddddd"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#555555"},{"lightness":20}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#aaaaaa"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#f4f4f4"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#f4f4f4"},{"lightness":17},{"weight":1.2}]}];

    // default rewritable map options
    var mapDefaultOptions = {
        zoom                 : 16,
        center               : {lat: 40.731607, lng:-73.997038},
        disableDefaultUI     : false,
        scrollwheel          : false,
        draggable            : true,
        styles               : gmapStyle,
        mapTypeControl       : false,
        navigationControl    : false,
        mapTypeId            : 'roadmap'
    };

    // init maps
    $mapPlaces.each(function () {
        var $map = $(this);
        var mapObj = new google.maps.Map($map.get(0), mapDefaultOptions);
        $map.data('gmap-object', mapObj);
        $map.data('last-container-width', $map.outerWidth());
    });

    PZTJS.RAFit(function () {
        $mapPlaces.each(function () {
            var $map = $(this);
            if ($map.data('last-container-width') !== $map.outerWidth()) {
                google.maps.event.trigger($(this).data('gmap-object'), 'resize');
                $map.data('last-container-width', $map.outerWidth());
            }
        });
    });

    // equip geocoder
    $mapPlaces.filter('[data-address]').each(function() {
        var $map = $(this),
            mapObj = $map.data('gmap-object'),
            geocoder = new google.maps.Geocoder();

        if (!mapObj || !geocoder) {
            return;
        }

        geocoder.geocode({'address': $map.data('address')}, function (results, status) {
            if (status !== google.maps.GeocoderStatus.OK) {
                console.error('Google Maps are unable to find location: ' + $map.data('address'), status, results);
                return;
            }

            var result = results[0];
            mapObj.setCenter(result.geometry.location);

            var infowindow = new google.maps.InfoWindow({
                content: '<b>' +result.formatted_address + '</b>',
                size   : new google.maps.Size(150, 50)
            });

            var marker = new google.maps.Marker({
                position: result.geometry.location,
                map     : mapObj,
                icon    : PZTJS.phpData('assets_dir') + '/images/map-pin.png',
                title   : $map.data('address')
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(mapObj, marker);
            });
        });
    });

});