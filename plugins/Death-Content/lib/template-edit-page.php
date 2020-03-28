<?php

function cases_update($cases_id) {
    global $wpdb;
    $language =  Helper::gat_language($_GET['lang']);
    $get_lang = '';
    if(isset($_GET['lang'])){
      $get_lang = '&lang='.$language;
    }
    $result = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'cases where id = %d', $cases_id));
    ?>
    <div class="container">
        <div class="wrap">
            <h1 id="h1"><?php _e('Edit', 'cases'); ?></h1>
            <form class="addform" action="<?php echo wp_nonce_url('/wp-admin/admin.php?page=edit_update_result&id='.$cases_id.$get_lang, 'cases_edit_nonce'); ?>" method="POST">
                <?php Helper::template_page($result, $language) ?>
                <button type="submit" class="btn btn-primary"><?php _e('update', 'cases'); ?></button>
            </form>
        </div>
    </div>
    <?php
}
