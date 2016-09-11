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
echo elgg_view('page/elements/header_logo', $vars);

// drop-down login
echo elgg_view('core/account/login_dropdown');

// insert site-wide navigation
?>


<div id="social_menu">

 <!--  
   <?php
    echo elgg_view_menu('site');
	$name=elgg_get_logged_in_user_entity()->username;
    ?>
-->	
	<ul class="elgg-menu elgg-menu-site elgg-menu-site-default clearfix">
	
		<li class="elgg-menu-item"><a href="#">People</a>
	<ul class="elgg-menu elgg-menu-site elgg-menu-site-more">
	<li class="elgg-menu-item-activity">
	<a href="/profile/<?php echo $name?>">Profile</a>
	</li>
	<li class="elgg-menu-item-blog">
	<a href="/friends/<?php echo $name?>">Collatorators</a>
	</li>
	<li class="elgg-menu-item-bookmarks">
	<a href="/groups/all">Groups</a>
	</li>
	
	</ul>
	</li>
		<li class="elgg-menu-item"><a href="#">Places</a>
	<ul class="elgg-menu elgg-menu-site elgg-menu-site-more">
	<li class="elgg-menu-item-blog">
	<a href="/sites">Research Sites</a>
	</li>
	<li class="elgg-menu-item-activity">
	<a href="/mapping">Map</a>
	</li>
	
	<li class="elgg-menu-item-bookmarks">
	<a href="/photos/siteimagesall">Photos</a>
	</li>
	</ul>
	</li>
		<li class="elgg-menu-item"><a href="#">Data</a>
	<ul class="elgg-menu elgg-menu-site elgg-menu-site-more">
    	  <li class="elgg-menu-item-blog">
	<a href="/insertsite">Add Site</a>
	</li>
		 <li class="elgg-menu-item-blog">
	<a href="/insertplot">Add Plot</a>
	</li>
	
	<li class="elgg-menu-item-activity">
	<a href="/upload2sci">Upload Samples</a>
	</li>
	<li class="elgg-menu-item-activity">
	<a href="/uploadStatus">Upload Status</a>
	</li>
    <li class="elgg-menu-item-blog">
	<a href="/table">View Table</a>
	</li>

	
	</ul>
	</li>
	<li class="elgg-menu-item"><a href="#">Results</a>
	<ul class="elgg-menu elgg-menu-site elgg-menu-site-more">
	<li class="elgg-menu-item-activity">
	<a href="/publications">Publications</a>
	</li>
	<li class="elgg-menu-item-blog">
	<a href="/manuscript">Manuscripts</a>
	</li>
	<li class="elgg-menu-item-bookmarks">
	<a href="/d3">Bar Visualization</a>
	</li>
		<li class="elgg-menu-item-bookmarks">
	<a href="/boxplot">Boxplot Visualization</a>
	</li>
			
	</ul>
	</li>
	</ul>
	
	
	</div>
	
	
    <div style="clear:both;"></div>




<?php echo elgg_view('page/elements/topbar', $vars); ?>
<div style="clear:both;"></div>
