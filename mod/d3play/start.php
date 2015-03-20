<?php
/**
 * d3

 */

elgg_register_event_handler('init', 'system', 'play_d3_init');

/**
 * Init d3 plugin.
 */
function play_d3_init() {




//elgg_register_simplecache_view('js/my_plugin/my_javascript');
	$url = 'mod/d3play/views/default/js/d3.v2.min.js';
	elgg_register_js('d3_2', $url);
	
		$url = 'mod/d3play/views/default/js/ace.js';
	elgg_register_js('ace', $url);

			$url = 'mod/d3play/views/default/js/mode-css.js';
	elgg_register_js('mode-css', $url);
	
			$url = 'mod/d3play/views/default/js/mode-javascript.js';
	elgg_register_js('mode-javascript', $url);
	
			$url = 'mod/d3play/views/default/js/playground.js';
			
	elgg_register_js('playground', $url);
	
			$url = 'mod/d3play/views/default/js/theme-cobalt.js';
	elgg_register_js('theme-cobalt', $url);
	
	$css_url='mod/d3play/views/default/playground.css ';
		elgg_register_css('playground', $css_url);
//elgg_load_css('special');

	
	elgg_register_page_handler('play_d3', 'play_d3_page_handler');

	$item = new ElggMenuItem('playwithd3', 'D3 API', 'play_d3');
elgg_register_menu_item('site', $item);




	
}


function play_d3_page_handler() {
elgg_load_js('d3_2');
elgg_load_js('ace');
elgg_load_js('mode-css');
elgg_load_js('mode-javascript');
elgg_load_js('playground');
elgg_load_js('theme-cobalt');
elgg_load_css('playground');

$params = array(
        'title' => '',
        'content' => '
		<style type="text/css" id="user-css"></style>

	<section id="playground-wrap">
		<header><h2>play with D3 </h2></header>
		<div id="playground"></div>
	</section><section id="data">
		<header><h2>$data <span>(JS, not JSON)</span></h2><span class="note"><button id="swizzle" title="Change all numbers in data by ±20%, running code again without erasing the playground.">swizzle</button></span></header>
		<div id="data-editor" class="editor"></div>
	</section><section id="css">
		<header><h2>CSS</h2></header>
		<div id="css-editor" class="editor"></div>
	</section><section id="code">
		<header>
				<h2>d3.js code </h2>
				<span class="note"><label title="Uncheck to type a lot of code that might be slow"><input type="checkbox" id="runcode" checked> Update?</label></span>
		</header>
		<div id="code-editor" class="editor"></div>
	</section>


 
	
	',
        'filter' => '',
    );
	$body = elgg_view_layout('one_column',$params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




