<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'insertsite_init');




function insertsite_init() {



	
		$url = 'http://jquery-csv.googlecode.com/git/src/jquery.csv.js';
	elgg_register_js('jquery-csv', $url);
	elgg_register_page_handler('insertsite', 'insertsite_page_handler');




	
}


function insertsite_page_handler() {



elgg_load_js('jquery-csv');



$params = array(
        'title' => 'Insert Site',
        'content' => '
				<style>
		
		.result {
width:100%;
overflow:auto;
 border-style: solid;
border:1px !important;
}



td {
  padding:5px !important;
}
</style>
		<h3>Insert Site</h3><br>
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
	var data2=[];
	$("#run").bind("click", function() {
	upload();

    });
	});
	
	var data2=[];
	function upload(){
	
	var sname=document.getElementById("sname").value;
	var slat=document.getElementById("slat").value;
	var slon=document.getElementById("slon").value;

	var flag=0; 	
	if (sname == null || sname == "") {
    //    alert("Plot Name must be filled out");
        flag=1;
    }
	if (slat == null || slat == "") {
     //   alert("Plot Latitude must be filled out");
        flag=1;
    }
	if (slon == null || slon == "") {
    //    alert("Plot Longitude must be filled out");
        flag=1;
    }
	if (flag==0)
	{

	var newdata="";   
for (i=0;i<data2.length;i++){
var strdata=data2[i].toString();
var strdata=strdata.concat(";")
newdata=newdata.concat(strdata);
}
	//alert(newdata);
      		$.ajax({
  type: "POST",
  url: "mod/insertS/upload2.php",
  data: {data:newdata}, 
  success: function (data) {
           $(".view").html(data);
		  
         }, 
});
}
else
	alert("Please Refill the form!");
	}
	
	function example(){
		
	var sname=document.getElementById("sname").value;
	var slat=document.getElementById("slat").value;
	var slon=document.getElementById("slon").value;
	var data1=sname+","+slat+","+slon;	
	 	
	var flag=0; 	
	if (sname == null || sname == "") {
    //    alert("Plot Name must be filled out");
        flag=1;
    }
	if (slat == null || slat == "") {
     //   alert("Plot Latitude must be filled out");
        flag=1;
    }
	if (slon == null || slon == "") {
    //    alert("Plot Longitude must be filled out");
        flag=1;
    }
	if (flag==0)
	{
	
	data2.push([sname,slat,slon]);
	
	
	
    var html = generateTable(data2);
	   $("#result1").empty();
    $("#result1").html(html);
	
	}
	else
	alert("Information is incomplete!");
	
	}
		function generateTable(data) {
    var html = "<caption><b>Site Table</b></caption><tr><td>Site Name</td><td>Site Longitude</td><td>Site Latitude</td></tr>";

    if(typeof(data[0]) === "undefined") {
      return null;
    }

    if(data[0].constructor === String) {
      html += "<tr>\r\n";
      for(var item in data) {
        html += "<td>" + data[item] + "</td>\r\n";
      }
      html += "</tr>\r\n";
    }

    if(data[0].constructor === Array) {
      for(var row in data) {
        html += "<tr>\r\n";
        for(var item in data[row]) {
          html += "<td>" + data[row][item] + "</td>\r\n";
        }
        html += "</tr>\r\n";
      }
    }

    if(data[0].constructor === Object) {
      for(var row in data) {
        html += "<tr>\r\n";
        for(var item in data[row]) {
          html += "<td>" + item + ":" + data[row][item] + "</td>\r\n";
        }
        html += "</tr>\r\n";
      }
    }
    
    return html;
  }
	
	</script>
	<br>
<div id="map"  style="height:200px;" > Map</div>

<div class=result>
      <table id=result1></table>
    </div>
	<br/>
	<input id=run type=button value="Upload to Scidrive" />
	<div class="view">
	
	
	</div>
	

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




