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
		<input id=run3 type=button value="Insert" />
		</form>
		


 
	
	<script type="text/javascript">

	
	$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "mod/insert/queryH.php",
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


$.each(selectValues, function(key, value) {   
     $("#habitatID")
          .append($("<option>", { value : key })
          .text(value)
		  .val(value)
		  ); 
});

		},
      });

	
	  
});

	$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "mod/insert/queryS.php",
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
	var pname=document.getElementById("pname").value;
	var plat=document.getElementById("plat").value;
	var plon=document.getElementById("plon").value;
	var habitatID=document.getElementById("habitatID").value;
	

	
	var flag=0; 	
	if (pname == null || pname == "") {
    //    alert("Plot Name must be filled out");
        flag=1;
    }
	if (plat == null || plat == "") {
     //   alert("Plot Latitude must be filled out");
        flag=1;
    }
	if (plon == null || plon == "") {
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
  url: "mod/insert/upload.php",
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
	var pname=document.getElementById("pname").value;
	var plat=document.getElementById("plat").value;
	var plon=document.getElementById("plon").value;
	var habitatID=document.getElementById("habitatID").value;
	var flag=0; 	
	if (pname == null || pname == "") {
    //    alert("Plot Name must be filled out");
        flag=1;
    }
	if (plat == null || plat == "") {
     //   alert("Plot Latitude must be filled out");
        flag=1;
    }
	if (plon == null || plon == "") {
    //    alert("Plot Longitude must be filled out");
        flag=1;
    }
	
	if (flag==0)
	{
			      		$.ajax({
  type: "POST",
  url: "mod/insert/getSiteID.php",
  data: {sitename:sname}, 
  success: function (data) {
            var siteid=data;
			var tmp=siteid.split("\n");
			var sid=tmp[1];
		 
		  
		  			      		$.ajax({
  type: "POST",
  url: "mod/insert/getHID.php",
  data: {type:habitatID}, 
  success: function (data) {
            var siteid=data;
			var tmp=siteid.split("\n");
			var hid=tmp[1];
		 
		  
		  		  	data2.push([sid,hid,pname,plat,plon]);
	
	
	
    var html = generateTable(data2);
	   $("#result1").empty();
    $("#result1").html(html);
	
	
  },
		  });
		  

		  
         }, 
});


	}
	else
	alert("Information is incomplete!");
	}
		function generateTable(data) {
    var html = "<caption><b>Plot Table</b></caption><tr><td>Site ID</td><td>Habitat ID</td><td>Plot Name</td><td>Plot Longitude</td><td>Plot Latitude</td></tr>";

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




