<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

 * 
 *  */


add_action('wp_ajax_get_user_vote_data', 'get_user_vote_data');
add_action('wp_ajax_nopriv_get_user_vote_data', 'get_user_vote_data');

function get_user_vote_data() {
    global $wpdb;
    check_ajax_referer('get_user_vote_data', 'security');
    if ($_POST['logged_in'] == 'false') {
        wp_send_json(array('status' => 'ok', 'data' => array(), 'disable_vote' => 'true'));
        wp_die();
    }
    $user_id = (int) $_POST['user_id'];
    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'vote where fb_user_id = ' . $user_id);
    wp_send_json(array('status' => 'ok', 'data' => $results, 'disable_vote' => 'false'));
    wp_die();
}

add_action('wp_ajax_set_user_vote_data', 'set_user_vote_data');
add_action('wp_ajax_nopriv_set_user_vote_data', 'set_user_vote_data');

function set_user_vote_data() {
    global $wpdb;
    check_ajax_referer('set_user_vote_data', 'security');
    $user_token = $_POST['user_token'];
    $dont_verify_user_id = $_POST['user_id'];
    $object_id = (int) $_POST['item_id'];


    $have_vote = $wpdb->get_results($wpdb->prepare(
                    'SELECT 1 
		FROM ' . $wpdb->prefix . 'vote
		WHERE fb_user_id = %s AND object_id=%d '
                    , $dont_verify_user_id, $object_id
    ));
    if (!$have_vote) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v2.9/debug_token?input_token=$user_token&access_token=1843587089295558%7C5UeIdJgSDC3N6rRPrSv6E2EUdpA");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            $result = array('status' => 'error', 'message' => 'Fb User not exist');
        } else {
            $responce = json_decode($data);
            if ($responce->data->is_valid == 'true') {
                $query_result = $wpdb->query($wpdb->prepare(
                                'INSERT INTO ' . $wpdb->prefix . 'vote ( fb_user_id, object_id )
            VALUES (  %s, %d )', $responce->data->user_id, $object_id
                ));
                $result = array('status' => 'ok', 'message' => 'Your vote is success');
            } else {
                $result = array('status' => 'error', 'message' => 'Fb User not exist');
            }
        }
        curl_close($ch);
    } else {
        $result = array('status' => 'error', 'message' => 'You alredy voted');
    }
    wp_send_json($result);
    wp_die();
}
