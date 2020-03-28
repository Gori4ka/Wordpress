<?php
function save_unit_result(){
  global $wpdb;
  if (!wp_verify_nonce($_GET['_wpnonce'], 'save_unit_nonce')) {
      return false;
  }
  if (isset($_POST['unit']) && $_POST['unit'] && isset($_POST['region_id']) && (int) $_POST['region_id']) {
    if(isset($_POST['region_id']) && (int)$_POST['region_id']){
      $query_args['region_id'] = (int)$_POST['region_id'];
    }
    if(isset($_POST['unit']) && $_POST['unit']){
      $query_args['name'] = $_POST['unit'];
    }

    $results = $wpdb->update($wpdb->prefix . 'cases_unit', $query_args, array('id' => $_GET['id']));
    if($results){
      Helper::redirect_to_cases_unit_page();
    }
  }
}
