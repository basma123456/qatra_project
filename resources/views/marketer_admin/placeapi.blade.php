<!DOCTYPE html>
<!--
 @license
 Copyright 2019 Google LLC. All Rights Reserved.
 SPDX-License-Identifier: Apache-2.0
-->
<html>

<head>
    <title>Simple Markers</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
    <style>
        #map {
            height: 90%;
        }

        /*
 * Optional: Makes the sample page fill the window.
 */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    {!! $pagenext !!}
    <!--
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt1J8Sw2fZzmzKdBviTpL1biFzQv3-Ugg&callback=initMap&v=weekly"
        defer></script>

    <script>
        function initMap() {
            const myLatLng = {
                lat: {{ $lat }},
                lng: {{ $lng }}
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: myLatLng,
            });

            // new google.maps.Marker({
            //     position: myLatLng,
            //     map,
            //     title: "Hello World!",
            // });

            @foreach ($places as $place)
                new google.maps.Marker({
                    position: {
                        lat: {{ $place['lat'] }},
                        lng: {{ $place['lng'] }}
                    },
                    map,
                    title: "{{ $place['name'] }}",
                });
            @endforeach
        }
    </script>
</body>

</html>
