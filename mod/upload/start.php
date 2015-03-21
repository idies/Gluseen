<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'upload2sci_init');

/**
 * Init d3 plugin.
 */
function upload2sci_init() {



	
	elgg_register_page_handler('upload2sci', 'upload2sci_handler');




	
}



function upload2sci_handler() {
//elgg_load_js('d3');
//elgg_load_js('d3.tip');
elgg_load_js('jquery-csv');

$name=elgg_get_logged_in_user_entity()->name;


$params = array(
        'title' => 'Upload Files to Scidrive',
        'content' => '
<form action="/mod/upload/upload2.php?name=jlian1" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>

		',
		
		
        'filter' => '',
    );
		
//$params = jj_readcsv('mod/table/data.csv',true);

 
	
	
	$body = elgg_view_layout('content',$params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




