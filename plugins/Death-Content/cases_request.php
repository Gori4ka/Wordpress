<?php

function save_cases_request() {
    global $wpdb;
    if (!wp_verify_nonce($_GET['_wpnonce'], 'cases_request_nonce')) {
        return false;
    }
    if (count($_POST) == 0) {
        return;
    }

    if (isset($_POST['frst_name']) && $_POST['frst_name']) {
        $query_args['frst_name'] = $_POST['frst_name'];
    }
    if (isset($_POST['last_name']) && $_POST['last_name']) {
        $query_args['last_name'] = $_POST['last_name'];
    }
    if (isset($_POST['date']) && $_POST['date']) {
        $query_args['date'] = $_POST['date'];
    }
    if (isset($_POST['country_id']) && (int)$_POST['country_id']) {
        $query_args['country_id'] = (int) $_POST['country_id'];
    }
    if (isset($_POST['region_id']) && (int)$_POST['region_id']) {
        $query_args['region_id'] = (int) $_POST['region_id'];
    }elseif (isset($_POST['lang']) && $_POST['lang'] == 'en') {
      $query_args['region_id'] = 38;
    }else{
      $query_args['region_id'] = 39;
    }
    if (isset($_POST['unit_id']) && (int)$_POST['unit_id']) {
        $query_args['unit_id'] = (int) $_POST['unit_id'];
    }
    if (isset($_POST['capitan']) && $_POST['capitan']) {
        $query_args['capitan'] = $_POST['capitan'];
    }
    if (isset($_POST['capitan_rank_id']) && (int)$_POST['capitan_rank_id']) {
        $query_args['capitan_rank_id'] = (int) $_POST['capitan_rank_id'];
    }
    if (isset($_POST['content']) && $_POST['content']) {
        $query_args['content'] = $_POST['content'];
    }
    if (isset($_POST['reason_id']) && (int)$_POST['reason_id']) {
        $query_args['reason_id'] = (int) $_POST['reason_id'];
    }
    if (isset($_POST['reason_text']) && $_POST['reason_text']) {
        $query_args['reason_text'] = $_POST['reason_text'];
    }
    if (isset($_POST['Providers_name']) && $_POST['Providers_name']) {
        $query_args['Providers_name'] = $_POST['Providers_name'];
    }
    if (isset($_POST['Providers_last_name']) && $_POST['Providers_last_name']) {
        $query_args['Providers_last_name'] = $_POST['Providers_last_name'];
    }
    if (isset($_POST['Providers_phone']) && $_POST['Providers_phone']) {
        $query_args['Providers_phone'] = $_POST['Providers_phone'];
    }
    if (isset($_POST['Providers_email']) && $_POST['Providers_email']) {
        $query_args['Providers_email'] = $_POST['Providers_email'];
    }
    if (isset($_POST['status']) && $_POST['status']) {
        $query_args['status'] = $_POST['status'];
    }
    if (isset($_POST['content_type']) && $_POST['content_type']) {
        $query_args['content_type'] = $_POST['content_type'];
    }
    if (isset($_POST['cases_type']) && $_POST['cases_type']) {
        $query_args['cases_type'] = $_POST['cases_type'];
    }

    $query_args['content_add'] = 0;
    $query_args['session_key'] = rand(date("H:i:s") * 50000, 10000000000);
    $query_args['created_date'] = date("Y-m-d H:i:s");
    $res = $wpdb->insert($wpdb->prefix . 'cases', $query_args);
    $cases_id = $wpdb->insert_id;

    if (isset($_POST['media_ids']) && (int) $_POST['media_ids']) {
        $media_ids = explode(",", $_POST['media_ids']);
        if ($media_ids) {
            $wpdb->query('DELETE FROM ' . $wpdb->prefix . 'cases_media where cases_id=' . $cases_id);
            foreach ($media_ids as $media_id) {
                $featured = 0;
                if (isset($_POST['featured_id']) && (int) $_POST['featured_id'] > 0 && (int) $_POST['featured_id'] == $media_id) {
                    $featured = 1;
                }
                $media_date['post_date'] = '2010-01-01 12:00:00';
                $media_date['post_date_gmt'] = '2010-01-01 12:00:00';
                $wpdb->update($wpdb->prefix . 'posts', $media_date, array('id' => $media_id));
                $res = $wpdb->insert($wpdb->prefix . 'cases_media', array('cases_id' => $cases_id, 'media_id' => $media_id, 'is_featured' => $featured));
            }
        }
    }



    $lang = Helper::gat_language($_POST['lang']);
    if (isset($_POST['id_base']) && (int) $_POST['id_base']) {
        $id_base = (int) $_POST['id_base'];
        $id_trans = $cases_id;
    } else {
        $id_base = $cases_id;
        $id_trans = $cases_id;
    }
    $casesTranslate = array(
        'id_base' => $id_base,
        'id_trans' => $id_trans,
        'lang' => $lang,
        'type' => 'cases'
    );
    $wpdb->insert($wpdb->prefix . 'cases_translate', $casesTranslate);
    $media_date['post_date'] = '2010-01-01 12:00:00';
    $media_date['post_date_gmt'] = '2010-01-01 12:00:00';
    $wpdb->update($wpdb->prefix . 'posts', $media_date, array('id' => (int) $_POST['media_id']));

    if ($res) {
        Helper::redirect_to_cases_main_page();
    }
}
