<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'insertplot_init');




function insertplot_init() {




	
	elgg_register_page_handler('insertplot', 'insertplot_page_handler');




	
}


function insertplot_page_handler() {






$params = array(
        'title' => 'Create Plot Table',
        'content' => '<h3>Create Plot Table</h3><br>
		<form>
		
		Site Name:
		<select id="sname">
		</select>
		<br>
		Plot Name:<input type="text" name="pname" id="pname">
		<br>
		Plot Latitude:<input type="text" name="plat" id="plat">
		<br>
		Plot Longitude:<input type="text" name="plon" id="plon">
		<br>
		Habitat Type:
		<select id="habitatID">
        </select>
		<br>
		<button>Insert</button>
		</form>
		
	<div class="view">
	
	
	</div>

 
	
	<script type="text/javascript">

	
	$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "/mod/insert/queryH.php",
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
     $("#habitatID")
          .append($("<option>", { value : key })
          .text(value)
		  .val(value)
		  ); 
});

		},
      });



		//selectValues = { "1": "test 1", "2": "test 2" };

});

	$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "/mod/insert/queryS.php",
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



		//selectValues = { "1": "test 1", "2": "test 2" };

});



 $("button").click(function(){
	 	
	var pid=document.getElementById("pid").value;
	var sname=document.getElementById("sname").value;
	var pname=document.getElementById("pname").value;
	var plat=document.getElementById("plat").value;
	var plon=document.getElementById("plon").value;
	var hid=document.getElementById("habitatID").value;
	 alert(hid);
        $.post("mod/insert/add.php",{sname:sname,pname:pname,plat:plat, plon:plon, hid:hid},function(data){
            alert(data);
			 $(".view").html(data);
        });
		
		
	
		
    });
	


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
    document.getElementById("plat").value = event.latLng.lat();
    document.getElementById("plon").value = event.latLng.lng();
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




