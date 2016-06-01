<?php
/**
 * Elgg custom index layout
 * 
 * You can edit the layout of this page with your own layout and style. 
 * Whatever you put in this view will appear on the front page of your site.
 * 
 */

$mod_params = array('class' => 'elgg-module-highlight');

?>
<?php
 $name=elgg_get_logged_in_user_entity()->username;
 ?>
<style type="text/css">
.leftbar{
background: #eeeeee;
position:relative;
padding:50px;
margin:20px;
font-color:black;
font-size:100%;
font-weight:bold;

border: 1px solid black;

}


</style>

<div class="custom-index elgg-main elgg-grid clearfix">
<div class="elgg-col elgg-col-1of5">

<div class="leftbar">
<ul >
<li style="padding:5px"><a href="/"><font color="black">Home</font></a></li>
<li style="padding:5px"><a href="activity"><font color="black">Activity</font></a></li>
	<li style="padding:5px"><a href="/friends/<?php echo $name?>"><font color="black">Collaborators</font></a></li>
	<li style="padding:5px"><a href="/groups/all"><font color="black">Groups</font></a></li>
	
	<li style="padding:5px"><a href="/blog/all"><font color="black">Blog</font></a></li>
	<li style="padding:5px"><a href="/messages/inbox/<?php echo $name?>"><font color="black">Messages</font></a></li>
	<li style="padding:5px"><font color="black">Data</font>
	<ul>
	<li style="padding:6px"><a href="/upload2sci"><font color="black">Upload Data</font></a></li>
	<li style="padding:6px"><a href="/uploadStatus"><font color="black">Upload Status</font></a></li>
	<li style="padding:6px"><a href="/webservice"><font color="black">Web Services</font></a></li>
	
	</ul>
	</li>
	<li style="padding:5px"><font color="black">Analysis</font>
	<ul>
	<li style="padding:6px"><a href="/d3"><font color="black">Visualization</font></a></li>
	<li style="padding:6px"><a href="/mapping"><font color="black">Mapping</font></a></li>
	<li style="padding:6px"><a href="/table"><font color="black">Table</font></a></li>
	</ul>
	</li>

	<li style="padding:5px"><a href="/photos/siteimagesall"><font color="black">Photos</font></a></li>
	<li style="padding:5px"><a href="/file"><font color="black">Files</font></a></li>
	</ul>
	</div>
	</div>
	<div class="elgg-col elgg-col-3of5">
	
		<div class="elgg-inner pvm prl">
<?php
// left column

// Top box for login or welcome message
if (elgg_is_logged_in()) {
	$top_box = "<h2>" . elgg_echo("welcome") . " ";
	$top_box .= elgg_get_logged_in_user_entity()->name;
	$top_box .= "</h2>";
   
} else {
	$top_box = $vars['login'];
}





echo elgg_view_module('featured',  '', $top_box, $mod_params);

// a view for plugins to extend
echo elgg_view("index/lefthandside");



// files
echo elgg_view_module('featured',  elgg_echo("custom:members"), $vars['members'], $mod_params);
// files
if (elgg_is_active_plugin('file')) {
	echo elgg_view_module('featured',  elgg_echo("custom:files"), $vars['files'], $mod_params);
}

// groups
if (elgg_is_active_plugin('groups')) {
	echo elgg_view_module('featured',  elgg_echo("custom:groups"), $vars['groups'], $mod_params);
}
// a view for plugins to extend
echo elgg_view("index/righthandside");



// groups
if (elgg_is_active_plugin('blog')) {
	echo elgg_view_module('featured',  elgg_echo("custom:blogs"), $vars['blogs'], $mod_params);
}

// files
if (elgg_is_active_plugin('activity')) {
	echo elgg_view_module('featured',  elgg_echo("custom:activity"), $vars['activity'], $mod_params);
}
?>
		</div>
	</div>
	
	<div class="elgg-col elgg-col-1of5">
		<div class="elgg-inner pvm">
<?php
// right column


?>
		</div>
	</div>
</div>
