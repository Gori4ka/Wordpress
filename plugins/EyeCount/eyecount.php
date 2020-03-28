<?php
/*
  Plugin Name: EyeCount
  Plugin URI: http://smartwebsitetips.com
  Description:
  Author: Edgar Marukyan, Ghevond Ghazaryan, Artush Mkrtchyan
  Version: 1.0
  Author URI: http://smartwebsitetips.com
  Donate link: http://smartwebsitetips.com
  Tags: EyeCount, plugin, wordpress
 */

global $wpdb, $wp_version;
define("eye_tabel", $wpdb->prefix . "eyecount");
define("eye_tabel_date", $wpdb->prefix . "eyecount_date");
include 'functions.php';

function eyecount_activate() {
    global $wpdb;
    if (function_exists('is_multisite') && is_multisite()) {
        $old_blog = $wpdb->blogid;
        $blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
        foreach ($blogids as $blog_id) {
            switch_to_blog($blog_id);
            eyecount_install();
        }
        switch_to_blog($old_blog);
        return;
    }
    eyecount_install();
}

function eyecount_deactivate() {
    global $wpdb;
    if (function_exists('is_multisite') && is_multisite()) {
        $old_blog = $wpdb->blogid;
        $blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
        foreach ($blogids as $blog_id) {
            switch_to_blog($blog_id);
            eyecount_uninstall();
        }
        switch_to_blog($old_blog);
        return;
    }
    eyecount_install();
}

function eyecount_install() {
    global $wpdb;

    if ($wpdb->get_var("show tables like '" . $wpdb->prefix . "eyecount'") != $wpdb->prefix . 'eyecount') {
        $query = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "eyecount` ("
                . "`id` INT NOT NULL AUTO_INCREMENT ,"
                . "`post_id` INT NOT NULL default '0' ,"
                . "`value_date` date DEFAULT '0000-00-00' NOT NULL,"
                . "`view_count` INT NOT NULL default '0' ,"
                . "PRIMARY KEY ( `id` )"
                . ")";
        $wpdb->query($query);
    }
    add_option('eyecount_element_selector', "#viewscount");
    $default_article_options = get_ec_default_article_style_tabbed();
    $default_options = get_ec_default_style();
    add_option('eyecount_article_options_tabbed', $default_article_options);
    add_option('eyecount_widget_options', $default_options);
    $default_article_options_single = get_ec_default_article_style_single();
    $default_options_single = get_ec_default_style_single();
    add_option('eyecount_article_options_single', $default_article_options_single);
    add_option('eyecount_widget_options_single', $default_options_single);
    add_option('eyecount_include_css', '1');
    add_option('eyecount_include_js', '1');
    add_option('eyecount_count_loggedin_users', '1');
    add_option('eyecount_post_view_logic', '1');
}

function get_ec_default_style() {
    $default = '<div class="tab-switcher">
            <span class="tab-button active-btn" rel="sw-daily-tab">%daily_views%</span>
            <span class="tab-button" rel="sw-weekly-tab">%weekly_views%</span>
            <span class="tab-button last-tab-button" rel="sw-monthly-tab">%monthly_views%</span>
            <div class="widget-tab active-tab" id="sw-daily-tab">
                <div class = "newsfeed-articles">%get_feed_block_daily_views%</div>
            </div>
            <div class="widget-tab" id="sw-weekly-tab">
                <div class = "newsfeed-articles">%get_feed_block_weekly_views%</div>
            </div>
            <div class="widget-tab" id="sw-monthly-tab">
                <div class = "newsfeed-articles">%get_feed_block_monthly_views%</div>
            </div>
</div>';
    return $default;
}

function get_ec_default_style_single() {
    $default = '<div class = "ec_top_post_list">'
            . '%get_feed_block%'
            . '</div>';
    return $default;
}

function get_ec_default_article_style_single() {
    $default = '<article>
   <a href = "%EC_PERMALINK%">
        <span class = "entry-number">%EC_NUM%</span>
        <span class = "entry-thumb">%EC_THUMBNAIL%</span>
        <span class = "entry-date">%EC_POSTDATE%</span>
        <span class = "entry-title">%EC_POSTTITLE%</span>
   </a>
</article>';
    return $default;
}

function get_ec_default_article_style_tabbed() {
    $default = '<article>
   <a href = "%EC_PERMALINK%">
        <span class = "entry-number">%EC_NUM%</span>
        <span class = "entry-thumb">%EC_THUMBNAIL%</span>
        <span class = "entry-date">%EC_POSTDATE%</span>
        <span class = "entry-title">%EC_POSTTITLE%</span>
   </a>
</article>';
    return $default;
}

function eyecount_admin_options() {
    global $wpdb;
    if (isset($_POST['reset'])) {
        update_option('eyecount_article_options_tabbed', get_ec_default_article_style_tabbed());
        update_option('eyecount_widget_options', get_ec_default_style());
        update_option('eyecount_article_options_single', get_ec_default_article_style_single());
        update_option('eyecount_widget_options_single', get_ec_default_style_single());
        update_option('eyecount_include_css', '1');
        update_option('eyecount_include_js', '1');
        update_option('eyecount_count_loggedin_users', '1');
        update_option('eyecount_post_view_logic', '1');
        update_option('include_post_type', array('post', 'page'));
        update_option('eyecount_element_selector', '#viewscount');
    } elseif (isset($_POST['submit'])) {
        if (isset($_POST['eyecount_element_selector']) && $_GET['edit-submit']) {
            update_option('eyecount_element_selector', $_POST['eyecount_element_selector']);
        }
        if ($_POST['include_css'] == 1 && $_GET['edit-submit']) {
            update_option('eyecount_include_css', '1');
        } elseif ($_GET['edit-submit']) {
            update_option('eyecount_include_css', '0');
        }
        if ($_POST['eyecount_include_js'] == 1 && $_GET['edit-submit']) {
            update_option('eyecount_include_js', '1');
        } elseif ($_GET['edit-submit']) {
            update_option('eyecount_include_js', '0');
        }
        if ($_POST['eyecount_count_loggedin_users'] == 1 && $_GET['edit-submit']) {
            update_option('eyecount_count_loggedin_users', '1');
        } elseif ($_GET['edit-submit']) {
            update_option('eyecount_count_loggedin_users', '0');
        }
        if ($_POST['eyecount_post_view_logic'] == 1 && $_GET['edit-submit']) {
            update_option('eyecount_post_view_logic', '1');
        } elseif ($_GET['edit-submit']) {
            update_option('eyecount_post_view_logic', '0');
        }
        if (isset($_POST['eyecount_article_options_tabbed']) && $_GET['edit-submit']) {
            update_option(eyecount_article_options_tabbed, $_POST['eyecount_article_options_tabbed']);
        }
        if (isset($_POST['include_post_type']) && $_GET['edit-submit']) {
            update_option(include_post_type, $_POST['include_post_type']);
        }
        if (isset($_POST['eyecount_widget_options']) && $_GET['edit-submit']) {
            update_option(eyecount_widget_options, $_POST['eyecount_widget_options']);
        }
        if (isset($_POST['eyecount_widget_options_single']) && $_GET['edit-submit']) {
            update_option(eyecount_widget_options_single, $_POST['eyecount_widget_options_single']);
        }
        if (isset($_POST['eyecount_article_options_single']) && $_GET['edit-submit']) {
            update_option(eyecount_article_options_single, $_POST['eyecount_article_options_single']);
        }
    }
    ?>
    <form method="post" action="<?php echo add_query_arg(array('edit-submit' => 'submit')) ?>">
        <h2>EyeCount Settings</h2>
        <table class="form-table ">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="eyecount_element_selector">Element ID or Class</label></th>
                    <td><input name="eyecount_element_selector" type="text" id="eyecount_element_selector" value="<?php echo get_option('eyecount_element_selector'); ?>" class="regular-text"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="">Short code </label></th>
                    <td><pre><code>[eyecount_result]</code></pre></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>Post type</label></th>
                    <td>
                        <?php
                        $post_types = get_post_types('', 'names');
                        if (count($post_types)) {
                            echo "<select class='regular-text' name='include_post_type[]' size = '5' multiple>";
                            foreach ($post_types as $post_type) {
                                if (!in_array($post_type, array('nav_menu_item', 'revision', 'attachment'))) {
                                    if (in_array($post_type, get_option('include_post_type'))) {
                                        echo "<option selected value= '$post_type'>" . $post_type . "</option>";
                                    } else {
                                        echo "<option value= '$post_type'>" . $post_type . "</option>";
                                    }
                                }
                            }
                            echo " </select>";
                        }
                        ?>

                    </td>
                </tr>

                <tr valign="top">
                    <td colspan="2"><label>
                            <input type="checkbox" <?php echo (get_option('eyecount_include_css') == 1 ? 'checked' : ''); ?> name="include_css" value="1">
                            Include Css</label>
                    </td>
                </tr>
                <tr valign="top">
                    <td colspan="2"><label>
                            <input type="checkbox" <?php echo (get_option('eyecount_include_js') == 1 ? 'checked' : ''); ?> name="eyecount_include_js" value="1">
                            Include JS</label></td>
                </tr>

                <tr valign="top">
                    <td colspan="2"><label>
                            <input type="checkbox" <?php echo (get_option('eyecount_count_loggedin_users') == 1 ? 'checked' : ''); ?> name="eyecount_count_loggedin_users" value="1">
                            Count For Logged in Users also</label></td>
                </tr>
                <tr valign="top">
                    <td colspan="2"><label>
                            <input type="checkbox" <?php echo (get_option('eyecount_post_view_logic') == 1 ? 'checked' : ''); ?> name="eyecount_post_view_logic" value="1">
                            Choose "Daily Top" articles from articles published that day, "Weekly Top" articles from articles published that week, "Mountly Top" articles from articles published that month.</label></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>Tabbed List Article Template</label></th>
                    <td><textarea name="eyecount_article_options_tabbed" class="regular-text" rows="10" cols="100"><?php echo stripslashes(get_option('eyecount_article_options_tabbed')); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Tabbed Widget Template</label></th>
                    <td><textarea name="eyecount_widget_options" class="regular-text" rows="10" cols="100"><?php echo stripslashes(get_option('eyecount_widget_options')); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Single Article Template</label></th>
                    <td><textarea name="eyecount_article_options_single" class="regular-text" rows="10" cols="100"><?php echo stripslashes(get_option('eyecount_article_options_single')); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Single List Widget Template</label></th>
                    <td><textarea name="eyecount_widget_options_single" class="regular-text" rows="10" cols="100"><?php echo stripslashes(get_option('eyecount_widget_options_single')); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Shortcode</label></th>
                    <td>[eyecount_post_view_count post_id=postID]</td>
                </tr>
            </tbody>
        </table>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Settings">
            <input type="submit" name="reset" id="submit" class="button button-danger" value="Reset Settings">
        </p>
    </form>
    <?php
}

function eyecount_uninstall() {
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "eyecount");
    $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "eyecount_date");
    delete_option('eyecount_element_selector');
    delete_option('eyecount_article_options_tabbed');
    delete_option('eyecount_widget_options');
}

function eyecount_add_to_menu() {
    if (is_admin()) {
        add_menu_page(__('EyeCount', 'EyeCount'), __('EyeCount', 'EyeCount'), 'administrator', 'EyeCount', 'eyecount_admin_options');
    }
}

function eyecount_init() {
    global $__ec__ajax_post_id;
    $__ec__ajax_post_id = get_the_ID();

    $plugin_url = plugin_dir_url( __FILE__ );
    if (stripslashes(get_option('eyecount_include_css')) != 0) {
        wp_enqueue_style( 'eyecount_style',  plugins_url('/css/style.css', __FILE__));
    }
}

function eyecount_init_scripts() {
    if (is_single()) {
        global $__ec__ajax_post_id;
        $ajax_nonce = wp_create_nonce( "eyecount_nonce" );
        ?>
        <script>
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            var eyecount_post_id = '<?php echo $__ec__ajax_post_id; ?>';
            var eyecount_element_selector = '<?php echo get_option('eyecount_element_selector'); ?>';

            if (typeof eyecount_post_id != "undefined" && eyecount_post_id != null) {
                var data = {
                    action: 'eyecount_ajax',
                    security: '<?php echo $ajax_nonce; ?>',
                    post_id: eyecount_post_id
                };
                jQuery.post( ajaxurl, data, function(response) {
                    if(response.success){
                        viewscount = response.data.count;
                        jQuery(eyecount_element_selector).empty().text(viewscount);
                    }
                });
            }
        </script>
        <?php
    }
    if (stripslashes(get_option('eyecount_include_js')) != 0) {
        wp_enqueue_script('eyecount_tabs', plugins_url('/js/tab_widget.js', __FILE__), array('jquery'), 2, true);
    }
}

function eyecount_short($atts) {
    $selector = get_option('eyecount_element_selector');
    if ($selector[0] == '#') {
        return '<span id="' . substr($selector, 1) . '"></span>';
    } elseif ($selector[0] == '.') {
        return '<span class="' . substr($selector, 1) . '"></span>';
    }
}

function eyecount_post_view($atts) {
    global $wpdb;
    $post_id = (int) $atts['post_id'];
    $result = $wpdb->get_var("SELECT sum(view_count) FROM  {$wpdb->prefix}eyecount WHERE post_id ='$post_id' ");
    return (int) $result;
}

add_shortcode('eyecount_post_view_count', 'eyecount_post_view');
add_shortcode('eyecount_result', 'eyecount_short');
add_action('admin_menu', 'eyecount_add_to_menu');
add_action('wp_head', 'eyecount_init');
add_action('wp_footer', 'eyecount_init_scripts');
register_activation_hook(__FILE__, 'eyecount_activate');
register_deactivation_hook(__FILE__, 'eyecount_deactivate');
add_action('wp_ajax_eyecount_ajax', 'eyecount_ajax');
add_action('wp_ajax_nopriv_eyecount_ajax', 'eyecount_ajax');
?>