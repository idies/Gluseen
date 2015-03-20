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





$response = file_get_contents('http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20*%20from%20DecompSample%20where%20CollectionDate%20=%20%273/24/2014%27&format=csv');

//echo $response;

elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');
elgg_load_js('box');

$params = array(
        'title' => 'Visualization',
        'content' => '<style type="text/css">

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.box {
  font: 10px sans-serif;
}

.box line,
.box rect,
.box circle {
  fill: steelblue;
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
	


	
	
	

	 <h2>
    
    
    </h2>
	

<b>Deployment Date:</b> <select id="time">
<option value="11/5/2013">11/5/2013</option>
<option value="11/6/2013">11/6/2013</option>
</select><br>
<b>Site ID:</b> <select id="siteID">
<option value="1">1</option>
<option value="2">2</option>
</select><br>
<b>Variable:</b><br>

<input type="radio" name="varation" id="pct" value="pctDecrease">CollectionWeight
<br><br>
<input type="button" value="Submit" onclick="show()">

</form>
<div class="view">
	
	
	</div>

		
		<script type="text/javascript">
		




		function show(){
		//document.getElementById("view").style.display="";
		var site=document.getElementById("siteID").value;
		
		var time=document.getElementById("time").value;
		//var clean=document.getElementById("clean").value;
		//var pct=document.getElementById("pct").value;
			

	
var labels = true; // show the text labels beside individual boxplots?

var margin = {top: 30, right: 50, bottom: 70, left: 50};
var  width = 800 - margin.left - margin.right;
var height = 400 - margin.top - margin.bottom;
	
var min = Infinity,
    max = -Infinity;
	

$.post("mod/boxplot/read.php",{date:time,site:site},function(csv){

var data=[];
	data[0] = [];
	data[1] = [];
	data[2] = [];
	
	data[0][0] = "H1";
	data[1][0] = "H2";
	data[2][0] = "H3";
	
	data[0][1] = [];
	data[1][1] = [];
	data[2][1] = [];
	
	d3.csv(csv,  function(data1) {
	var data1= $.csv.toObjects(csv);

data1.forEach(function(x) {



		
			
if (x.HabitatID=="1")

{

temp=+x.DeploymentWeight;
data[0][1].push(temp);

}
else if (x.HabitatID=="2")

{
temp=+x.DeploymentWeight;
data[1][1].push(temp);

}
else if (x.HabitatID=="3")

{
temp=+x.DeploymentWeight;
data[2][1].push(temp);

}





});
var rowMax = Math.max(Math.max(data[0]), Math.max(Math.max(data[1]), Math.max(data[2])));
var rowMin = Math.min(Math.min(data[0]), Math.min(Math.min(data[1]), Math.min(data[2])));

	//if (rowMax > max) max = rowMax;
	//	if (rowMin < min) min = rowMin;	
max=rowMax;
min=rowMin;
alert(max);
});


	
  
	var chart = d3.box()
		.whiskers(iqr(1.5))
		.height(height)	
		.domain([min, max])
		.showLabels(labels);

	var svg = d3.select(".view").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.attr("class", "box")    
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
	
	// the x-axis
	var x = d3.scale.ordinal()	   
		.domain( data.map(function(d) { console.log(d); return d[0] } ) )	    
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
      .data(data)
	  .enter().append("g")
		.attr("transform", function(d) { return "translate(" +  x(d[0])  + "," + margin.top + ")"; } )
      .call(chart.width(x.rangeBand())); 
	
	      
	// add a title
	svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 + (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "18px") 
        //.style("text-decoration", "underline")  
        .text("Boxplot of Habitat");
 
	 // draw y axis
	svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
		.append("text") // and text1
		  .attr("transform", "rotate(-90)")
		  .attr("y", 6)
		  .attr("dy", ".71em")
		  .style("text-anchor", "end")
		  .style("font-size", "16px") 
		  .text("pctDecrease");		
	
	// draw x axis	
	svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + (height  + margin.top + 10) + ")")
      .call(xAxis)
	  .append("text")             // text label for the x axis
        .attr("x", (width / 2) )
        .attr("y",  20 )
		.attr("dy", ".71em")
        .style("text-anchor", "middle")
		.style("font-size", "16px") 
        .text("Habitat"); 
});

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


}
</script>
 
	
	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




