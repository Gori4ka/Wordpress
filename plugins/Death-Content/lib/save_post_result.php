<?php

function edit_update_result($cases_id) {
    global $wpdb;
    if (!wp_verify_nonce($_GET['_wpnonce'], 'cases_edit_nonce')) {
        return false;
    }
    $language = Helper::gat_language($_GET['lang']);
    if ($language != CasesLanguage::hy) {
        $lang = $language;
        $column_name = 'id_base';
        $idbase = 'id_trans';
    } else {
        $lang = CasesLanguage::en;
        $column_name = 'id_trans';
        $idbase = 'id_base';
    }

    if (isset($_POST['frst_name']) && $_POST['frst_name']) {
        $query_args['frst_name'] = $_POST['frst_name'];
    }
    if (isset($_POST['last_name']) && $_POST['last_name']) {
        $query_args['last_name'] = $_POST['last_name'];
    }
    if (isset($_POST['date']) && $_POST['date']) {
        $query_args['date'] = $_POST['date'];
        $query_args_trans['date'] = $_POST['date'];
    }
    if (isset($_POST['country_id']) && (int) $_POST['country_id']) {
        $query_args['country_id'] = (int) $_POST['country_id'];
        $country_trans_id = $wpdb->get_var($wpdb->prepare('SELECT ' . $column_name . ' FROM ' . $wpdb->prefix . 'cases_translate WHERE ' . $idbase . '=%d  AND lang=%s AND type=%s', array((int) $_POST['country_id'], $lang, 'country')));
        $query_args_trans['country_id'] = $country_trans_id;
    }
    if (isset($_POST['region_id']) && (int) $_POST['region_id']) {
        $query_args['region_id'] = (int) $_POST['region_id'];
        $region_trans_id = $wpdb->get_var($wpdb->prepare('SELECT ' . $column_name . ' FROM ' . $wpdb->prefix . 'cases_translate WHERE ' . $idbase . '=%d  AND lang=%s AND type=%s', array((int) $_POST['region_id'], $lang, 'region')));
        $query_args_trans['region_id'] = $region_trans_id;
    }
    if (isset($_POST['unit_id']) && (int) $_POST['unit_id']) {
        $query_args['unit_id'] = (int) $_POST['unit_id'];
        $unit_trans_id = $wpdb->get_var($wpdb->prepare('SELECT ' . $column_name . ' FROM ' . $wpdb->prefix . 'cases_translate WHERE ' . $idbase . '=%d  AND lang=%s AND type=%s', array((int) $_POST['unit_id'], $lang, 'unit')));
        $query_args_trans['unit_id'] = $unit_trans_id;
    }
    if (isset($_POST['capitan']) && $_POST['capitan']) {
        $query_args['capitan'] = $_POST['capitan'];
    }
    if (isset($_POST['capitan_rank_id']) && (int) $_POST['capitan_rank_id']) {
        $query_args['capitan_rank_id'] = (int) $_POST['capitan_rank_id'];
        $capitan_rank_trans_id = $wpdb->get_var($wpdb->prepare('SELECT ' . $column_name . ' FROM ' . $wpdb->prefix . 'cases_translate WHERE ' . $idbase . '=%d  AND lang=%s AND type=%s', array((int) $_POST['capitan_rank_id'], $lang, 'rank')));
        $query_args_trans['capitan_rank_id'] = $capitan_rank_trans_id;
    }
    if (isset($_POST['content']) && $_POST['content']) {
        $query_args['content'] = $_POST['content'];
    }
    if (isset($_POST['reason_id']) && (int) $_POST['reason_id']) {
        $query_args['reason_id'] = (int) $_POST['reason_id'];
        $reason_trans_id = $wpdb->get_var($wpdb->prepare('SELECT ' . $column_name . ' FROM ' . $wpdb->prefix . 'cases_translate WHERE ' . $idbase . '=%d  AND lang=%s AND type=%s', array((int) $_POST['reason_id'], $lang, 'reason')));
        $query_args_trans['reason_id'] = $reason_trans_id;
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
        $query_args['status'] = (int) $_POST['status'];
        $query_args_trans['status'] = $_POST['status'];
    }
    if (isset($_POST['content_type']) && $_POST['content_type']) {
        $query_args['content_type'] = $_POST['content_type'];
        $query_args_trans['content_type'] = $_POST['content_type'];
    }
    if (isset($_POST['cases_type'])) {
        $query_args['cases_type'] = (int) $_POST['cases_type'];
        $query_args_trans['cases_type'] = $_POST['cases_type'];
    }
    if (isset($_POST['content_add']) && $_POST['content_add']) {
        $query_args['content_add'] = $_POST['content_add'];
    }
    if (isset($_POST['user_content']) && $_POST['user_content']) {
        $query_args['user_content'] = $_POST['user_content'];
    }

    $result = $wpdb->update($wpdb->prefix . 'cases', $query_args, array('id' => $cases_id));
    $update_trans_id = $wpdb->get_var($wpdb->prepare('SELECT ' . $column_name . ' FROM ' . $wpdb->prefix . 'cases_translate WHERE ' . $idbase . '=%d  AND lang=%s AND type=%s', array($cases_id, $lang, 'cases')));
    if ($update_trans_id) {
        $wpdb->update($wpdb->prefix . 'cases', $query_args_trans, array('id' => $update_trans_id));
        $wpdb->query('DELETE FROM ' . $wpdb->prefix . 'cases_media where cases_id=' . $update_trans_id);
    }
    $wpdb->query('DELETE FROM ' . $wpdb->prefix . 'cases_media where cases_id=' . $cases_id);
    if (isset($_POST['media_ids']) && (int) $_POST['media_ids']) {
        $media_ids = explode(",", $_POST['media_ids']);
        if ($media_ids) {
            foreach ($media_ids as $media_id) {
                $featured = 0;
                if (isset($_POST['featured_id']) && (int) $_POST['featured_id'] > 0 && (int) $_POST['featured_id'] == $media_id) {
                    $featured = 1;
                }
                $result_media = $wpdb->insert($wpdb->prefix . 'cases_media', array('cases_id' => $cases_id, 'media_id' => $media_id, 'is_featured' => $featured));
                if($update_trans_id){
                  $wpdb->insert($wpdb->prefix . 'cases_media', array('cases_id' => $update_trans_id, 'media_id' => $media_id, 'is_featured' => $featured));
                }
                $media_date['post_date'] = '2010-01-01 12:00:00';
                $media_date['post_date_gmt'] = '2010-01-01 12:00:00';
                $wpdb->update($wpdb->prefix . 'posts', $media_date, array('id' => $media_id));
            }
        }
    }

    if ($result || $result_media) {
        Helper::redirect_to_cases_main_page();
    } else {
        Helper::redirect_to_cases_edit_page($cases_id);
    }
}
