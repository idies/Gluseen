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
echo '<div style="width:990px;margin:0px auto;position:relative;">';
echo '<ul class="elgg-system-messages">';

// hidden li so we validate
echo '<li class="hidden"></li>';

if (isset($vars['object']) && is_array($vars['object']) && sizeof($vars['object']) > 0) {
    foreach ($vars['object'] as $type => $list) {
        foreach ($list as $message) {
            echo "<li class=\"elgg-message elgg-state-$type\">";
            echo autop($message);
            echo '</li>';
        }
    }
}

echo '</ul></div>';
