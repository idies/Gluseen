<?php
/**
 * Layout for main column with one sidebar
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['content'] Content HTML for the main column
 * @uses $vars['sidebar'] Optional content that is displayed in the sidebar
 * @uses $vars['title']   Optional title for main content area
 * @uses $vars['class']   Additional class to apply to layout
 * @uses $vars['nav']     HTML of the page nav (override) (default: breadcrumbs)
 */

$class = 'elgg-layout elgg-layout-one-sidebar clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

?>
<?php
 $name=elgg_get_logged_in_user_entity()->name;
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
<div class="elgg-col elgg-col-1of5">
<div class="leftbar">
<ul >
	<li style="padding:5px"><a href="/"><font color="black">Home</font></a></li>
<li style="padding:5px"><a href="/activity"><font color="black">Activity</font></a></li>
	<li style="padding:5px"><a href="/members"><font color="black">Collaborations</font></a></li>
	<li style="padding:5px"><a href="/groups/all"><font color="black">Groups</font></a></li>
	
	<li style="padding:5px"><a href="/blog/all"><font color="black">Blog</font></a></li>
	<li style="padding:5px"><font color="black">Data</font>
	<ul>
	<li style="padding:6px"><a href="/file/all"><font color="black">Upload File</font></a></li>
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
	<li style="padding:5px"><a href="/manuscript"><font color="black">Manuscripts</font></a></li>
	</ul>
	</div>
	</div>
<div class="<?php echo $class; ?>">
	<div class="elgg-sidebar">
		<?php
			echo elgg_view('page/elements/sidebar', $vars);
		?>
	</div>

	<div class="elgg-main elgg-body">
		<?php
			echo $nav;
			
			if (isset($vars['title'])) {
				echo elgg_view_title($vars['title']);
			}
			// @todo deprecated so remove in Elgg 2.0
			if (isset($vars['area1'])) {
				echo $vars['area1'];
			}
			if (isset($vars['content'])) {
				echo $vars['content'];
			}
		?>
	</div>
</div>
