<?php
	elgg_register_event_handler('init', 'system', 'mapping_init');
	$results = file_get_contents('http://scitest09.pha.jhu.edu/elgg/CSVtoKML.php');//load KML file
	//$results = file_get_contents('http://yutingsite.com/queryGluseen/CSVtoKML.php'); 
 	//getCSV_KML();

function mapping_init() {
	elgg_register_page_handler('mapping', 'mapping_page_handler');
	//add menu item
    $item = new ElggMenuItem('mapping', elgg_echo('Mapping'), 'mapping');
	elgg_register_menu_item('site', $item); 	
}

function mapping_page_handler() {
	
	$content = elgg_view('mapping/map', array());
	$sidebar = elgg_view('mapping/hello', array());//right side bar
	$sidebar_alt = elgg_view('mapping/sidebar', array());//left side bar

	$params = array(
        //'title' => 'Hello world!',
        'content' => $content,		
		'sidebar'=> $sidebar,
		//'sidebar_alt'=> $sidebar_alt,
		
        'filter' => '',
    );	
    $body = elgg_view_layout('one_sidebar', $params);//use two_sidebar option to show left bar
    echo elgg_view_page('mapping', $body); 
	return true;
}
	

?>
