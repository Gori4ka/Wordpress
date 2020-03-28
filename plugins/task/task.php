<?php
/*
  Plugin Name: Task
  Plugin URI: https://github.com/artushmkrtchyan 
  Description:  Creating Task post type. Creating corresponding category Task types. Creating meta box with following fields: start date, due date, priority (high, low, normal).
  Author: Artush Mkrtchyan
  Version: 1.0
  Author URI: https://github.com/artushmkrtchyan
  Donate link: https://github.com/artushmkrtchyan
 */

include('includes/functions.php');
include('includes/functions-metabox.php');

add_action('admin_init', 'admin_scripts_init');

function admin_scripts_init() {
    $pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
    wp_enqueue_style('admin', $pluginfolder . '/css/bootstrap.min.css');
    wp_enqueue_style('datepicker', $pluginfolder . '/css/bootstrap-datepicker3.min.css');
    wp_enqueue_style('tether-theme-basi', $pluginfolder . '/css/tether-theme-basic.min.css');
    wp_enqueue_style('tether-theme-arrows', $pluginfolder . '/css/tether-theme-arrows.min.css');
    wp_enqueue_style('tether-theme-arrows-dark', $pluginfolder . '/css/tether-theme-arrows-dark.min.css');
    wp_enqueue_style('style', $pluginfolder . '/css/style.css');

    wp_enqueue_script('tether', $pluginfolder . '/js/tether.min.js');
    wp_enqueue_script('bootstrap', $pluginfolder . '/js/bootstrap.min.js');
    wp_enqueue_script('datepicker', $pluginfolder . '/js/bootstrap-datepicker.min.js');
    wp_enqueue_script('main', $pluginfolder . '/js/main.js');
}

?>