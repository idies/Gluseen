<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
?>

<h1>
	<a class="elgg-heading-site" href="<?php echo $site_url; ?>">
	
	<a href=<?php echo $site_url; ?>><img src="<?php echo $site_url; ?>_graphics/logo2.png" /></a>
	
	</a>
</h1>
