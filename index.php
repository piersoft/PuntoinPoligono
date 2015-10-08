<? php
ob_start();
$lat=$_GET['lat'];
$lon=$_GET['lon'];

 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Zona Tariffata by @opendataleccebot</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
</head>
<body onload="getLocation()">

<style>
.state {
  position:absolute;
  top:10px;
  right:10px;
  z-index:1000;
  }
  .state strong {
    background:#404040;
    color:#fff;
    display:block;
    padding:10px;
    border-radius:3px;
    }
</style>

<!--
  This example requires jQuery to load the file with AJAX.
  You can use another tool for AJAX.

  This pulls the file airports.csv, converts into into GeoJSON by autodetecting
  the latitude and longitude columns, and adds it to the map.

  Another CSV that you use will also need to contain latitude and longitude
  columns, and they must be similarly named.
-->

<script src='https://code.jquery.com/jquery-1.11.0.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-pip/v0.0.2/leaflet-pip.js'></script>
<div id='map'></div>
<div id='state' class='state'></div>
<script>
//var latphp = parseFloat('<?php printf($_GET['lat']); ?>');
//var lonphp = parseFloat('<?php printf($_GET['lon']); ?>');
var latphp="";
var lonphp="";

var x = document.getElementById("demo");
function getLocation() {

    if (navigator.geolocation ) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {

        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
  //  x.innerHTML = "Latitude: " + position.coords.latitude +
  //  "<br>Longitude: " + position.coords.longitude;
  latphp = parseFloat('<?php printf($_GET['lat']); ?>');
  lonphp = parseFloat('<?php printf($_GET['lon']); ?>');
  if (!latphp || 0 === latphp.length){
    latphp=position.coords.latitude;
    lonphp=position.coords.longitude;
  }else{

  }

    L.mapbox.accessToken = 'pk.eyJ1IjoicGllcnNvZnQiLCJhIjoiY2lmaDV6dmh1MDB0b3Rha25hb29rNzdlaSJ9.bTHBvonrul9yq3difBGJ-A';
    var state = document.getElementById('state');
    var map = L.mapbox.map('map', 'mapbox.emerald')
        .setView([40.3590, 18.1815], 15);

        $.ajax({
            url: 'sosta_lecce.geojson',
            dataType: 'json',
            success: function load(d) {
              var states = L.geoJson(d).addTo(map);


              console.log(latphp,lonphp);

              var marker =  L.marker([latphp,lonphp], {
                    icon: L.mapbox.marker.icon({
                        'marker-color': '#f86767'
                    }),
                    draggable: true
                }).addTo(map)


                  marker.on('move', function(e) {
                      var layer = leafletPip.pointInLayer(this.getLatLng(), states, true);
                      if (layer.length) {

                        state.innerHTML  = '<strong>' + layer[0].feature.properties.name + '</strong>';
                        state.innerHTML += '<strong>' + layer[0].feature.properties.description + '</strong>';
                        console.log(state.innerHTML);
      //                var element = document.getElementById("map");
      //                element.outerHTML = "";
      //                delete element;
                      } else {
                        state.innerHTML = '';
                      }
                  });




                  marker.setLatLng([latphp,lonphp]).update();

            }
        });

}

</script>
</body>
</html>
<? php

$html = ob_get_contents();
ob_end_clean();

//Just output
var_dump($html);

 ?>
