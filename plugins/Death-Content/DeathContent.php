<?php

/*
  Plugin Name: Death-Content
  Description:
  Version: 1.0
  Author: Edgar Marukyan, Artush Mkrtchyan
  Author URI: http://peyotto.com
  Plugin URI: http://peyotto.com
 * Text Domain: cases
 * Domain Path: /languages
 */
define('Death_Content_dir', plugin_dir_path(__FILE__));
include('dist/helpers.php');
include('dist/language.php');
include('dist/cases-type.php');
include('lib/add_incident_from_frontend.php');
include('manage_cases.php');
include('cases_request.php');

add_action('admin_init', 'cases_admin_scripts_init');
add_action('admin_menu', 'register_cases_index');
add_action('admin_menu', 'register_cases_incident_page');
add_action('admin_menu', 'register_cases_add_submenu');
add_action('admin_menu', 'register_cases_filter_page');
add_action('admin_menu', 'register_unit_list');
add_action('admin_menu', 'register_cases_request');
add_action('admin_menu', 'register_cases_delete');
add_action('admin_menu', 'register_add_new_unit');
add_action('admin_menu', 'register_edit_unit_list');
add_action('admin_menu', 'register_save_unit_result');
add_action('admin_menu', 'register_delete_unit');
add_action('admin_menu', 'register_cases_edit');
add_action('admin_menu', 'register_cases_filter_result');
add_action('admin_menu', 'register_edit_result');

register_activation_hook(__FILE__, 'cases_content_activation');

function register_cases_index() {
    add_menu_page('Cases', 'Cases', 'manage_options', 'cases_cpanel', 'cases_admin_page', $icon_url, 8);
}
function register_cases_incident_page() {
    add_submenu_page('cases_cpanel', 'Incident', 'Incident', 'manage_options', 'get_incident', 'get_incident');
}

function cases_admin_page() {
    global $wpdb;
    $pagenum = 1;
    if (isset($_GET['pagenum']) && (int) $_GET['pagenum']) {
        $pagenum = (int) $_GET['pagenum'];
    }
    $limit = 20;
    $offset = ( $pagenum - 1 ) * $limit;
    $array = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where lang= %s AND type = %s AND cases_type=%d ORDER BY id DESC  LIMIT ' . $limit . ' OFFSET ' . $offset, array(CasesLanguage::hy, "cases", 0)));
    Helper::cases_list($array, $offset, $limit, 0, 'cases_cpanel');
}

function get_incident() {
    global $wpdb;
    $pagenum = 1;
    if (isset($_GET['pagenum']) && (int) $_GET['pagenum']) {
        $pagenum = (int) $_GET['pagenum'];
    }
    $limit = 20;
    $offset = ( $pagenum - 1 ) * $limit;
    $array = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where lang= %s AND type = %s AND cases_type=%d ORDER BY id DESC  LIMIT ' . $limit . ' OFFSET ' . $offset, array(CasesLanguage::hy, "cases", 1)));
    Helper::cases_list($array, $offset, $limit, 1, 'get_incident');
}

function cases_content_activation() {
    global $wpdb;
    if ($wpdb->get_var("show tables like '" . $wpdb->prefix . "cases'") != $wpdb->prefix . 'cases') {

        $query = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "cases` ("
                . "`id` INT NOT NULL AUTO_INCREMENT ,"
                . "`frst_name` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`last_name` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`date` date DEFAULT '0000-00-00' NOT NULL,"
                . "`country_id` INT NOT NULL default '0' ,"
                . "`region_id` INT NOT NULL default '0' ,"
                . "`unit_id` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`capitan` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`capitan_rank_id` INT NOT NULL default '0' ,"
                . "`content` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`reason_id` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`reason_text` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`Providers_name` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`Providers_last_name` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`Providers_phone` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`Providers_email` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`status` INT NOT NULL default '0' ,"
                . "`content_type` INT NOT NULL default '0' ,"
                . "`cases_type` INT NOT NULL default '0' ,"
                . "`created_date` date DEFAULT '0000-00-00' NOT NULL,"
                . "`content_add` INT NOT NULL default '0' ,"
                . "`session_key` varchar(255) CHARACTER SET utf8 default '0' ,"
                . "`admin_view` INT NOT NULL default '0' ,"
                . "PRIMARY KEY ( `id` )"
                . ")";
        $wpdb->query($query);
    }
}

function load_wp_media_files() {
    wp_enqueue_media();
}

add_action('admin_enqueue_scripts', 'load_wp_media_files');

function cases_admin_scripts_init() {
    $pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
    wp_enqueue_style('admin', $pluginfolder . '/css/bootstrap.min.css');
    wp_enqueue_style('datepicker', $pluginfolder . '/css/bootstrap-datepicker3.min.css');
    wp_enqueue_style('tether-theme-basi', $pluginfolder . '/css/tether-theme-basic.min.css');
    wp_enqueue_style('tether-theme-arrows', $pluginfolder . '/css/tether-theme-arrows.min.css');
    wp_enqueue_style('tether-theme-arrows-dark', $pluginfolder . '/css/tether-theme-arrows-dark.min.css');
    wp_enqueue_style('style', $pluginfolder . '/css/style.css');
    wp_enqueue_script('Tetr', $pluginfolder . '/js/tether.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootstrap', $pluginfolder . '/js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('datepicker', $pluginfolder . '/js/bootstrap-datepicker.min.js', array('jquery'), null, true);
    wp_enqueue_script('child', $pluginfolder . '/js/slect_child.js', array('jquery'), null, true);
    wp_enqueue_script('function', $pluginfolder . '/js/function.js', array('jquery', 'datepicker'), null, true);
}

function get_frontend_cases_search() {
    return Helper::get_frontend_search();
}

add_action('wp_ajax_frontend_cases_search', 'get_frontend_cases_search');
add_action('wp_ajax_nopriv_frontend_cases_search', 'get_frontend_cases_search');
