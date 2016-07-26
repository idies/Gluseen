<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'webservice_init');



/**
 * Init d3 plugin.
 */
function webservice_init() {


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

	
	elgg_register_page_handler('webservice', 'webservice_page_handler');




	
}


function webservice_page_handler() {





$response = file_get_contents('http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20*%20from%20DecompSample%20where%20CollectionDate%20=%20%273/24/2014%27&format=csv');

//echo $response;

elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');

$params = array(
        'title' => 'GLUSEEN: Global Urban Soil Ecology and Education Network',
        'content' => '<h2>EarthScience REST API</h2>
		<b>Root path</b><br>
		<p>http://&lt;serverName&gt; /EarthScience/</p>
		
		<b>Execute  query</b><br>
		<p>GET  EarthScience/getData?Query=&lt;QueryString&gt;&format=&lt;outputtype&gt;</p>
		<b><i>Headers: (If authenticated user)</i></b><br>
		<img src="http://10.55.17.52/mod/webservice/pic1.JPG" alt="exa">
		<br><br>
		<b><i>Query String:</i></b><br>
		<p>There are two parameters. <br>
1.	Query = any query to EarthSciTest database tables<br>
2.	Format= json or csv
</p>
<img src="http://10.55.17.52/mod/webservice/pic2.JPG" alt="exa">
<br><br>
<b><i>Response:</i></b> <p>CSV-formatted table data</p>
<img src="http://10.55.17.52/mod/webservice/pic3.JPG" alt="exa">
<br>
<p>
For example:<br>
 http://dsa002.pha.jhu.edu/EarthScience/EarthScience/getData?Query=select%20top%2010%20*%20from%20data_upload_2&format=json

</p>

	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




