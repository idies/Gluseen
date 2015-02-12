<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'experiment_init');



/**
 * Init d3 plugin.
 */
function experiment_init() {




	
	elgg_register_page_handler('experiment', 'experiment_page_handler');




	
}


function experiment_page_handler() {






$params = array(
        'title' => 'Experiment',
        'content' => '
		
		

	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




