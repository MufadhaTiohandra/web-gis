<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maps-Webgis</title>
    <?= $this->include('templates/header'); ?>
</head>
<body>
    <?= $this->include('templates/navbar'); ?>
    <section class="maps-section section-padding">
        <div class="container">
            <div class="row">
                
<!-- ./maps -->
<div class="content">  
     <div id="map" style="height: 750px;
        width: 100%;
        max-width: 1200px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        overflow: hidden";></div>  
</div>  
<script>  

var prov = new L.LayerGroup();
var faskes = new L.LayerGroup();
var sungai = new L.LayerGroup()
var provin = new L.LayerGroup();
var laundry = new L.LayerGroup();
var jalan_ciputat = new L.LayerGroup();
var kelurahan = new L.LayerGroup();

var map = L.map('map', {  
    center: [-1.7912604466772375, 116.42311966554416],  
    zoom: 5,
    zoomControl: false,  
    layers:[]  
});
// map.setView([ -6.3066557, 106.7536211], 14)


var GoogleSatelliteHybrid= L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {  
        maxZoom: 22,  
        attribution: 'Latihan Web GIS'  
        }).addTo(map); 

var Esri_NatGeoWorldMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; National Geographic, Esri, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC', 
        maxZoom: 16});
var GoogleMaps = new L.TileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', { 
        opacity: 1.0, 
        attribution: 'Latihan Web GIS'  
    }); 

var GoogleRoads = new L.TileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}',{  
        opacity: 1.0,  
        attribution: 'Latihan Web GIS'  
    });

var baseLayers = { 
        'Google Satellite Hybrid': GoogleSatelliteHybrid, 
        'Esri_NatGeoWorldMap':Esri_NatGeoWorldMap, 
        'GoogleMaps':GoogleMaps,
        'GoogleRoads':GoogleRoads,
    };   


var groupedOverlays = {
  "Web-GIS":{
    'Laundry':laundry,
    'Jalan Ciputat':jalan_ciputat,
    'Kelurahan Ciputat Timur':kelurahan
  }
};

// var overlayLayers = {}  
// L.control.layers(baseLayers, overlayLayers, {collapsed: true}).addTo(map); 
L.control.groupedLayers(baseLayers, groupedOverlays).addTo(map); 



var osmUrl='https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';  
var osmAttrib='Map data &copy; OpenStreetMap contributors';  
var osm2 = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 13, attribution: osmAttrib });  
var rect1 = {color: "#ff1100", weight: 3};  
var rect2 = {color: "#0000AA", weight: 1, opacity:0, fillOpacity:0};  
var miniMap = new L.Control.MiniMap(osm2, {toggleDisplay: true, position : "bottomright", aimingRectOptions : rect1, shadowRectOptions: rect2}).addTo(map);

L.Control.geocoder({position :"topleft", collapsed:true}).addTo(map); 

/* GPS enabled geolocation control set to follow the user's location */  
var locateControl = L.control.locate({  
 position: "topleft", 
drawCircle: true,  
follow: true,  
setView: true, 
keepCurrentZoomLevel: true, 
markerStyle: { 
weight: 1, 
opacity: 0.8, 
fillOpacity: 0.8 
 }, 
circleStyle: { 
weight: 1, 
clickable: false 
 }, 
 icon: "fa fa-location-arrow", 
 metric: false, 
 strings: { 
 title: "My location", 
 popup: "You are within {distance} {unit} from this point", 
 outsideMapBoundsMsg: "You seem located outside the boundaries of the map" 
 }, 
 locateOptions: { 
 maxZoom: 18, 
 watch: true, 
 enableHighAccuracy: true, 
 maximumAge: 10000, 
 timeout: 10000 
 } 
}).addTo(map); 

var zoom_bar = new L.Control.ZoomBar({position: 'topleft'}).addTo(map); 

L.control.coordinates({
	position:"bottomleft", //optional default "bootomright"
	decimals:2, //optional default 4
	decimalSeperator:".", //optional default "."
	labelTemplateLat:"Latitude: {y}", //optional default "Lat: {y}"
	labelTemplateLng:"Longitude: {x}", //optional default "Lng: {x}"
	enableUserInput:true, //optional default true
	useDMS:false, //optional default false
	useLatLngOrder: true, //ordering of labels, default false-> lng-lat
	markerType: L.marker, //optional default L.marker
	markerProps: {}, //optional default {},
	labelFormatterLng : function(lng){return lng+" lng"}, //optional default none,
	labelFormatterLat : function(lat){return lat+" lat"}, //optional default none
	customLabelFcn: function(latLonObj, opts) { "Geohash: " + encodeGeoHash(latLonObj.lat, latLonObj.lng)} //optional default none
}).addTo(map);

L.control.scale({
  metrics: true,
  position: 'bottomleft'
}).addTo(map);

var north = L.control({position: "bottomleft"});  

north.onAdd = function(map) {  
 var div = L.DomUtil.create("div", "info legend"); 
 div.innerHTML = '<img src="<?=base_url()?>/template/dist/img/arah-mata-angin.png" style=width:200px;>'; 
 return div; } 

north.addTo(map); 

$.getJSON('<?=base_url()?>template/dist/provinsi.geojson', function(data) {
    console.log(data);
    if (data) {
        var ratIcon = L.icon({  
            iconUrl: '<?=base_url()?>template/dist/img/marker.png',  
            iconSize: [25, 25]  
        });  
        // Create markers from GeoJSON
        L.geoJson(data, {  
            pointToLayer: function(feature, latlng) {  
                var marker = L.marker(latlng, { icon: ratIcon });  
                marker.bindPopup(feature.properties.CITY_NAME);  
                return marker;  
            }  
        }).addTo(prov);  
    } else {
        console.error("GeoJSON data is empty or not loaded correctly.");
    }
});

$.getJSON("<?=base_url()?>template/dist/rsu.geojson",function(data){  
 var ratIcon = L.icon({ 
 iconUrl: '<?=base_url()?>template/dist/img/hospital.png', 
 iconSize: [12,10] 
 }); 
 L.geoJson(data,{ 
 pointToLayer: function(feature,latlng){ 
 var marker = L.marker(latlng,{icon: ratIcon}); 
 marker.bindPopup(feature.properties.NAMOBJ); 
 return marker; 
 } 
 }).addTo(faskes); 
 });

 $.getJSON("<?=base_url()?>template/dist/puskesmas.geojson",function(data){  
 var ratIcon = L.icon({ 
 iconUrl: '<?=base_url()?>template/dist/img/hospital.png', 
 iconSize: [12,10] 
 }); 
 L.geoJson(data,{ 
 pointToLayer: function(feature,latlng){ 
 var marker = L.marker(latlng,{icon: ratIcon}); 
 marker.bindPopup(feature.properties.NAMOBJ); 
 return marker; 
 } 
 }).addTo(faskes); 
 });

 $.getJSON("<?=base_url()?>template/dist/poliklinik.geojson",function(data){  
 var ratIcon = L.icon({ 
 iconUrl: '<?=base_url()?>template/dist/img/hospital.png', 
 iconSize: [12,10] 
 }); 
 L.geoJson(data,{ 
 pointToLayer: function(feature,latlng){ 
 var marker = L.marker(latlng,{icon: ratIcon}); 
 marker.bindPopup(feature.properties.NAMOBJ); 
 return marker; 
 } 
 }).addTo(faskes); 
 });

 $.getJSON("<?=base_url()?>template/dist/sungai.geojson",function(kode){  
 L.geoJson( kode, { 
 style: function(feature){ 
 var color, 
 kode = feature.properties.kode; 
 if ( kode < 2 ) color = "#f2051d"; 
 else if ( kode > 0 ) color = "#f2051d"; 
 else color = "#f2051d"; // no data 
 return { color: "#999", weight: 5, color: color, fillOpacity: .8 }; 
 }, 
 onEachFeature: function( feature, layer ){ 
 layer.bindPopup 
 () 
 } }).addTo(sungai); 
 }); 

 $.getJSON("<?=base_url()?>template/dist/provinsi_polygon.geojson",function(kode){ 
    L.geoJson( kode, { 
      style: function(feature){ 
        var fillColor, 
            kode = feature.properties.kode; 
        if ( kode > 21 ) fillColor = "#006837";       
        else if (kode>20) fillColor="#fec44f" 
        else if (kode>19) fillColor="#c2e699" 
        else if (kode>18) fillColor="#fee0d2" 
        else if (kode>17) fillColor="#756bb1" 
        else if (kode>16) fillColor="#8c510a" 
        else if (kode>15) fillColor="#01665e" 
        else if (kode>14) fillColor="#e41a1c" 
        else if (kode>13) fillColor="#636363" 
        else if (kode>12) fillColor= "#762a83" 
        else if (kode>11) fillColor="#1b7837" 
        else if (kode>10) fillColor="#d53e4f" 
        else if (kode>9) fillColor="#67001f" 
        else if (kode>8) fillColor="#c994c7" 
        else if (kode>7) fillColor="#fdbb84" 
        else if (kode>6) fillColor="#dd1c77" 
        else if (kode>5) fillColor="#3182bd" 
        else if ( kode > 4 ) fillColor ="#f03b20" 
        else if ( kode > 3 ) fillColor = "#31a354"; 
        else if ( kode > 2 ) fillColor = "#78c679"; 
        else if ( kode > 1 ) fillColor = "#c2e699"; 
        else if ( kode > 0 ) fillColor = "#ffffcc"; 
        else fillColor = "#f7f7f7";  // no data 
        return { color: "#999", weight: 1, fillColor: fillColor, fillOpacity: .6 }; 
      }, 
      onEachFeature: function( feature, layer ){ 
        layer.bindPopup(feature.properties.PROV) 
      } 
    }).addTo(provin); 
  });

  $.getJSON('<?=base_url()?>template/dist/laundry_ciputat.geojson', function(data) {
    if (data) {
        var ratIcon = L.icon({  
            iconUrl: '<?=base_url()?>template/dist/img/laundry.png',  
            iconSize: [30, 30]  
        });  
        // Create markers from GeoJSON
        L.geoJson(data, {  
            pointToLayer: function(feature, latlng) {  
                var marker = L.marker(latlng, { icon: ratIcon });
                var img_path = "<?=base_url()?>assets/img/"+feature.properties.img;  
                marker.bindPopup(`
                <img src=${img_path} width="200px"><br><br>
                <b>${feature.properties.Nama}</b>
                `);  
                return marker;  
            }  
        }).addTo(laundry);  
    } else {
        console.error("GeoJSON data is empty or not loaded correctly.");
    }
});

$.getJSON("<?=base_url()?>template/dist/jalan_ciputat.geojson",function(data){  
 L.geoJson( data, { 
 style: function(feature){ 
 return { color: "#ebde34", weight: 5, fillOpacity: .8 }; 
 }, 
 onEachFeature: function( feature, layer ){ 
 layer.bindPopup 
 () 
 } }).addTo(jalan_ciputat); 
 }); 

 $.getJSON("<?=base_url()?>template/dist/kelurahan_ciputat.geojson",function(kode){ 
    L.geoJson( kode, { 
      style: function(feature){ 
        var fillColor, 
            kode = feature.properties.kode; 
        if ( kode == 3 ) fillColor = "#006837";     
        else if (kode==2) fillColor="#fec44f"  ;
        else fillColor = NaN
      
        return { color: "#999", weight: 1, fillColor: fillColor, fillOpacity: .6 }; 
      }, 
      onEachFeature: function( feature, layer ){ 
        layer.bindPopup(feature.properties.NAME_4) 
      } 
    }).addTo(kelurahan); 
  });

  </script>

            </div>
        </div>

    </section>

    <?= $this->include('templates/footer'); ?>
</body>
</html>