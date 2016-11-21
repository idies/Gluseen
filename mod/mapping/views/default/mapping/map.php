
 <div id="map_canvas" style="width:100%; height:400px"></div>
	
	
	<script src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyA6Wy3kEdQTHHMnHsFJOuRA4YtMvIoHaKY"
  async defer></script>

<script>
var map;

var src3 = 'http://scitest09.pha.jhu.edu/elgg/baltimoresite.kml?key=' + Math.random();

/**
 * Initializes the map and calls the function that creates polylines.
 */
function initialize() {
  map = new google.maps.Map(document.getElementById('map_canvas'), {
    center: new google.maps.LatLng(30.65080, -33.20241),
    zoom: 2,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });

  loadKmlLayer(src3, map);
}
function loadKmlLayer(src, map) {
   kmlLayer = new google.maps.KmlLayer(src, 
    { suppressInfoWindows: false,
      preserveViewport: true, //map isn't centered and zoomed
            map: map }
  );
  
}
 
  

/**
 * Adds a KMLLayer based on the URL passed. Clicking on a marker
 * results in the balloon content being loaded into the right-hand div.
 * @param {string} src A URL for a KML file.
 */
/* function loadKmlLayer(src, map) {

  var kmlLayer = new google.maps.KmlLayer(src, {
    suppressInfoWindows: true,
    preserveViewport: false,
    map: map
	
  });
  google.maps.event.addListener(kmlLayer, 'click', function(event)
  {
    var content = event.featureData.infoWindowHtml;
    var testimonial = document.getElementById('capture');
    testimonial.innerHTML = content;

  });

}
*/
google.maps.event.addDomListener(window, 'load', initialize); 

</script>
	
	
	
