/* =========================================
 * Google Maps
 *  =======================================*/
(function($) {
    function GoogleMapAPI(options) {
        this.options = $.extend({
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }, options);
        this.init();
    }

    GoogleMapAPI.prototype = {
        init: function() {
            this.findStructure();
            this.getInfoWindowContent();
            this.createMap();
            this.createMarker();
            this.createInfoWindow();
        },

        findStructure: function() {
            this.container = $(this.options.container);
            this.lat = parseFloat(this.container.attr('data-lat'));
            this.lng = parseFloat(this.container.attr('data-lng'));
            this.coords = new google.maps.LatLng(this.lat, this.lng);
            this.zoom = parseInt(this.container.attr('data-zoom'));
            this.infoWindowContent = this.container.find('.map-info');
            this.mapOptions = {
                mapTypeId: this.options.mapTypeId,
                panControl: this.options.panControl,
                zoomControl: this.options.zoomControl,
                streetViewControl: this.options.streetViewControl,
                mapTypeControl: this.options.mapTypeControl,
                center: this.coords,
                scrollwheel: this.options.scrollwheel,
                zoom: this.zoom
            };
        },

        getInfoWindowContent: function() {
            this.infoWindowContent = this.container.find(this.options.mapInfoContent);
        },

        createMap: function() {
            this.map = new google.maps.Map(this.container.get(0), this.mapOptions);
        },

        createMarker: function() {
            this.marker = new google.maps.Marker({
                icon: this.options.marker,
                position: this.coords
            });

            this.marker.setMap(this.map);
        },

        createInfoWindow: function() {
            var self = this;
            this.infoWindow = new google.maps.InfoWindow({
                content: this.infoWindowContent.get(0)
            });
            this.marker.addListener('click', function() {
                self.infoWindow.open(self.map, self.marker);
            })
        }
    };

    $.fn.googleMapAPI = function(opt) {
        return this.each(function() {
            $(this).data('GoogleMapAPI', new GoogleMapAPI($.extend(opt, {container: this})));
        });
    };
}(jQuery));

// GoogleMap init
function initGoogleMap() {
    jQuery('.map-holder').googleMapAPI({
        marker: 'img/marker.png',
        mapInfoContent: '.map-info',
        streetViewControl: false,
        mapTypeControl: false,
        scrollwheel: false,
        panControl: false,
        zoomControl: false
    });
}

$(function(){

    if($('.map-holder').length){
        initGoogleMap();
    }

});