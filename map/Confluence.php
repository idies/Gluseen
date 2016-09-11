<!DOCTYPE html>
<meta charset="utf-8">
<style>

body {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}
.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 1.5px;
}.line2 {  fill: none;  stroke: red;  stroke-width: 1.5px;}
.line3 {  fill: none;  stroke: green;  stroke-width: 1.5px;}.line4 {  fill: none;  stroke: blue;  stroke-width: 1.5px;}
</style><?php echo error_get_last();//$connection = new Mongo(mongodb://10.55.17.183:27017);$m = new MongoClient("mongodb://10.55.15.199:27017");  $num='01614090';$db = $m->nexradTS;   $collection = $db->nexradTS; //$query=array("SITE_NO"=>"01311810");$query=array("dateTime"=>array('$gt'=>'2013-12-16','$lt'=>'2014-08-20'),"SITE_NO"=>$num);$cursor = $collection->find($query); $date=array(); $precip=array();foreach ($cursor as $obj) { array_push($date,$obj["dateTime"]);array_push($precip,$obj["precipitation"]);//echo $obj["dateTime"] . "<br />\n"; } //echo $precip; $m->close(); ?> 
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script>var date=<?php echo json_encode($date);?>;var result=JSON.stringify(date);var test=JSON.parse("["+result+"]");var precip=<?php echo json_encode($precip);?>;var result2=JSON.stringify(precip);var test2=JSON.parse("["+result2+"]");
var dataP=[];for(var i in test[0]){	dataP.push({'date':test[0][i],'precip':test2[0][i]});	}</script><script>
var margin = {top: 20, right: 20, bottom: 30, left: 50},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var parseDate = d3.time.format("%m/%d/%y %H:%M").parse;

var x = d3.time.scale()
    .range([0, width]);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

var line = d3.svg.line()
    .x(function(d) { return x(d.Date); })
    .y(function(d) { return y(d.Conductivity); });	var line2 = d3.svg.line()    .x(function(d) { return x(d.Date); })    .y(function(d) { return y(d.Water_temp_degF); });var line3 = d3.svg.line()    .x(function(d) { return x(d.date); })    .y(function(d) { return y(d.precip); });var line4 = d3.svg.line()    .x(function(d) { return x(d.Date); })    .y(function(d) { return y(d.Level_ft); });

var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");	var svg2 = d3.select("body").append("svg")    .attr("width", width + margin.left + margin.right)    .attr("height", height + margin.top + margin.bottom)  .append("g")    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
var svg3 = d3.select("body").append("svg")    .attr("width", width + margin.left + margin.right)    .attr("height", height + margin.top + margin.bottom)  .append("g")    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");	var svg4 = d3.select("body").append("svg")    .attr("width", width + margin.left + margin.right)    .attr("height", height + margin.top + margin.bottom)  .append("g")    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
d3.csv("data/Confluence.csv", function(error, data) {
  if (error) throw error;

  data.forEach(function(d) {
    d.Date = parseDate(d.Date);
    d.Conductivity = +d.Conductivity;
  });

  x.domain(d3.extent(data, function(d) { return d.Date; }));
  y.domain(d3.extent(data, function(d) { return d.Conductivity; }));

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Conductivity (uS_cm)");

  svg.append("path")
      .datum(data)
      .attr("class", "line")
      .attr("d", line);
});d3.csv("data/Confluence.csv", function(error, data) {  if (error) throw error;  data.forEach(function(d) {    d.Date = parseDate(d.Date);    d.Water_temp_degF = +d.Water_temp_degF;  });  x.domain(d3.extent(data, function(d) { return d.Date; }));  y.domain(d3.extent(data, function(d) { return d.Water_temp_degF; }));  svg2.append("g")      .attr("class", "x axis")      .attr("transform", "translate(0," + height + ")")      .call(xAxis);  svg2.append("g")      .attr("class", "y axis")      .call(yAxis)    .append("text")      .attr("transform", "rotate(-90)")      .attr("y", 6)      .attr("dy", ".71em")      .style("text-anchor", "end")      .text("Water Temperature (degF)");  svg2.append("path")      .datum(data)      .attr("class", "line2")      .attr("d", line2);});d3.csv("data/Confluence.csv", function(error, data) {  if (error) throw error;  data.forEach(function(d) {    d.Date = parseDate(d.Date);    d.Level_ft = +d.Level_ft;  });  x.domain(d3.extent(data, function(d) { return d.Date; }));  y.domain(d3.extent(data, function(d) { return d.Level_ft; }));  svg4.append("g")      .attr("class", "x axis")      .attr("transform", "translate(0," + height + ")")      .call(xAxis);  svg4.append("g")      .attr("class", "y axis")      .call(yAxis)    .append("text")      .attr("transform", "rotate(-90)")      .attr("y", 6)      .attr("dy", ".71em")      .style("text-anchor", "end")      .text("Level(ft)");  svg4.append("path")      .datum(data)      .attr("class", "line4")      .attr("d", line4);});//parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;format = d3.time.format('%Y-%m-%dT%H:%M:%SZ');dataP.forEach(function(d) {    d.date = format.parse(d.date);    d.precip = +d.precip;  });  x.domain(d3.extent(dataP, function(d) { return d.date; }));  y.domain(d3.extent(dataP, function(d) { return d.precip; }));  svg3.append("g")      .attr("class", "x axis")      .attr("transform", "translate(0," + height + ")")      .call(xAxis);  svg3.append("g")      .attr("class", "y axis")      .call(yAxis)    .append("text")      .attr("transform", "rotate(-90)")      .attr("y", 6)      .attr("dy", ".71em")      .style("text-anchor", "end")      .text("Precipitation");  svg3.append("path")      .datum(dataP)      .attr("class", "line3")      .attr("d", line3);
</script>
</body>