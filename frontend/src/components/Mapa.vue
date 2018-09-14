<template>
    <div id="map"></div>
</template>
<script>
    export default {
        name: 'mapa',
        mounted: function () {
            let GoogleMapsLoader = require('google-maps'); // only for common js environments

            GoogleMapsLoader.LIBRARIES = ['visualization'];
            GoogleMapsLoader.KEY = 'AIzaSyA-V7KWkNL9nfqSqW3bDJqgdQAjiTLBnA0';
            GoogleMapsLoader.load(function(google) {
                let map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: {lat: -24.04154589215009, lng: -52.3780561654537},
                    scrollwheel: false,
                    mapTypeId: 'satellite'
                });

                new google.maps.visualization.HeatmapLayer({
                    data: getPoints(),
                    map: map,
                    radius: 10
                });

                function getPoints() {
                    return [
                        new google.maps.LatLng(-24.04086982060015, -52.377187129732874),
                        new google.maps.LatLng(-24.041173563330954, -52.37754118132284),
                        new google.maps.LatLng(-24.04135972787545, -52.37784158873251),
                        new google.maps.LatLng(-24.04154589215009, -52.3780561654537),
                        new google.maps.LatLng(-24.041683065653473, -52.3780561654541),
                        new google.maps.LatLng(-24.04191821988987, -52.37863352260092),
                        new google.maps.LatLng(-24.04236893097285, -52.37912704905966),
                        new google.maps.LatLng(-24.042800044441783, -52.37976877922324)

                    ];
                }
            });
        }
    }


</script>
<style>
    #map {
        height: 300px;
    }
</style>