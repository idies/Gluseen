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
if (elgg_get_context() == 'admin') {
    elgg_deprecated_notice("admin plugins should route through 'admin'.", 1.8);
    elgg_admin_add_plugin_settings_menu();
    elgg_unregister_css('elgg');
    echo elgg_view('page/admin', $vars);
    return true;
}

// Set the content type
header("Content-type: text/html; charset=UTF-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php echo elgg_view('page/elements/head', $vars); ?>
    </head>
    <body>
        <div class="elgg-page elgg-page-default">
            <div class="elgg-page-messages">
                <?php echo elgg_view('page/elements/messages', array('object' => $vars['sysmessages'])); ?>
            </div>


            <div class="elgg-page-header">
                <div class="elgg-inner">
                    <?php echo elgg_view('page/elements/header', $vars); ?>
                </div>
            </div>
            <div class="elgg-page-body">
                <div class="elgg-inner">
                    <?php echo elgg_view('page/elements/body', $vars); ?>
                </div>
            </div>
            <div class="elgg-page-footer">
                <div class="elgg-inner">
                    <?php echo elgg_view('page/elements/footer', $vars); ?>
                </div>
            </div>
        </div>
        <?php echo elgg_view('page/elements/foot'); ?>
    </body>
</html>