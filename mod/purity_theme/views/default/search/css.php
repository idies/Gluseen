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
    ?><style><?php }
?>

    /**********************************
    Search plugin
    ***********************************/
    .elgg-page-header .elgg-search {
        bottom: 57px;
        height: 31px;
        position: absolute;
        right: 10px;
        background:url(<?php echo $vars['url']; ?>mod/purity_theme/graphics/search.png) no-repeat;
        padding-right:60px;
    }
    .front_left {
        width:420px;
        margin-left:50px;
    }
    .front_right {
        width:420px;
        margin-right:50px;
    }
    .search-input {
        border:none;
    }
    .elgg-page-header .elgg-search input[type=text] {
        width: 166px;
    }
    .elgg-page-header .elgg-search input[type=submit] {
        display: none;
    }
    .elgg-search input[type=text] {
        color: #333;
        font-size: 12px;
        font-weight: bold;
        padding: 2px 4px 2px 26px;
        background: transparent url(<?php echo elgg_get_site_url(); ?>mod/purity_theme/graphics/glyphicons/png/glyphicons_027_search.png) no-repeat 0px 0px;
        margin-top:6px;
        margin-left:6px;
        background-size:contain;
    }
    .elgg-search input[type=text]:focus, .elgg-search input[type=text]:active {
        color: #0054A7;
        border:none;
    }

    .search-list li {
        padding: 5px 0 0;
    }
    .search-heading-category {
        margin-top: 20px;
        color: #666666;
    }

    .search-highlight {
        background-color: #bbdaf7;
    }
    .search-highlight-color1 {
        background-color: #bbdaf7;
    }
    .search-highlight-color2 {
        background-color: #A0FFFF;
    }
    .search-highlight-color3 {
        background-color: #FDFFC3;
    }
    .search-highlight-color4 {
        background-color: #ccc;
    }
    .search-highlight-color5 {
        background-color: #4690d6;
    }
