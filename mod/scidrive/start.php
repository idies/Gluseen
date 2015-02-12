<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'scidrive_init');

/**
 * Init d3 plugin.
 */
function scidrive_init() {





	//$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js';
	//elgg_register_js('jquery', $url);
	


	
	elgg_register_page_handler('scidrive', 'scidrive_page_handler');

	$item = new ElggMenuItem('scidrive', 'SciDrive', 'scidrive');
elgg_register_menu_item('site', $item);




	
}


function scidrive_page_handler() {
//elgg_load_js('jquery');


$params = array(
     
        'content' => '
		<style type="text/css" id="user-css"></style>

	 <iframe src="http://www.scidrive.org/" style="width:1000px; height:800px"; scrolling="yes"></iframe>


 
	
	',
        'filter' => '',
    );
	$body = elgg_view_layout('one_column',$params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




