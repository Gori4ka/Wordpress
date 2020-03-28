<?php

function save_incident_content() {
    global $wpdb;
    check_ajax_referer('frontend_ajax_security', 'security');
    if (isset($_POST['action']) && $_POST['action'] == "save_incident_content") {
        $attach_id = null;
        if (isset($_FILES["pic"]) && file_exists($_FILES["pic"]["tmp_name"]) && Helper::check_allowed_mimetypes($_FILES["pic"]["type"])) {
            $upload_dir = wp_upload_dir('2010/01');
            $info = new SplFileInfo($_FILES["pic"]["name"]);
            $new_file_name = uniqid() . '.' . $info->getExtension();
            $new_file_path = $upload_dir['path'] . '/' . $new_file_name;
            if (copy($_FILES["pic"]["tmp_name"], $new_file_path)) {
                $filetype = wp_check_filetype(basename($new_file_path), null);
                $attachment = array(
                    'guid' => $upload_dir['url'] . '/' . basename($new_file_path),
                    'post_mime_type' => $filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($new_file_path)),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $new_file_path, 0);
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                $attach_data = wp_generate_attachment_metadata($attach_id, $new_file_path);
                wp_update_attachment_metadata($attach_id, $attach_data);
            }
        }

        if (isset($_POST['cases']) && (int)$_POST['cases']) {
          if((int)$_POST['cases'] == 1){
            $query_args['cases_type'] = 1;
          }else{
            $query_args['cases_type'] = 0;
          }
        }
        if (isset($_POST['name']) && $_POST['name']) {
            $query_args['frst_name'] = $_POST['name'];
        }
        if (isset($_POST['surname']) && $_POST['surname']) {
            $query_args['last_name'] = $_POST['surname'];
        }
        if (isset($_POST['date']) && $_POST['date']) {
            $query_args['date'] = $_POST['date'];
        }
        if (isset($_POST['filter_location']) && (int) $_POST['filter_location']) {
            $query_args['country_id'] = (int) $_POST['filter_location'];
        }
        if (isset($_POST['filter_region']) && (int) $_POST['filter_region']) {
            $query_args['region_id'] = (int) $_POST['filter_region'];
        }elseif (isset($_POST['lang']) && $_POST['lang'] == 'en') {
          $query_args['region_id'] = 38;
        }else{
          $query_args['region_id'] = 39;
        }
        if (isset($_POST['unit']) && $_POST['unit']) {
            $unit_id = $wpdb->get_var($wpdb->prepare('SELECT c.id FROM ' . $wpdb->prefix . 'cases_unit as c'
                            . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND t.type = %s AND c.name = %s', array("hy", "unit", $_POST['unit'])));
            if ($unit_id) {
                $query_args['unit_id'] = $unit_id;
            }elseif(isset($_POST['filter_region']) && (int) $_POST['filter_region']){
              $wpdb->query($wpdb->prepare(
                          "INSERT INTO " . $wpdb->prefix . "cases_unit
              ( region_id, name )
              VALUES ( %d, %s )",
                          (int) $_POST['filter_region'], $_POST['unit']
              ));
              if ($wpdb->insert_id) {
                $query_args['unit_id'] = $wpdb->insert_id;
                  $casesTranslate = array(
                      'id_base' => $wpdb->insert_id,
                      'id_trans' => $wpdb->insert_id,
                      'lang' => ICL_LANGUAGE_CODE,
                      'type' => 'unit'
                  );
                  $wpdb->insert($wpdb->prefix . 'cases_translate', $casesTranslate);
            }
          }
        }
        if (isset($_POST['officer']) && $_POST['officer']) {
            $query_args['capitan'] = $_POST['officer'];
        }
        if (isset($_POST['officer_status']) && (int) $_POST['officer_status']) {
            $query_args['capitan_rank_id'] = (int) $_POST['officer_status'];
        }
        if (isset($_POST['details']) && $_POST['details']) {
            $query_args['content'] = $_POST['details'];
        }
        if (isset($_POST['death_reason']) && (int) $_POST['death_reason']) {
            $query_args['reason_id'] = (int) $_POST['death_reason'];
        }
        if (isset($_POST['applicant_name']) && $_POST['applicant_name']) {
            $query_args['Providers_name'] = $_POST['applicant_name'];
        }
        if (isset($_POST['applicant_surname']) && $_POST['applicant_surname']) {
            $query_args['Providers_last_name'] = $_POST['applicant_surname'];
        }
        if (isset($_POST['applicant_phone']) && $_POST['applicant_phone']) {
            $query_args['Providers_phone'] = $_POST['applicant_phone'];
        }
        if (isset($_POST['applicant_email']) && $_POST['applicant_email']) {
            $query_args['Providers_email'] = $_POST['applicant_email'];
        }
        $query_args['content_add'] = 1;
        $wpdb->insert($wpdb->prefix . 'cases', $query_args);
        $inserted_id = $wpdb->insert_id;


        if ($inserted_id) {
            add_inserted_incident_to_translate($inserted_id);
            if ($attach_id) {
                add_inserted_incident_media($inserted_id, $attach_id);
            }
            wp_send_json(array('status' => 'ok', 'message' => __('Your request success send', 'cases')));
        } else {
            wp_send_json(array('status' => 'error', 'message' => __('Your request faild send', 'cases')));
        }
        die();
    }
}

function add_inserted_incident_media($id, $media_id) {
    global $wpdb;
    $cases_media = array(
        'cases_id' => $id,
        'media_id' => $media_id,
        'is_featured' => 1
    );
    $wpdb->insert($wpdb->prefix . 'cases_media', $cases_media);
}

function add_inserted_incident_to_translate($id) {
    global $wpdb;
    $cases_translate = array(
        'id_base' => $id,
        'id_trans' => $id,
        'lang' => ICL_LANGUAGE_CODE,
        'type' => 'cases'
    );
    $wpdb->insert($wpdb->prefix . 'cases_translate', $cases_translate);
}

add_action('wp_ajax_save_incident_content', 'save_incident_content');
add_action('wp_ajax_nopriv_save_incident_content', 'save_incident_content');
