<template>
    <div id="map"></div>
</template>
<script>
    import GoogleMapsLoader from '../maps';
    export default {
        name: 'mapa',
        props: {
            coordenadas: {
                type: Array,
                default: () => [],
            },
            type: {
                validator: function (value) {
                    return ['heatmap', 'marker'].indexOf(value) !== -1
                }
            }
        },

        mounted: function () {
            GoogleMapsLoader.load(google => {
                let map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: {lat: -24.04154589215009, lng: -52.3780561654537},
                    scrollwheel: false,
                    mapTypeId: 'satellite'
                });

            if (this.coordenadas !== undefined) {

                for (let index in this.coordenadas) {
                    this.coordenadas[index] = new google.maps.LatLng(
                        this.coordenadas[index].latitude,
                        this.coordenadas[index].longitude
                    )
                }

                if (this.type == 'heatmap') {
                    new google.maps.visualization.HeatmapLayer({
                        data: this.coordenadas,
                        map: map,
                        radius: 10
                    });
                }

                if (this.type == 'marker') {
                    for (var index in this.coordenadas) {
                        new google.maps.Marker({
                            position: this.coordenadas[index],
                            map: map,
                        });
                    }
                }
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