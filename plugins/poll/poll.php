<?php

/*
  Plugin Name: Poll
  Plugin URI: 
  Description: Plugin for creating polls
  Version: 1.0
  Author: Artush Mkrtchyan
  Author URI: 
 */

include('functions.php');
include('includes/poll-widget.php');



add_action('admin_enqueue_scripts', 'poll_admin_scripts_init');


//add_action('admin_init', 'poll_admin_scripts_init');
add_action('init', 'poll_frontend_scripts_init');
add_action('admin_menu', 'register_poll_index');

register_activation_hook(__FILE__, 'activation_poll_plugin');

global $site_url;
$site_url = get_site_url();

function register_poll_index() {
    add_menu_page('Polls', 'Polls', 'manage_categories', 'poll', 'poll_admin_page', null, 26);
    add_submenu_page('poll', 'Add New Poll', 'Add New Poll', 'manage_categories', 'new_poll', 'poll_add_page');
    add_submenu_page('update_poll', 'Update Poll', null, 'manage_categories', 'update_poll', 'poll_update_page');
}

function activation_poll_plugin() {
    global $wpdb;
    if ($wpdb->get_var("show tables like '" . $wpdb->prefix . "poll'") != $wpdb->prefix . 'pol') {

        $query = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "poll` ("
                . "`id` INT NOT NULL AUTO_INCREMENT ,"
                . "`question` varchar(255) CHARACTER SET utf8 default '0',"
                . "`user_id` INT NOT NULL default '0' ,"
                . "`start_date` date DEFAULT '0000-00-00' NOT NULL,"
                . "`end_date` date DEFAULT '0000-00-00' NOT NULL,"
                . "`type` INT NOT NULL default '0' ,"
                . "`status` INT NOT NULL default '0' ,"
                . "`state` INT NOT NULL default '0' ,"
                . "PRIMARY KEY ( `id` )"
                . ")";
        $wpdb->query($query);
    }

    if ($wpdb->get_var("show tables like '" . $wpdb->prefix . "poll_answer'") != $wpdb->prefix . 'poll_answer') {

        $query = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "poll_answer` ("
                . "`id` INT NOT NULL AUTO_INCREMENT ,"
                . "`poll_id` INT NOT NULL default '0' ,"
                . "`answer` varchar(255) CHARACTER SET utf8 default '0',"
                . "`total_count` INT NOT NULL default '0' ,"
                . "PRIMARY KEY ( `id` )"
                . ")";
        $wpdb->query($query);
    }

    if ($wpdb->get_var("show tables like '" . $wpdb->prefix . "poll_user'") != $wpdb->prefix . 'poll_user') {

        $query = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "poll_user` ("
                . "`id` INT NOT NULL AUTO_INCREMENT ,"
                . "`poll_id` INT NOT NULL default '0' ,"
                . "`user_email` varchar(255) CHARACTER SET utf8 default 'null',"
                . "`user_ip` varchar(255) CHARACTER SET utf8 default '0',"
                . "PRIMARY KEY ( `id` )"
                . ")";
        $wpdb->query($query);
    }

    if ( null === $wpdb->get_row( "SELECT post_name FROM " . $wpdb->prefix . "posts WHERE post_name = 'polls'", 'ARRAY_A' ) ) {

        $page = array(
          'post_title'  => 'Polls',
          'post_status' => 'publish',
          'post_content' => '[poll_list_shortcode]',
          'post_type'   => 'page'
        );
        $poll_page_id = wp_insert_post($page);
    }
}

register_uninstall_hook( __FILE__, 'poll_uninstall_hook' );

function poll_uninstall_hook(){
  global $wpdb;
  $wpdb->query('DROP TABLE IF EXITS' . $wpdb->prefix . 'poll');
  $wpdb->query('DROP TABLE IF EXITS' . $wpdb->prefix . 'poll_answer');
  $wpdb->query('DROP TABLE IF EXITS' . $wpdb->prefix . 'poll_user');
}

function poll_admin_scripts_init($hook_suffix) {

    if ($hook_suffix == 'polls_page_new_poll' || $hook_suffix == 'toplevel_page_poll' || $hook_suffix == 'admin_page_update_poll') {
        $pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
        wp_enqueue_style('bootstrap', $pluginfolder . '/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap-theme', $pluginfolder . '/css/bootstrap-theme.min.css');
        wp_enqueue_style('bootstrap-select', $pluginfolder . '/css/bootstrap-select.min.css');
        wp_enqueue_style('bootstrap-select', $pluginfolder . '/css/bootstrap-select.min.css');
        wp_enqueue_style('bootstrap-select', $pluginfolder . '/css/bootstrap-datetimepicker.min.css');
        wp_enqueue_style('poll-plugin-style', $pluginfolder . '/css/style.css');
        wp_enqueue_script('bootstrap', $pluginfolder . '/js/bootstrap.min.js', array('jquery'), null, true);
        wp_enqueue_script('bootstrap-select', $pluginfolder . '/js/bootstrap-select.min.js', array('jquery'), null, true);
    }
}

function poll_frontend_scripts_init() {
    $pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
    wp_enqueue_script('moment', $pluginfolder . '/js/moment.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootstrap-datetimepicker', $pluginfolder . '/js/bootstrap-datetimepicker.min.js', array('jquery'), null, true);
    wp_enqueue_script('jquery-form-poll', $pluginfolder . '/js/jquery.form.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootbox', $pluginfolder . '/js/bootbox.min.js', array('jquery'), null, true);
    wp_enqueue_script('poll-js', $pluginfolder . '/js/site.js', array('jquery'), null, true);
}

//only for development. Uncomment the line above and change poll_cookie_ ids to delete created cookies
//add_action( 'init', 'my_deletecookie' );

function my_deletecookie() {
    setcookie('poll_cookie_10', '', time() - 60 * 60 * 24 * 30, COOKIEPATH, COOKIE_DOMAIN);
    setcookie('poll_cookie_5', '', time() - 60 * 60 * 24 * 30, COOKIEPATH, COOKIE_DOMAIN);
    setcookie('poll_cookie_7', '', time() - 60 * 60 * 24 * 30, COOKIEPATH, COOKIE_DOMAIN);
}
?>
