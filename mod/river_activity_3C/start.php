<?php
	/*
	 * 3 Column River Acitivity
	 *
	 * @package ElggRiverDash
	 * Full Creadit goes to ELGG Core Team for creating a beautiful social networking script
	 *
         * Modified by Satheesh PM, BARC, Mumbai, India..
         * http://satheesh.anushaktinagar.net
         *
	 * @author ColdTrick IT Solutions
	 * @copyright Coldtrick IT Solutions 2009
	 * @link http://www.coldtrick.com/
	 * @version 1.0
         *
         */

elgg_register_event_handler('init', 'system', 'river_activity_3C_init');

function river_activity_3C_init() {

    elgg_extend_view('css/elgg', 'river_activity_3C/css');
    elgg_extend_view('css/admin', 'river_activity_3C/admin');

//Register Plugin Hook to Send Birthday Message.
if (elgg_get_plugin_setting('send_wishes','river_activity_3C') == 'yes'){    
    elgg_register_plugin_hook_handler('cron', 'daily', 'river_activity_3C_bday_mailer');
}

//Register the java scripts for Message Rotation if Ads Rotator plugin is not installed  
if (!elgg_is_active_plugin('Ads')){
    elgg_register_js('jquery.jshowoff.min', 'mod/river_activity_3C/js/jquery.jshowoff.min.js', 'head');
    elgg_load_js('jquery.jshowoff.min');
}

//Extend the views in sidebar and sidebar_alt
if ((elgg_is_logged_in()) && (elgg_get_context() == 'activity')){
    $default = '700';

    //Showing Site Status
    if (elgg_get_plugin_setting('show_status','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('status_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/site_status',$default + (int)elgg_get_plugin_setting('status_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/site_status',$default + (int)elgg_get_plugin_setting('status_pir','river_activity_3C'));
    }}

    //Showing Horoscope
    if (elgg_get_plugin_setting('show_horoscope','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('horoscope_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/horoscope',$default + (int)elgg_get_plugin_setting('horoscope_pir','river_activity_3C'));
    }else {
        elgg_extend_view('page/elements/sidebar', 'page/elements/horoscope',$default + (int)elgg_get_plugin_setting('horoscope_pir','river_activity_3C'));
    }}

    //Shows New Groups
    if (elgg_get_plugin_setting('show_latest_group','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('latest_group_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/newgroups',$default + (int)elgg_get_plugin_setting('latest_group_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/newgroups',$default + (int)elgg_get_plugin_setting('latest_group_pir','river_activity_3C'));
    }}

    //Shows Featured Groups
    if (elgg_get_plugin_setting('show_featured_group','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('featured_group_pos','river_activity_3C') == 'left') {
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/featuredgroup',$default + (int)elgg_get_plugin_setting('featured_group_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/featuredgroup',$default + (int)elgg_get_plugin_setting('featured_group_pir','river_activity_3C'));
    }}

    //Shows Group Memberships
    if (elgg_get_plugin_setting('show_group_membership','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('group_membership_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/groupmembership',$default + (int)elgg_get_plugin_setting('group_membership_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/groupmembership',$default + (int)elgg_get_plugin_setting('group_membership_pir','river_activity_3C'));
    }}

    //Shows Bookmarks
    if (elgg_get_plugin_setting('show_bookmark','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('bookmark_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/bookmark',$default + (int)elgg_get_plugin_setting('bookmark_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/bookmark',$default + (int)elgg_get_plugin_setting('bookmark_pir','river_activity_3C'));
    }}
    
    //Shows Blogs
    if (elgg_get_plugin_setting('show_blog','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('blog_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/blogs',$default + (int)elgg_get_plugin_setting('blog_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/blogs',$default + (int)elgg_get_plugin_setting('blog_pir','river_activity_3C'));
    }}

    //Shows Files
    if (elgg_get_plugin_setting('show_file','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('file_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/files',$default + (int)elgg_get_plugin_setting('file_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/files',$default + (int)elgg_get_plugin_setting('file_pir','river_activity_3C'));
    }}

    //Shows Top Pages
    if (elgg_get_plugin_setting('show_page','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('page_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/pages',$default + (int)elgg_get_plugin_setting('page_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/pages',$default + (int)elgg_get_plugin_setting('page_pir','river_activity_3C'));
    }}
    
    
    //Shows photo
    if (elgg_get_plugin_setting('show_photo','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('photo_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/photo',$default + (int)elgg_get_plugin_setting('photo_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/photo',$default + (int)elgg_get_plugin_setting('photo_pir','river_activity_3C'));
    }}
    
    //Shows Videos
    if (elgg_get_plugin_setting('show_video','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('video_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/video',$default + (int)elgg_get_plugin_setting('video_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/video',$default + (int)elgg_get_plugin_setting('video_pir','river_activity_3C'));
    }}
    
    //Shows HTML Box
    if (elgg_get_plugin_setting('show_html','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('html_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/htmlbox',$default + (int)elgg_get_plugin_setting('html_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/htmlbox',$default + (int)elgg_get_plugin_setting('html_pir','river_activity_3C'));
    }}
    
    //Any Entitys River Box
    if (elgg_get_plugin_setting('show_anyentity','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('anyentity_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/anyentitys',$default + (int)elgg_get_plugin_setting('anyentity_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/anyentitys',$default + (int)elgg_get_plugin_setting('anyentity_pir','river_activity_3C'));
    }}
    
    //Shows Avatar and Some Links
    if (elgg_get_plugin_setting('show_profile','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('profile_pos','river_activity_3C') == 'left'){   
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/profile',$default + (int)elgg_get_plugin_setting('profile_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/profile',$default + (int)elgg_get_plugin_setting('profile_pir','river_activity_3C'));
    }}

    //Shows Online Members
    if (elgg_get_plugin_setting('show_online_members','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('online_members_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/online',$default + (int)elgg_get_plugin_setting('online_members_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/online',$default + (int)elgg_get_plugin_setting('online_members_pir','river_activity_3C'));
    }}
    
    //Shows Online Friends
    if (elgg_get_plugin_setting('show_friends_online','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('friends_online_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/friends_online',$default + (int)elgg_get_plugin_setting('friends_online_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/friends_online',$default + (int)elgg_get_plugin_setting('friends_online_pir','river_activity_3C'));
    }}
    
    //Shows Friends
    if (elgg_get_plugin_setting('show_friends','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('friends_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/friends',$default + (int)elgg_get_plugin_setting('friends_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/friends',$default + (int)elgg_get_plugin_setting('friends_pir','river_activity_3C'));
    }}
    
    //Shows newest Members
    if (elgg_get_plugin_setting('show_recent_members','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('recent_members_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/newestmembers',$default + (int)elgg_get_plugin_setting('recent_members_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/newestmembers',$default + (int)elgg_get_plugin_setting('recent_members_pir','river_activity_3C'));
    }}

    //Shows Birthdays 
    if (elgg_get_plugin_setting('show_birthday','river_activity_3C') == 'yes'){
    if (elgg_get_plugin_setting('birthday_pos','river_activity_3C') == 'left'){
        elgg_extend_view('page/elements/sidebar_alt', 'page/elements/birthdays',$default + (int)elgg_get_plugin_setting('birthday_pir','river_activity_3C'));
    }else{
        elgg_extend_view('page/elements/sidebar', 'page/elements/birthdays',$default + (int)elgg_get_plugin_setting('birthday_pir','river_activity_3C'));
    }}
           

//Middle Column
    //Shows System Messages
    if (elgg_get_plugin_setting('show_system_messages', 'river_activity_3C') == 'yes'){
    elgg_extend_view('page/layouts/content/header', 'page/elements/site_message','100');
    }
    
    //Shows Wire
    if (elgg_get_plugin_setting('show_wire', 'river_activity_3C') == 'yes'){
    elgg_extend_view('page/layouts/content/header', 'page/elements/wire','110');
    }
    
    }

//Other settings if site layout is set to 3-Column
else if (elgg_is_logged_in() && (elgg_get_plugin_setting('view_site', 'river_activity_3C') == "3C")){
    if (elgg_get_plugin_setting('extend_sitemsg','river_activity_3C') == 'yes'){
    elgg_extend_view('page/elements/sidebar_alt', 'page/elements/site_message','700');
    }
    elgg_extend_view('page/elements/sidebar_alt', 'page/elements/online',$default + (int)elgg_get_plugin_setting('online_members_pir','river_activity_3C'));
    elgg_extend_view('page/elements/sidebar_alt', 'page/elements/friends_online',$default + (int)elgg_get_plugin_setting('friends_online_pir','river_activity_3C'));
}

//Extending site messages to right sidebar if site layout is set to 2-Column
else if (elgg_is_logged_in() && (elgg_get_plugin_setting('view_site', 'river_activity_3C') == "2C")){
    if (elgg_get_plugin_setting('extend_sitemsg','river_activity_3C') == 'yes'){
    elgg_extend_view('page/elements/sidebar', 'page/elements/site_message','700');
    }
}

//unregister message rotation if site message is not extended
else if (elgg_is_logged_in() && (elgg_get_plugin_setting('extend_sitemsg','river_activity_3C') == 'no')){
    elgg_unregister_js('jquery.jshowoff.min', 'mod/river_activity_3C/js/jquery.jshowoff.min.js', 'head');
}

}

//Functions For sending out Birthday Wishes.
function river_activity_3C_bday_mailer($hook, $entity_type, $returnvalue, $params){
        
        $bday = elgg_get_plugin_setting('birth_day', 'river_activity_3C');
        global $CONFIG;
        $siteaddress = elgg_get_site_url();
        $sitename = elgg_get_site_entity()->name;
        $site = get_entity($CONFIG->site_guid);
        
        if (($site) && (isset($site->email))) {
	        $from = $site->name;
        } else {
	        $from = 'noreply@' . get_site_domain($CONFIG->site_guid);
        }

        $bd_users = elgg_get_entities_from_metadata( array(
                'metadata_names' => $bday,
                'types' => 'user',
                'limit' => false,
                'full_view' => false,
                'pagination' => false,
        ));
        $bd_today = date('j, F', strtotime('now')); 
        
        foreach ($bd_users as $bd_user){
            $bd_name = $bd_user->name;
            $bd_email = $bd_user->email;
            $bd_day = date('j, F', strtotime($bd_user->$bday));
        if ($bd_day == $bd_today){
            $message = sprintf(elgg_echo('river_activity_3C:bday_message'), $bd_name, $bd_day, $sitename, $siteaddress);
            elgg_send_email($from, $bd_email, elgg_echo('river_activity_3C:bday_message:subject'), $message);
            }
        }
        return true;
}


?>