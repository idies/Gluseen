<?php

/**
 * SocialApparatus Elgg 1.8 Purity Theme
 *
 * @package     purity
 * @author      Shane Barron admin@socia.us
 * @url         http://socia.us
 * @license     GNU General Public License (GPL) version 2
 *
 */
function purity_theme_init() {
    elgg_extend_view('page/elements/head', 'purity_theme/meta');
    elgg_unregister_menu_item('topbar', 'elgg_logo');
	elgg_register_plugin_hook_handler('index', 'system', 'purity_theme');
}
function purity_theme($hook, $type, $return, $params) {

	if ($return == true) {
		// another hook has already replaced the front page
		return $return;
	}

	if (!include_once(dirname(__FILE__) . "/index.php")) {
		return false;
	}

	// return true to signify that we have handled the front page
	return true;
	
}

elgg_register_event_handler('init', 'system', 'purity_theme_init');
?>