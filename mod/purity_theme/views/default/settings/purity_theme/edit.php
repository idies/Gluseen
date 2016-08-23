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
$frontleft = $vars['entity']->frontleft;
if (!$frontleft)
    $frontleft = '<h2>You can edit this information in the admin section of this theme.</h2>';
$frontright = $vars['entity']->frontright;
if (!$frontright)
    $frontright = '<h2>You can edit this information in the admin section of this theme.</h2>';
?>
<div id="purity_theme_admin">
    <div style="width:760px;float:right;">
    </div>

    <div style="width:510px;float:left;">
        <label>Front left text area:</label>
        <?php
        echo elgg_view('input/longtext', array('name' => 'params[frontleft]', 'value' => $frontleft));
        ?>
        <br/>
        <label>Front right text area:</label>
        <?php
        echo elgg_view('input/longtext', array('name' => 'params[frontright]', 'value' => $frontright));
        ?>
    </div>
    <div style="clear:both;"></div>
</div>