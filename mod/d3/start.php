<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'd3_init');



/**
 * Init d3 plugin.
 */
function d3_init() {


//$css_url = 'mod/d3/vendors/style.css';
//elgg_register_css('special', $css_url);


//elgg_register_simplecache_view('js/my_plugin/my_javascript');
	$url = 'http://d3js.org/d3.v3.min.js';
	elgg_register_js('d3', $url);
	
		$url = 'http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js';
	elgg_register_js('d3.tip', $url);
	
		$url = 'mod/d3data2/jquery-csv.js';
	elgg_register_js('jquery-csv', $url);

//elgg_load_css('special');

	
	elgg_register_page_handler('d3', 'd3_page_handler');




	
}


function d3_page_handler() {





//$response = file_get_contents('http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20*%20from%20DecompSample%20where%20CollectionDate%20=%20%273/24/2014%27&format=csv');

//echo $response;

elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');

$params = array(
        'title' => 'Visualization',
        'content' => '<style type="text/css">


.axis path,

.axis line {

  fill: none;

  stroke: #000;

  shape-rendering: crispEdges;

}



.bar {

  fill: lightblue;

}



.bar:hover {

  fill: orangered ;

}



.x.axis path {

  display: none;

}



.d3-tip {

  line-height: 1;

  font-weight: bold;

  padding: 8px;

  background: rgba(0, 0, 0, 0.8);

  color: #fff;

  border-radius: 2px;

}



/* Creates a small triangle extender for the tooltip */

.d3-tip:after {

  box-sizing: border-box;

  display: inline;

  font-size: 6px;

  width: 100%;

  line-height: 1;

  color: rgba(0, 0, 0, 0.8);

  content: "\25BC";

  position: absolute;

  text-align: left;

}



/* Style northward tooltips differently */

.d3-tip.n:after {

  margin: -1px 0 0 0;

  top: 100%;

  left: 0;

}


   
    </style>
	


	
	
	

	 <h2>
    
    
    </h2>
	
<!--
<b>Deployment Date:</b> <select id="time">
<option value="11/5/2013">11/5/2013</option>
<option value="11/6/2013">11/6/2013</option>
</select><br>

<b>Sample Duration (Days):</b><select id="dateRange">
<option value="139">139</option>
<option value="140">140</option>
</select><br>
-->
<b>Group by:</b><br>
<input type="radio" name="varation" id="site" value="site">City<br>
<input type="radio" name="varation" id="habitat" value="habitat">Habitat
<br>

<b>City:</b> 
<form>
<select id="siteID">



</select>
</form>
<b>Habitat Type:</b> 
<form>
<select id="habitatID">
</select>
</form>
<!--
<b>Habitat Type:</b> 
<form>
<select id="habitatID">
<option value="Forest">Forest</option>
<option value="Grass">Grass</option>
<option value="Disturbed">Disturbed</option>
</select>
</form>

<br>

<b>Variable:</b><br>
<input type="radio" name="varation" id="clean" value="cleanWeight">DeploymentWeight<br>
<input type="radio" name="varation" id="pct" value="pctDecrease">pctDecrease
<br><br>
-->
<input type="button" value="Submit" onclick="show()">


<div class="view">
	
	<svg class="chart"></svg>
	</div>

		
		<script type="text/javascript">

$(document).ready(function () {
     $.ajax({
		 processData: false,
		 contentType: false,
        type: "GET",
        url: "mod/d3/query.php",
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
     $("#siteID")
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
        url: "mod/d3/query2.php",
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



		//selectValues = { "1": "test 1", "2": "test 2" };

});


		function show(){
			 $(".view").empty();
		//document.getElementById("view").style.display="";
		var site=document.getElementById("siteID").value;
		var habitat=document.getElementById("habitatID").value;
		
		//var dateRange=document.getElementById("dateRange").value;
			
	if (document.getElementById("site").checked==true)
	{
	

var margin = {top: 40, right: 20, bottom: 200, left: 100},

    width = 700 - margin.left - margin.right,

    height = 500 - margin.top - margin.bottom;



var formatPercent = d3.format(".0");



var x = d3.scale.ordinal()

    .rangeRoundBands([0, width], .1);



var y = d3.scale.linear()

    .range([height, 0]);



var xAxis = d3.svg.axis()

    .scale(x)

    .orient("bottom");
	


var yAxis = d3.svg.axis()

    .scale(y)

    .orient("left")

    .tickFormat(formatPercent);



var tip = d3.tip()

  .attr("class", "d3-tip")

  .offset([-10, 0])

  .html(function(d) {

    return "<strong>TeabagID:</strong>"+d.TeabagID+"<br><strong>pctDecrease:</strong> " +( (d.DeploymentWeight-d.CollectionWeight)/d.DeploymentWeight);

  });


$.post("mod/d3/read3.php",{site:site},function(data1){


d3.csv(data1, type, function(data) {

var data= $.csv.toObjects(data1);
//alert(typeof(data));

//fdata=data.filter(function (d){
//if(d["DeploymentDate"]==time){
//return d;
//}

//});


data.forEach(function(d){

if (d.CollectionWeight==-999)
{
	d.TeabagID=d.TeabagID;

d.CollectionWeight=0;

d.DeploymentWeight=0;
d.Name=d.Name;
	
}
else
{
d.TeabagID=d.TeabagID;

d.CollectionWeight=+d.CollectionWeight;

d.DeploymentWeight=+d.DeploymentWeight;
d.Name=d.Name;
}

});





var svg = d3.select(".view").append("svg")

    .attr("width", width + margin.left + margin.right)

    .attr("height", height + margin.top + margin.bottom)

  .append("g")

    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



svg.call(tip);


x.domain(data.map(function(data) { return data.Name; }));

y.domain([0, d3.max(data, function(data) { return (data.DeploymentWeight-data.CollectionWeight)/data.DeploymentWeight; })]);




  svg.append("g")

      .attr("class", "x axis")

      .attr("transform", "translate(0," + height + ")")

      .call(xAxis)
 
	  .selectAll("text")  
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function(d) {
                return "rotate(-80)" 
                });
			
				
				


  svg.append("g")

      .attr("class", "y axis")

      .call(yAxis)

      .append("text")

      .attr("transform", "rotate(0)")

      .attr("y", -15)

      .attr("dy", ".80em")

      .style("text-anchor", "end")

      .text("pctDecrease");

	  svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "16px") 
        .style("text-decoration", "underline")  
        .text("City:"+site);


  svg.selectAll(".bar")

      .data(data)

      .enter()
	  .append("rect")

      .attr("class", "bar")

      .attr("x", function(data) { return x(data.Name); })

      .attr("width", x.rangeBand())

      .attr("y", function(data) { return y((data.DeploymentWeight-data.CollectionWeight)/data.DeploymentWeight); })
	

      .attr("height", function(data) { return height - y((data.DeploymentWeight-data.CollectionWeight)/data.DeploymentWeight); })
	  

      .on("mouseover", tip.show)

      .on("mouseout", tip.hide);


});
});





}


else if(document.getElementById("habitat").checked==true){


var margin = {top: 40, right: 20, bottom: 200, left: 100},

    width = 700 - margin.left - margin.right,

    height = 500 - margin.top - margin.bottom;



var formatPercent = d3.format(".0");



var x = d3.scale.ordinal()

    .rangeRoundBands([0, width], .1);



var y = d3.scale.linear()

    .range([height, 0]);



var xAxis = d3.svg.axis()

    .scale(x)

    .orient("bottom");
	


var yAxis = d3.svg.axis()

    .scale(y)

    .orient("left")

    .tickFormat(formatPercent);



var tip = d3.tip()

  .attr("class", "d3-tip")

  .offset([-10, 0])

  .html(function(d) {

    return "<strong>TeabagID:</strong>"+d.TeabagID+"<br><strong>pctDecrease:</strong> " +( (d.DeploymentWeight-d.CollectionWeight)/d.DeploymentWeight);

  });


$.post("mod/d3/read2.php",{habitat:habitat},function(data1){


d3.csv(data1, type, function(data) {

var data= $.csv.toObjects(data1);
//alert(typeof(data));

//fdata=data.filter(function (d){
//if(d["DeploymentDate"]==time){
//return d;
//}

//});


data.forEach(function(d){

if (d.CollectionWeight==-999)
{
	d.TeabagID=d.TeabagID;

d.CollectionWeight=0;

d.DeploymentWeight=0;
d.Name=d.Name;
	
}
else
{
d.TeabagID=d.TeabagID;

d.CollectionWeight=+d.CollectionWeight;

d.DeploymentWeight=+d.DeploymentWeight;
d.Name=d.Name;
}

});





var svg = d3.select(".view").append("svg")

    .attr("width", width + margin.left + margin.right)

    .attr("height", height + margin.top + margin.bottom)

  .append("g")

    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



svg.call(tip);


x.domain(data.map(function(data) { return data.Name; }));

y.domain([0, d3.max(data, function(data) { return (data.DeploymentWeight-data.CollectionWeight)/data.DeploymentWeight; })]);




  svg.append("g")

      .attr("class", "x axis")

      .attr("transform", "translate(0," + height + ")")

      .call(xAxis)
 
	  .selectAll("text")  
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function(d) {
                return "rotate(-80)" 
                });
			
				
				


  svg.append("g")

      .attr("class", "y axis")

      .call(yAxis)

      .append("text")

      .attr("transform", "rotate(0)")

      .attr("y", -15)

      .attr("dy", ".80em")

      .style("text-anchor", "end")

      .text("pctDecrease");

	  svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "16px") 
        .style("text-decoration", "underline")  
        .text("Habitat Type:"+habitat);


  svg.selectAll(".bar")

      .data(data)

      .enter()
	  .append("rect")

      .attr("class", "bar")

      .attr("x", function(data) { return x(data.Name); })

      .attr("width", x.rangeBand())

      .attr("y", function(data) { return y((data.DeploymentWeight-data.CollectionWeight)/data.DeploymentWeight); })
	

      .attr("height", function(data) { return height - y((data.DeploymentWeight-data.CollectionWeight)/data.DeploymentWeight); })
	  

      .on("mouseover", tip.show)

      .on("mouseout", tip.hide);


});
});

}
function type(fdata) {


  fdata.CollectionWeight = +fdata.CollectionWeight;

  return fdata;

}



}
</script>
 
	
	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




