<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'ipython_init');



/**
 * Init d3 plugin.
 */
function ipython_init() {



	
	elgg_register_page_handler('ipython', 'ipython_page_handler');




	
}


function ipython_page_handler() {








$params = array(
        'title' => 'iPython Notebook',
        'content' => '
		
		
		<iframe src="http://scitest02.pha.jhu.edu/compute" width="100%" height="600">
		</iframe>

	',
        'filter' => '',
    );
	$body = elgg_view_layout('owner_block', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




