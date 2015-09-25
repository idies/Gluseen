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
if (false) {
    ?><style><?php } ?>
    /* **************************
            BUTTONS
    ************************** */

    /* Base */
    .elgg-button {
        font-size: 14px;
        font-weight: bold;
        width: auto;
        padding: 1px 4px;
        cursor: pointer;
        outline: none;

    }
    a.elgg-button {
        padding: 3px 6px;
    }

    /* Submit: This button should convey, "you're about to take some definitive action" */
    .elgg-button-submit {
        color: white;
        text-decoration: none;
        border: 1px solid #535353;
        background: #535353 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
    }

    .elgg-button-submit:hover {
        border-color: #333333;
        text-decoration: none;
        color: white;
        background: #333333 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
    }

    .elgg-button-submit.elgg-state-disabled {
        background: #999;
        border-color: #999;
        cursor: default;
    }

    /* Cancel: This button should convey a negative but easily reversible action (e.g., turning off a plugin) */
    .elgg-button-cancel {
        color: #333;
        background: #ddd url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
        border: 1px solid #999;
    }
    .elgg-button-cancel:hover {
        color: #444;
        background-color: #999;
        background-position: left 10px;
        text-decoration: none;
    }

    /* Action: This button should convey a normal, inconsequential action, such as clicking a link */
    .elgg-button-action {
        color: #fff;
        text-align: center;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        background:url(<?php echo $vars['url']; ?>mod/purity_theme/graphics/button.png) center center no-repeat;
        width:140px;
        height:27px;
        line-height:27px;
    }

    .elgg-button-action:hover,
    .elgg-button-action:focus {
        color: #fff;
        text-decoration: none;
    }

    /* Delete: This button should convey "be careful before you click me" */
    .elgg-button-delete {
        color: #bbb;
        text-decoration: none;
        border: 1px solid #333;
        background: #555 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
    }
    .elgg-button-delete:hover {
        color: #999;
        background-color: #333;
        background-position: left 10px;
        text-decoration: none;
    }

    .elgg-button-dropdown {
        text-decoration:none;
        text-align:center;
        display:block;
        font-weight:bold;
        position:relative;
        right:30px;
        top:30px;
        color: #333333;
        background:url(<?php echo $vars['url']; ?>mod/purity_theme/graphics/login.png) center center no-repeat;
        width:70px;
        height:30px;
        line-height:30px;
    }

    .elgg-button-dropdown:after {
        content: " \25BC ";
        font-size:smaller;
    }

    .elgg-button-dropdown:hover {
        text-decoration:none;
    }

    .elgg-button-dropdown.elgg-state-active {
        outline: none;
        color: #333;
    }
