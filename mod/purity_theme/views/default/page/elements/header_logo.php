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
$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
$site_description = $site->description;
?>

<h1 style="float:left;margin-top:10px;">
    <a class="elgg-heading-site" href="<?php echo $site_url; ?>">
        <img src="<?php echo $site_url . 'mod/purity_theme/graphics/logo2.png'; ?>" width="533" height="100">
    </a>
</h1>
<div style="clear:left;"></div>
<p style="float:left;margin-left:20px;"><?php echo $site_description; ?></p>
