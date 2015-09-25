<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'insertsite_init');




function insertsite_init() {



	
	elgg_register_page_handler('insertsite', 'insertsite_page_handler');




	
}


function insertsite_page_handler() {





//$response = file_get_contents('http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20*%20from%20DecompSample%20where%20CollectionDate%20=%20%273/24/2014%27&format=csv');

//echo $response;



$params = array(
        'title' => 'Insert Site',
        'content' => '<h3>Insert Site</h3><br>
		<form>
		Site Name:<input type="text" name="sname" id="sname">
		<br>

		Site Latitude:<input type="text" name="slat" id="slat">
		<br>
		Site Longitude:<input type="text" name="slon" id="slon">
		<br>
		
		<input id=run3 type=button value="Insert" />
		
		</form>
		
		
		<script type="text/javascript">
		
		$(document).ready(function() {
    
	 $("#run3").bind("click", function() {
     
      example();
    });
	});
	
	function example(){
		
		
	 	
	var sname=document.getElementById("sname").value;
	var slat=document.getElementById("slat").value;
	var slon=document.getElementById("slon").value;
	

        $.post("mod/insertS/add.php",{sname:sname,slat:slat, slon:slon},function(data){
            alert(data);
			 $(".view").html(data);
        });
		
		
	
		
    
	}
	
	</script>











	<br>
<div id="map"  style="height:200px;" > Map</div>

<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
async defer></script>
<script >

var map;
var marker;

function initMap() {
  var center = {lat: 39.2833, lng: -76.6167};
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: center,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });
  addMarker(center);
  map.addListener("click", function(event) {
    marker.setMap(null);
    addMarker(event.latLng);
    //alert("Lat:" + event.latLng.lat() +  event.latLng.lng());
    document.getElementById("slat").value = event.latLng.lat();
    document.getElementById("slon").value = event.latLng.lng();
    });
}

function addMarker(location) {
   marker = new google.maps.Marker({
    position: location,
    map: map
  });
}



</script>








	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




