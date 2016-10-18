<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'sci_init');



/**
 * Init d3 plugin.
 */
function sci_init() {



	
	elgg_register_page_handler('sci', 'sci_page_handler');




	
}


function sci_page_handler() {



elgg_load_js('d3');
elgg_load_js('d3.tip');
elgg_load_js('j-c');
elgg_load_js('box');

$params = array(
        'title' => 'Boxplot Visualization',
        'content' => '
		<input type="button"  id="bt" value="enable SciDrive Plugin" name="enable SciDrive Plugin">
		<div class="view">
	
	
	</div>
		
		<script type="text/javascript">
		

$("#bt").click(function(){
	$.ajax({
  type: "POST",
  url: "mod/enableScidrive/enable.php",
  data: { name: "John" }
}).done(function( msg ) {
  alert( "Message: " + msg );
});    
	
  });  
  
  </script>
	
	',
        'filter' => '',
    );
	$body = elgg_view_layout('owner_block', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




