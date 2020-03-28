<?php
function delete_unit(){
  global $wpdb;
  if(!(isset($_GET['id']) && (int)$_GET['id'])){
    return;
  }
  $deleteID = (int)$_GET['id'];
  $trans = $wpdb->get_var($wpdb->prepare('SELECT id_trans FROM ' . $wpdb->prefix . 'cases_translate WHERE id_base= %d AND lang=%s AND type=%s ', array($deleteID, "en", "unit")));
  if ($trans) {
      $wpdb->delete($wpdb->prefix . 'cases_unit', array('id' => $trans));
      $wpdb->delete($wpdb->prefix . 'cases_translate', array('id_base' => $deleteID, 'id_trans' => $trans, 'type' => 'unit'));
  }
  $wpdb->delete($wpdb->prefix . 'cases_unit', array('id' => $deleteID));
  $wpdb->delete($wpdb->prefix . 'cases_translate', array('id_base' => $deleteID, 'id_trans' => $deleteID, 'type' => 'unit'));

  Helper::redirect_to_cases_unit_page();
}
