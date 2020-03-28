<?php

function unit_list() {
    global $wpdb;

    $pagenum = 1;
    if (isset($_GET['pagenum']) && (int) $_GET['pagenum']) {
        $pagenum = (int) $_GET['pagenum'];
    }
    $limit = 20;
    $offset = ( $pagenum - 1 ) * $limit;

    $UnitList = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases_unit as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND t.type = %s LIMIT ' . $limit . ' OFFSET ' . $offset, array(CasesLanguage::hy, "unit")));
    ?>
    <div class="wrap">
        <table class="wp-list-table widefat fixed striped posts">
            <h1>Units<a href="/wp-admin/admin.php?page=cases_new_unit" class="page-title-action">Add New Unit</a></h1>
            <thead>
                <tr>
                    <th width="5%">N</th>
                    <th><?php _e('Region', 'cases'); ?></th>
                    <th><?php _e('Unit', 'cases'); ?></th>
                    <th width="10%">
                        <img src="<?php echo plugins_url('../image/hy.png', __FILE__); ?>" >
                    </th>
                    <th width="10%">
                        <img src="<?php echo plugins_url('../image/en.png', __FILE__); ?>">
                    </th>
                    <th width="10%"><?php _e('Delete', 'cases'); ?></th>
                </tr>
            </thead>
            <tbody id="the-list">

                <?php
                foreach ($UnitList as $key => $unit) {
                    $region_name = $wpdb->get_var($wpdb->prepare('SELECT name FROM ' . $wpdb->prefix . 'cases_region WHERE id =%d', $unit->region_id));
                    $i = $key + 1 + 1 * $offset;
                    echo '<tr>';
                    echo '<th>' . $i . '</th>';
                    echo '<th>' . $region_name . '</th>';
                    echo '<th>' . $unit->name . '</th>';
                    echo '<th> <a href = "/wp-admin/admin.php?page=edit_unit&id=' . $unit->id . '"><span class="dashicons dashicons-edit"></span></a> </th>';
                    $trans = $wpdb->get_var($wpdb->prepare('SELECT id_trans FROM ' . $wpdb->prefix . 'cases_translate WHERE id_base = %d AND lang = %s AND type = %s', array($unit->id, "en", "unit")));
                    if ($trans) {
                        echo '<th> <a href = "/wp-admin/admin.php?page=edit_unit&id=' . $trans . '&id_base=' . $unit->id . '&lang=en"><span class="dashicons dashicons-edit"></span></a> </th>';
                    } else {
                        echo '<th> <a href = "/wp-admin/admin.php?page=cases_new_unit&id_base=' . $unit->id . '&lang=en"><span class="dashicons dashicons-plus"></span></a> </th>';
                    }
                    echo '<th> <a class="delete" href = "/wp-admin/admin.php?page=delete_unit&id=' . $unit->id . '"><span class="dashicons dashicons-trash"></span></a> </th>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    $total_count = $wpdb->get_var('SELECT count(*) FROM ' . $wpdb->prefix . 'cases_translate where lang="hy" AND type="unit"');
    Helper::cases_paginator($total_count, 5, $limit, '/wp-admin/admin.php?page=unit_list&pagenum=');
}
