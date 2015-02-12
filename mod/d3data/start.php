<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'd3_data_init');

/**
 * Init d3 plugin.
 */
function d3_data_init() {

//$css_url = 'mod/d3/vendors/style.css';
//elgg_register_css('special', $css_url);


//elgg_register_simplecache_view('js/my_plugin/my_javascript');
	$url = 'http://d3js.org/d3.v3.min.js';
	elgg_register_js('d3', $url);
	
		$url = 'http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js';
	elgg_register_js('d3.tip', $url);

//elgg_load_css('special');

	
	elgg_register_page_handler('d3_data', 'd3_data_page_handler');


	$item = new ElggMenuItem('visulize', 'Data Visulization', 'd3_data');
elgg_register_menu_item('site', $item);



	
}


function d3_data_page_handler() {
elgg_load_js('d3');
elgg_load_js('d3.tip');

$params = array(
        'title' => 'D3 data',
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
      <i>Test D3</i> data set<br>
    
    </h2>

		<div class="view">
	</div>
	<svg class="chart"></svg>
	<script type="text/javascript">

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

  .html(function(pct) {

    return "<strong>Average pctDecrease:</strong> " + pct.pctDecrease+"<br><strong>Standard deviation pctDecrease:</strong> " + pct.std ;

  })






var arr=new Array();
var site=new Array();
var pct=new Array();


d3.csv("mod/d3data/data.csv", type, function(data) {


var i=0;
data.forEach(function(d){


d.teabagID=d.teabagID;

d.pctDecrease=+d.pctDecrease;

d.siteID=d.siteID;

arr[i]=d.pctDecrease;
site[i]=d.siteID;
i++;
});

//alert(typeof(arr[1]));

for (i=0;i<arr.length/5;i++){
var temp=0;
for (j=0;j<5;j++){
if (isNaN(arr[i*5+j]))
{arr[i*5+j]=0;}

temp+=arr[i*5+j];

}


var std=0;
for (j=0;j<5;j++){
if (isNaN(arr[i*5+j]))
{arr[i*5+j]=0;}

std=std+(arr[i*5+j]-temp/5)*(arr[i*5+j]-temp/5);

}
standard=Math.sqrt(std/temp/5);
pct[i]={"pctDecrease":(temp/5).toFixed(3),"siteID":site[5*i],"std":standard.toFixed(3)};
pct.forEach(function(d){



d.pctDecrease=+d.pctDecrease;

d.siteID=d.siteID;


});

}

var svg = d3.select(".view").append("svg")

    .attr("width", width + margin.left + margin.right)

    .attr("height", height + margin.top + margin.bottom)

  .append("g")

    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



svg.call(tip);


x.domain(data.map(function(pct) { return pct.siteID; }));

y.domain([0, d3.max(data, function(pct) { return pct.pctDecrease; })]);



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

      .attr("y", 2)

      .attr("dy", ".50em")

      .style("text-anchor", "end")

      .text("pctDecrease");



  svg.selectAll(".bar")

      .data(pct)

      .enter()
	  .append("rect")

      .attr("class", "bar")

      .attr("x", function(pct) { return x(pct.siteID); })

      .attr("width", x.rangeBand())

      .attr("y", function(pct) { return y(pct.pctDecrease); })
	

      .attr("height", function(pct) { return height - y(pct.pctDecrease); })
	  

      .on("mouseover", tip.show)

      .on("mouseout", tip.hide)



});


function type(pct) {


  pct.pct = +pct.pct;

  return pct;

}



</script>
 
	
	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




