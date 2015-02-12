<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'sites_init');



/**
 * Init d3 plugin.
 */
function sites_init() {


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

	
	elgg_register_page_handler('sites', 'sites_page_handler');




	
}


function sites_page_handler() {





$response = file_get_contents('http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20*%20from%20DecompSample%20where%20CollectionDate%20=%20%273/24/2014%27&format=csv');

//echo $response;

elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');

$params = array(
        'title' => 'Research Sites',
        'content' => '
		
		
		
		
		<!--
		<h2>Motivation</h2>
		
		<ul>
		<li>
		Urban soils are still neglected in urban ecosystem studies</li>
<li>Opportunity to reconnect people with nature</li>
<li>Soil is everywhere and forms a continuum of human effects</li>
		</ul>
		<br>
		<h2>Objectives</h2>
		
		
		<ul>
		<li>To develop experimental protocols that are simple to adopt across many habitat types and soil conditions in urban areas across the world. 
</li>
<li>Two-tier approach: scientists, citizen scientists
</li>

		</ul>
		<br>
		<h2>Main Questions</h2>
		<ol>
		<li>1.Does urbanization create novel soil ecosystems?
</li>
<li>2.Are assembly rules of urban soil communities different?
</li>
<li>3.How do abiotic drivers differ in urban soil ecosystems?
</li>
<li>4.What is the relative importance of <u>native</u> (climate, parent material)vs. <u>anthropogenic</u> (management, disturbance) soil forming factors? 
</li>
<li>5.Do soil ecosystem attributes “converge” on a global and on regional scales? </li>
 </ol>
	<br>
	<h2>Observations and Measurements</h2>
	<br>
	<b>Habitat selection protocol</b><br>
&nbsp;&nbsp;&nbsp;Level of maintenance (M) (High-Medium-Low)<br>
&nbsp;&nbsp;&nbsp;Level of disturbance (D) (High-Low)<br>
&nbsp;&nbsp;&nbsp;Vegetation cover<br>
&nbsp;&nbsp;&nbsp;Additional considerations: soil type, patch size, location, access<br>
<b>Four habitat types</b><br>
&nbsp;&nbsp;&nbsp;HD/LM : Ruderal (Massive)<br>
&nbsp;&nbsp;&nbsp;HD/MM : Public green spaces; turf<br>
&nbsp;&nbsp;&nbsp;LD/LM : Remnant <br>
&nbsp;&nbsp;&nbsp;Reference : representing the biome <br>
<b>Soil sampling</b><br>
<b>Soil analysis: pH, organic matter</b><br>
&nbsp;&nbsp;&nbsp;In-house analysis<br>
<b>Soil microbial community</b><br>
&nbsp;&nbsp;&nbsp;Central lab: University of Maryland <br>
<b>Earthworm sampling</b> <br>
&nbsp;&nbsp;&nbsp;Adapted from EU protocol<br>
<b>Decomposition: using universally available pyramid teabags in place of litterbags</b><br>-->
<img src="http://10.55.17.52/mod/sites/Sites.PNG" style="width: 100%;">

	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




