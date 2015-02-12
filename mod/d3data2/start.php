<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'd3_data_2_init');

/**
 * Init d3 plugin.
 */
function d3_data_2_init() {

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

	
	elgg_register_page_handler('d3_data_2', 'd3_data_2_page_handler');




	
}


function d3_data_2_page_handler() {
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
	


	
	<script type="text/javascript">
	

	function test(){
	
	var music = $.csv.toObjects("mod/d3data2/data.csv");
	//return music;
	//alert(typeof(music));
	alert(music["siteID"]);
	}
	
	</script>
	

	 <h2>
    
    
    </h2>
	
	<form name="input" method="get">
<b>Site Name: </b>
<select id="site">
  <option value="1014 Springfield">1014 Springfield</option>
  <option value="601 Woodbourne & Ready Ave">601 Woodbourne & Ready Ave</option>
  <option value="Evergreen">Evergreen</option>
  <option value="Govans Urban">Govans Urban</option>
  <option value="JHU Mound">JHU Mound</option>
  <option value="Kathy\'s Lawn">Kathys\' Lawn</option>
  <option value="Linkwood baseball field ">Linkwood baseball field </option>
  <option value="Olin Forest">Olin Forest</option>
  <option value="Springfield Woods">Springfield Woods</option>
  <option value="The Alameda and Springfield">The Alameda and Springfield</option>
  <option value="Wilson Park">Wilson Park</option>
  <option value="Wilson Park vacant">Wilson Park vacant</option>
  <option value="Woman in stained wood house">Woman in stained wood house</option>
  <option value="JHU Garage">JHU Garage</option>
  <option value="JHU Homewood House">JHU Homewood House</option>
  <option value="Oregon Ridge - Ivy Hill on Ivy Hill Trail">Oregon Ridge - Ivy Hill on Ivy Hill Trail</option>
  
  
</select>
<br><br>
<b>Deployment Date:</b> <select id="time">
<option value="11/5/2013">11/5/2013</option>
<option value="11/6/2013">11/6/2013</option>
</select>
<br><br>
<b>Variable:</b><br>
<input type="radio" name="varation" id="clean" value="cleanWeight">cleanWeight<br>
<input type="radio" name="varation" id="pct" value="pctDecrease">pctDecrease
<br><br>
<input type="button" value="Submit" onclick="show()">

</form>
<div class="view">
	
	<svg class="chart"></svg>
	</div>

		
		<script type="text/javascript">
		function show(){
		
		 $(".view").empty();
		//document.getElementById("view").style.display="";
		var sitename=document.getElementById("site").value;
		
		var time=document.getElementById("time").value;
		//var clean=document.getElementById("clean").value;
		//var pct=document.getElementById("pct").value;
			
	if (document.getElementById("pct").checked==true)
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

    return "<strong>pctDecrease:</strong> " + d.pctDecrease;

  });









d3.csv("mod/d3data2/data.csv", type, function(data) {
//alert(typeof(data));

fdata=data.filter(function (d){
if(d["siteID"]==sitename && d["deploymentDate"]==time){
return d;
}

});
console.log(fdata);

fdata.forEach(function(d){


d.teabagID=d.teabagID;

d.pctDecrease=+d.pctDecrease;





});





var svg = d3.select(".view").append("svg")

    .attr("width", width + margin.left + margin.right)

    .attr("height", height + margin.top + margin.bottom)

  .append("g")

    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



svg.call(tip);


x.domain(fdata.map(function(fdata) { return fdata.teabagID; }));

y.domain([0, d3.max(fdata, function(fdata) { return fdata.pctDecrease; })]);




  svg.append("g")

      .attr("class", "x axis")

      .attr("transform", "translate(0," + height + ")")

      .call(xAxis)

	  .selectAll("text")  
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function(d) {
                return "rotate(-50)" 
                });
				
				


  svg.append("g")

      .attr("class", "y axis")

      .call(yAxis)

      .append("text")

      .attr("transform", "rotate(0)")

      .attr("y", -20)

      .attr("dy", ".80em")

      .style("text-anchor", "end")

      .text("pctDecrease");

	  svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "16px") 
        .style("text-decoration", "underline")  
        .text("Site ID:"+sitename);


  svg.selectAll(".bar")

      .data(fdata)

      .enter()
	  .append("rect")

      .attr("class", "bar")

      .attr("x", function(fdata) { return x(fdata.teabagID); })

      .attr("width", x.rangeBand())

      .attr("y", function(fdata) { return y(fdata.pctDecrease); })
	

      .attr("height", function(fdata) { return height - y(fdata.pctDecrease); })
	  

      .on("mouseover", tip.show)

      .on("mouseout", tip.hide);


});


function type(fdata) {


  fdata.pctDecrease = +fdata.pctDecrease;

  return fdata;

}

}


else if(document.getElementById("clean").checked==true){

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

    return "<strong>cleanWeight:</strong> " + d.cleanWeight;

  });









d3.csv("mod/d3data2/data.csv", type, function(data) {
//alert(sitename);

fdata=data.filter(function (d){
if(d["siteID"]==sitename && d["deploymentDate"]==time){
return d;
}

});
console.log(fdata);

fdata.forEach(function(d){


d.teabagID=d.teabagID;

d.cleanWeight=+d.cleanWeight;





});





var svg = d3.select(".view").append("svg")

    .attr("width", width + margin.left + margin.right)

    .attr("height", height + margin.top + margin.bottom)

  .append("g")

    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



svg.call(tip);


x.domain(fdata.map(function(fdata) { return fdata.teabagID; }));

y.domain([0, d3.max(fdata, function(fdata) { return fdata.cleanWeight; })]);




  svg.append("g")

      .attr("class", "x axis")

      .attr("transform", "translate(0," + height + ")")

      .call(xAxis)

	  .selectAll("text")  
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function(d) {
                return "rotate(-50)" 
                });
				
				


  svg.append("g")

      .attr("class", "y axis")

      .call(yAxis)

      .append("text")

      .attr("transform", "rotate(0)")

      .attr("y", -20)

      .attr("dy", ".80em")

      .style("text-anchor", "end")

      .text("cleanWeight");

	  svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "16px") 
        .style("text-decoration", "underline")  
        .text("Site ID:"+sitename);


  svg.selectAll(".bar")

      .data(fdata)

      .enter()
	  .append("rect")

      .attr("class", "bar")

      .attr("x", function(fdata) { return x(fdata.teabagID); })

      .attr("width", x.rangeBand())

      .attr("y", function(fdata) { return y(fdata.cleanWeight); })
	

      .attr("height", function(fdata) { return height - y(fdata.cleanWeight); })
	  

      .on("mouseover", tip.show)

      .on("mouseout", tip.hide);


});


function type(fdata) {


  fdata.cleanWeight = +fdata.cleanWeight;

  return fdata;

}

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




