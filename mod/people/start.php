<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'people_init');



/**
 * Init d3 plugin.
 */
function people_init() {


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

	
	elgg_register_page_handler('people', 'people_page_handler');




	
}


function people_page_handler() {





elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');

$params = array(
        'title' => 'People',
        'content' => '
	KatalinSzlavecz, Johns Hopkins University, USA<br><br>
Richard V Pouyat, USDA Forest Service, USA<br><br>
Ian Yesilons, USDA Forest Service, USA<br><br>
Stephanie Yarwood, University of Maryland, USA<br><br>
Dietrich Epps Schmidt, University of Maryland, USA<br><br>
CsabaCsuzdi, Eszterházy K. College, Hungary<br><br>
Elisabeth Hornung, SzentIstván University, Hungary<br><br>
MiklosDombos, Institute for Soil Sciences and Agricultural Chemistry, Hungary<br><br>
SarelCilliers, North-West University, South Africa<br><br>
Marie du Toit,North-West University, South Africa<br><br>
HeikkiSetala, University of Helsinki, Finland<br><br>
Johan Kotze, University of Helsinki, Finland

	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




