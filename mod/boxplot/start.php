<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'boxplot_init');



/**
 * Init d3 plugin.
 */
function boxplot_init() {


//$css_url = 'mod/d3/vendors/style.css';
//elgg_register_css('special', $css_url);


//elgg_register_simplecache_view('js/my_plugin/my_javascript');
	$url = 'http://d3js.org/d3.v3.min.js';
	elgg_register_js('d3', $url);
	
		$url = 'http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js';
	elgg_register_js('d3.tip', $url);
	
		$url = 'mod/d3data2/jquery-csv.js';
	elgg_register_js('jquery-csv', $url);

	
			$url = 'mod/boxplot/box.js';
	elgg_register_js('box', $url);
//elgg_load_css('special');



	
	elgg_register_page_handler('boxplot', 'boxplot_page_handler');




	
}


function boxplot_page_handler() {



elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');
elgg_load_js('box');

$params = array(
        'title' => 'Boxplot Visualization',
        'content' => '<style type="text/css">

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.view {
width:100%;
overflow:auto;
height:100%;

}

.box {
  font: 10px sans-serif;
}

.box line,
.box rect,
.box circle {
  fill: lightblue;
  stroke: #000;
  stroke-width: 1px;
}

.box .center {
  stroke-dasharray: 3,3;
}

.box .outlier {
  fill: none;
  stroke: #000;
}

.axis {
  font: 12px sans-serif;
}
 
.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}
 
.x.axis path { 
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

   
    </style>

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
	
<br>
<input type="button" value="Submit" onclick="show()">

<div class="view">
	

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


$.each(selectValues, function(key, value) {   
     $("#siteID")
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




});




		function show(){
		 $(".view").empty();
	
		var site=document.getElementById("siteID").value;
		var habitat=document.getElementById("habitatID").value;
		

var margin = {top: 30, right: 50, bottom: 70, left: 50};
var  width = 900 - margin.left - margin.right;
var height = 400 - margin.top - margin.bottom;

var min = Infinity,
    max = -Infinity;

var chart = d3.box()
    .whiskers(iqr(1.5))
    .width(width)
    .height(height);
if (document.getElementById("site").checked==true)
	{	

$.post("mod/boxplot/read.php",{site:site},function(data1){

d3.csv(data1, function(data) {


var data= $.csv.toObjects(data1);


data2=[];
var tmp=[];
tmp2=[];
  data.forEach(function(x) {
 var t=x.PlotName;
 var t2=x.PlotID;
 
 if (tmp2.indexOf(t2)==-1)
 {
 tmp2.push(t2);
 tmp.push(t);
 
 var e=tmp2.indexOf(t2);
 }
 else
 {
 var e=tmp2.indexOf(t2);
 }
 if (x.CollectionWeight=="null")
 {
   }
	
	else
	{
	var   r = 1;
     var   s = (x.DeploymentWeight-x.CollectionWeight)/x.DeploymentWeight;
     var   d = data2[e];
    if (!d) d = data2[e] = [s];
    else d.push(s);
    if (s > max) max = s;
    if (s < min) min = s;
	
	}
  
  });
 
  chart.domain([min, max]);

var svg = d3.select(".view").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom+180)
		.attr("class", "box")    
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
	
	// the x-axis
	var x = d3.scale.ordinal()	   
		.domain( tmp.map(function(d) { console.log(d); return d } ) )	    
		.rangeRoundBands([0 , width], 0.7, 0.3); 		
		
	var x2 = d3.scale.ordinal()	   
		.domain( data2.map(function(d) { console.log(d); return d[0] } ) )	    
		.rangeRoundBands([0 , width], 0.7, 0.3); 	

	var xAxis = d3.svg.axis()
		.scale(x)
		.orient("bottom");

	// the y-axis
	var y = d3.scale.linear()
		.domain([min, max])
		.range([height + margin.top, 0 + margin.top]);
	
	var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

	// draw the boxplots	
	svg.selectAll(".box")	   
      .data(data2)
	  .enter().append("g")
		.attr("transform", function(d) { return "translate(" +  x2(d[0])  + "," + margin.top + ")"; } )
      .call(chart.width(x2.rangeBand())); 
	
	      
	// add a title
	svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 + (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "18px") 
        //.style("text-decoration", "underline")  
        .text("City: "+site);
 
	 // draw y axis
	svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
		.append("text") // and text1
		  
		  .attr("y", 6)
		  .attr("dx", "2.8em")
		  .attr("dy", ".71em")
		  .style("text-anchor", "end")
		  .style("font-size", "14px") 
		  .text("pctDecrease");		
	
	// draw x axis	
	svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + (height  + margin.top + 5) + ")")
      .call(xAxis)
	  .selectAll("text")	
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function(d) {
                return "rotate(-55)" 
                });
	  
		




  });
});
}
else if(document.getElementById("habitat").checked==true){
$.post("mod/boxplot/read2.php",{habitat:habitat},function(data1){

d3.csv(data1, function(data) {


var data= $.csv.toObjects(data1);


data2=[];
var tmp=[];
tmp2=[];
  data.forEach(function(x) {
 var t=x.PlotName;
 var t2=x.PlotID;
 
 if (tmp2.indexOf(t2)==-1)
 {
 tmp2.push(t2);
 tmp.push(t);
 
 var e=tmp2.indexOf(t2);
 }
 else
 {
 var e=tmp2.indexOf(t2);
 }
 if (x.CollectionWeight=="null")
 {
   }
	
	else
	{
	var   r = 1;
     var   s = (x.DeploymentWeight-x.CollectionWeight)/x.DeploymentWeight;
     var   d = data2[e];
    if (!d) d = data2[e] = [s];
    else d.push(s);
    if (s > max) max = s;
    if (s < min) min = s;
	
	}
  
  });
 
  chart.domain([min, max]);

var svg = d3.select(".view").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom+180)
		.attr("class", "box")    
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
	
	// the x-axis
	var x = d3.scale.ordinal()	   
		.domain( tmp.map(function(d) { console.log(d); return d } ) )	    
		.rangeRoundBands([0 , width], 0.7, 0.3); 		
		
	var x2 = d3.scale.ordinal()	   
		.domain( data2.map(function(d) { console.log(d); return d[0] } ) )	    
		.rangeRoundBands([0 , width], 0.7, 0.3); 	

	var xAxis = d3.svg.axis()
		.scale(x)
		.orient("bottom");

	// the y-axis
	var y = d3.scale.linear()
		.domain([min, max])
		.range([height + margin.top, 0 + margin.top]);
	
	var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

	// draw the boxplots	
	svg.selectAll(".box")	   
      .data(data2)
	  .enter().append("g")
		.attr("transform", function(d) { return "translate(" +  x2(d[0])  + "," + margin.top + ")"; } )
      .call(chart.width(x2.rangeBand())); 
	
	      
	// add a title
	svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 + (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "18px") 
        //.style("text-decoration", "underline")  
        .text("Habitat Type: "+habitat);
 
	 // draw y axis
	svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
		.append("text") // and text1
		  
		  .attr("y", 6)
		  .attr("dx", "2.8em")
		  .attr("dy", ".71em")
		  .style("text-anchor", "end")
		  .style("font-size", "14px") 
		  .text("pctDecrease");		
	
	// draw x axis	
	svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + (height  + margin.top + 5) + ")")
      .call(xAxis)
	  .selectAll("text")	
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function(d) {
                return "rotate(-55)" 
                });
	  
		




  });
});






}

}
function randomize(d) {
  if (!d.randomizer) d.randomizer = randomizer(d);
  return d.map(d.randomizer);
}

function randomizer(d) {
  var k = d3.max(d) * .02;
  return function(d) {
    return Math.max(min, Math.min(max, d + k * (Math.random() - .5)));
  };
}
function iqr(k) {
  return function(d, i) {
    var q1 = d.quartiles[0],
        q3 = d.quartiles[2],
        iqr = (q3 - q1) * k,
        i = -1,
        j = d.length;
    while (d[++i] < q1 - iqr);
    while (d[--j] > q3 + iqr);
    return [i, j];
  };
}





</script>
 
	
	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




