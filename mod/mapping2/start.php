<?php
	elgg_register_event_handler('init', 'system', 'mapping_init');
	
	
//	$results = file_get_contents('/CSVtoKML.php'); //load KML file
 	

function mapping_init() {
	elgg_register_page_handler('mapping', 'mapping_page_handler');
	
}

function mapping_page_handler() {
	
	$params = array(
	        'title' => 'Site Map',
        'content' => '
		<form>
		<h4>
		Select Research Site:</h4>
		<select id="sname">
		</select>
		<br>
		</form>
		<br>
		<div id="map"  style="height:400px;" > Map</div>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
async defer></script>
  
<script >
	$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "mod/mapping2/queryS.php",
        data: "",
         success: function (data) {
		 var tmp = data.split("\n");

        var selectValues={};

for (i=1;i<tmp.length;i++){
if (tmp[i]!="")
{
var str=tmp[i];
var ss=str.substring(1,str.length-1);
selectValues[i]=ss;
}

}
//alert(selectValues);

$.each(selectValues, function(key, value) {   
     $("#sname")
          .append($("<option>", { value : key })
          .text(value)
		  .val(value)
		  ); 
});

		},
      });




});

function scheduleA(event) {
  $.ajax({		 
        type: "POST",
        url: "mod/mapping2/queryLatLon.php",
		//dataType:"json",
		//var siteN=this.options[this.selectedIndex].text;
		//var result = siteN.substring(1, siteN.length-1);
		
        data: ({sitename:this.options[this.selectedIndex].text}),
         success: function (data) {
		 sitelatlon=data
		 var tmp=sitelatlon.split("\n");
		 var latlon=tmp[1];
		 var lat=latlon.split(",")[0];
		 var lon=latlon.split(",")[1];
		// alert(lat);


		},
      });
	  
   // alert(this.options[this.selectedIndex].text);
}


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
    document.getElementById("plat").value = event.latLng.lat();
    document.getElementById("plon").value = event.latLng.lng();
    });
	

$("#sname").change(function() {
 $.ajax({		 
        type: "POST",
        url: "mod/mapping2/queryLatLon.php",
		//dataType:"json",
		//var siteN=this.options[this.selectedIndex].text;
		//var result = siteN.substring(1, siteN.length-1);
		
        data: ({sitename:this.options[this.selectedIndex].text}),
         success: function (data) {
		 sitelatlon=data
		 var tmp=sitelatlon.split("\n");
		 var latlon=tmp[1];
		 var lat=latlon.split(",")[0];
		 var lon=latlon.split(",")[1];

		 var center = {lat: Number(lat), lng: Number(lon)};
		 map.setCenter(center);
		 addMarker(center);
		
		},
      });
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
	

?>