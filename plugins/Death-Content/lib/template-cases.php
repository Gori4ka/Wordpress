<?php

function get_cases_add_form() {
    global $wpdb;
    ?>
    <div class="container">
        <div class="wrap">
            <h1 id="h1"><?php _e('Add new Cases', 'cases'); ?></h1>
            <form class="addform" action="<?php echo wp_nonce_url('/wp-admin/admin.php?page=cases_request', 'cases_request_nonce'); ?> " method="POST">
                <?php
                $result = '';
                if (isset($_GET['id_base']) && (int) $_GET['id_base']) {
                    $result = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'cases where id = %d', $_GET['id_base']));
                    ?>
                    <fieldset class="form-group">
                        <input type="hidden" class="form-control" name="id_base" value= "<?php echo $_GET['id_base']; ?>">
                    </fieldset>
                    <?php
                }

                $language = Helper::gat_language($_GET['lang']);
                if ($language != CasesLanguage::hy) {
                    ?>
                    <fieldset class="form-group">
                        <input type="hidden" class="form-control" name="lang" value= "<?php echo $_GET['lang']; ?>">
                    </fieldset>
                    <?php
                }

                Helper::template_page($result, $language);
                ?>
                <button type="submit" class="btn btn-primary"><?php _e('save', 'cases'); ?></button>
            </form>
        </div>
    </div>
    <?php
}
