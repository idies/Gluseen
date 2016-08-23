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
$frontleft = elgg_get_plugin_setting('frontleft', 'purity_theme');
if (!$frontleft)
    $frontleft = '<h2>You can edit this information in the admin section of this theme.</h2>';
echo $frontleft;
?>