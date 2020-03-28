<?php

function delete($deleteID) {
    global $wpdb;
  if(!wp_verify_nonce( $_GET['_wpnonce'], 'delete_nonce' ) ){
    return false;
  }
    $trans = $wpdb->get_var($wpdb->prepare('SELECT id_trans FROM ' . $wpdb->prefix . 'cases_translate WHERE id_base= %d AND lang=%s AND type=%s ', array($deleteID, "en", "cases")));
    if ($trans) {
        $wpdb->delete($wpdb->prefix . 'cases', array('id' => $trans));
        $wpdb->delete($wpdb->prefix . 'cases_translate', array('id_base' => $deleteID, 'id_trans' => $trans, 'type' => 'cases'));
        $wpdb->delete($wpdb->prefix . 'cases_media', array('cases_id' => $trans));
    }
    $wpdb->delete($wpdb->prefix . 'cases', array('id' => $deleteID));
    $wpdb->delete($wpdb->prefix . 'cases_translate', array('id_base' => $deleteID, 'id_trans' => $deleteID, 'type' => 'cases'));
    $wpdb->delete($wpdb->prefix . 'cases_media', array('cases_id' => $deleteID));
    Helper::redirect_to_cases_main_page();
}
