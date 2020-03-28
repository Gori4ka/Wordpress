<?php

function filter_result() {
    global $wpdb;
    $filter = '';
    $args = array();
    if(!wp_verify_nonce( $_GET['_wpnonce'], 'cases_filter_nonce' ) ){
      return false;
    }

      if (isset($_POST['frst_name']) && $_POST['frst_name']) {
          $filter.= ' AND frst_name LIKE %s ';
          array_push($args, '%' . $_POST['frst_name'] . '%');
      }
      if (isset($_POST['last_name']) && $_POST['last_name']) {
          $filter.= ' AND last_name LIKE %s ';
          array_push($args, '%' . $_POST['last_name'] . '%');
      }
      if (isset($_POST['date']) && $_POST['date']) {
          $filter.= ' AND date LIKE %s ';
          array_push($args, '%' . $_POST['date'] . '%');
      }
      if (isset($_POST['country_id']) && $_POST['country_id']) {
          $filter.= ' AND country_id LIKE %d ';
          array_push($args,  $_POST['country_id'] );
      }
      if (isset($_POST['region_id']) && $_POST['region_id']) {
          $filter.= ' AND region_id LIKE %d ';
          array_push($args, $_POST['region_id']);
      }
      if (isset($_POST['unit_id']) && $_POST['unit_id']) {
          $filter.= ' AND unit_id LIKE %d ';
          array_push($args, $_POST['unit_id']);
      }
      if (isset($_POST['capitan']) && $_POST['capitan']) {
          $filter.= ' AND capitan LIKE %s ';
          array_push($args, $_POST['capitan']);
      }
      if (isset($_POST['capitan_rank_id']) && $_POST['capitan_rank_id']) {
          $filter.= ' AND capitan_rank_id LIKE %d ';
          array_push($args, $_POST['capitan_rank_id']);
      }
      if (isset($_POST['reason_id']) && $_POST['reason_id']) {
          $filter.= ' AND reason_id LIKE %d ';
          array_push($args, $_POST['reason_id']);
      }

      if (isset($_POST['Providers_name']) && $_POST['Providers_name']) {
          $filter.= ' AND Providers_name LIKE %s ';
          array_push($args, '%' . $_POST['Providers_name'] . '%');
      }
      if (isset($_POST['Providers_last_name']) && $_POST['Providers_last_name']) {
          $filter.= ' AND Providers_last_name LIKE %s ';
          array_push($args, '%' . $_POST['Providers_last_name'] . '%');
      }
      if (isset($_POST['Providers_phone']) && $_POST['Providers_phone']) {
          $filter.= ' AND Providers_phone LIKE %s ';
          array_push($args, '%' . $_POST['Providers_phone'] . '%');
      }
      if (isset($_POST['Providers_email']) && $_POST['Providers_email']) {
          $filter.= ' AND Providers_email LIKE %s ';
          array_push($args, '%' . $_POST['Providers_email'] . '%');
      }

      if (isset($_POST['status'])) {
        if((int)$_POST['status'] ==1 ){
            $filter.= ' AND status LIKE %d ';
            array_push($args, $_POST['status']);
          }else{
            $filter.= ' AND status LIKE %d ';
            array_push($args, 0);
          }
      }

      if (isset($_POST['content_type'])) {
        if((int)$_POST['content_type'] ==1 ){
            $filter.= ' AND content_type LIKE %d ';
            array_push($args, $_POST['content_type']);
          }else{
            $filter.= ' AND content_type LIKE %d ';
            array_push($args, 0);
          }
      }

      if (isset($_POST['cases_type'])) {
        if((int)$_POST['cases_type'] ==1 ){
            $filter.= ' AND cases_type LIKE %d ';
            array_push($args, $_POST['cases_type']);
          }else{
            $filter.= ' AND cases_type LIKE %d ';
            array_push($args, 0);
          }
      }

      array_unshift($args, CasesLanguage::hy, 'cases');
      $result = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases as c'
                      . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  WHERE t.lang= %s AND t.type = %s ' . $filter . ' ORDER BY c.id DESC', $args));
      if ($result) {
          Helper::cases_list($result, null, null, null, null);
      } else {
          echo "Not Found";
      }

}
