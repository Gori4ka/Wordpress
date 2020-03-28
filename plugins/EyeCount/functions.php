<?php
define('VIEWCOUNT_EXPIRE_SECONDS', 10 * 60);

function eyecount_ajax() {
    if(!$_POST['post_id'] || wp_verify_nonce($_POST['eyecount_nonce'], "eyecount_nonce")){
      wp_send_json_error();
    }
    $post_id = $_POST['post_id'];
    if ($post_id) {
        $count = new ec_functions( );
        $return = array(
            'count'   => $count->ec_view($post_id),
            'post_id' => (int)$post_id
        );
        wp_send_json_success($return);
        // echo $count->ec_view($post_id);
    }
    exit;
}

class ec_functions {

    public function ec_view($post_id) {
        $this->add_post_view($post_id);
        return $this->get_post_view($post_id);
    }

    private function add_post_view($post_id) {
        global $wpdb;
        /*
          if (get_option('eyecount_count_loggedin_users') != 1 && is_user_logged_in()) {
          $user_login = false;
          } else {
          $user_login = true;
          } */
        //if ($user_login) {
        $post_id = (int) $post_id;
        //$if_have_post = $wpdb->get_var('SELECT 1 as T FROM ' . $wpdb->prefix . 'posts WHERE ID = ' . $post_id . ' LIMIT 1');
        $if_have_post = true;

        if ($if_have_post) {
            $post_count_date = $wpdb->get_var('SELECT 1 as T FROM ' . $wpdb->prefix . 'eyecount WHERE post_id = "' . $post_id . '" AND value_date = "' . date('Y-m-d') . '" LIMIT 1');
            if (!$post_count_date) {
                $wpdb->replace($wpdb->prefix . 'eyecount', array('post_id' => $post_id, 'value_date' => date('Y-m-d'), 'view_count' => 1), array('%d', '%s', '%d'));
            } else {
                $result = $wpdb->query('UPDATE ' . $wpdb->prefix . 'eyecount SET view_count = view_count +1 WHERE post_id =' . $post_id . ' AND value_date = "' . date('Y-m-d') . '" LIMIT 1');
            }
        }
        //}
    }

    private function get_post_view($post_id) {
        global $wpdb;
        $post_id = (int) $post_id;
        $result = $wpdb->get_var("SELECT sum(view_count) FROM  {$wpdb->prefix}eyecount WHERE post_id ='$post_id' ");
        return (int) $result;
    }

}

// WIDGET MOST //
/* ----------------------------------------------------------------------------------- */
// This starts the Most Read widget
/* ----------------------------------------------------------------------------------- */


add_action('widgets_init', 'mostread_load_widgets');

function mostread_load_widgets() {
    register_widget('MostRead_Widget');
}

class MostRead_Widget extends WP_Widget {

    function MostRead_Widget() {
        /* Widget settings. */
        $widget_ops = array('classname' => 'mostread', 'description' => __('This a widget that displays most read articles', "boilerplate"));
        /* Widget control settings. */
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'mostread-widget');
        /* Create the widget. */
        $this->WP_Widget('mostread-widget', __('Eyecount Most Read Widget', "boilerplate"), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        ?>
<div class="most-read-block-sidebar">
        <div class="maincol-title topborder-light"><?php echo $instance['title']; ?></div>
        <?php
        if ($instance['widget_type'] != 'ec_tabs') {
            $block = stripslashes(get_option('eyecount_widget_options_single'));

            $block = str_replace(
                    '%get_feed_block%', $this->get_feed_block($instance['widget_type'], $instance['exclude_category'], $instance['include_category'], $instance['limit'], get_option('eyecount_post_view_logic'))
                    , $block);
        } else {
            $block = stripslashes(get_option('eyecount_widget_options'));
            $block = str_replace(
                    array(
                '%daily_views%',
                '%weekly_views%',
                '%monthly_views%',
                '%get_feed_block_daily_views%',
                '%get_feed_block_weekly_views%',
                '%get_feed_block_monthly_views%'
                    ), array(
                __('Daily', 'eyecount'),
                __('Weekly', 'eyecount'),
                __('Monthly', 'eyecount'),
                $this->get_feed_block('ec_daily_views', $instance['exclude_category'], $instance['include_category'], $instance['limit'], get_option('eyecount_post_view_logic'), $instance['widget_type']),
                $this->get_feed_block('ec_weekly_views', $instance['exclude_category'], $instance['include_category'], $instance['limit'], get_option('eyecount_post_view_logic'), $instance['widget_type']),
                $this->get_feed_block('ec_monthly_views', $instance['exclude_category'], $instance['include_category'], $instance['limit'], get_option('eyecount_post_view_logic'), $instance['widget_type'])
                    ), $block);
        }

        echo $block . '</div>';
    }

    function update($new_instance, $old_instance) {
        global $wpdb;
        $exclude = array();
        $plugin_name = 'sitepress-multilingual-cms/sitepress.php';
        $is_active = is_plugin_active($plugin_name);
        if ($is_active == '1') {
            $res = $wpdb->get_results('SELECT element_id FROM ' . $wpdb->prefix . 'icl_translations WHERE trid IN (SELECT trid  FROM ' . $wpdb->prefix . 'icl_translations WHERE element_id IN (' . implode(",", $_POST['exclude_category']) . ') AND element_type = "tax_category")', ARRAY_A);
            if ($res) {
                foreach ($res as $item) {
                    $exclude[] = $item['element_id'];
                }
            }

            $i = 0;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        if (!$exclude) {
            $exclude = '';
        }

        if (isset($_POST['exclude_category'])) {
            $instance['exclude_category'] = $_POST['exclude_category'];
        }

        if (isset($_POST['include_category'])) {
            $instance['include_category'] = $_POST['include_category'];
        }

        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['widget_type'] = $_POST['widget_type'];
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Most Read widget', 'eyecount'), 'category' => '', 'name' => __('Bilal Shaheen', 'eyecount'));
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'eyecount'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('widget_type'); ?>"><?php _e('Widget Type:', 'eyecount'); ?></label>
            <select name="widget_type">
                <option value="ec_daily_views" <?php echo($instance['widget_type'] == 'ec_daily_views' ? 'selected' : ''); ?> >Last 1 day</option>
                <option value="ec_weekly_views" <?php echo($instance['widget_type'] == 'ec_weekly_views' ? 'selected' : ''); ?> >Last 7 days</option>
                <option value="ec_monthly_views" <?php echo($instance['widget_type'] == 'ec_monthly_views' ? 'selected' : ''); ?>>Last 30 days</option>
                <option value="ec_all" <?php echo($instance['widget_type'] == 'ec_all' ? 'selected' : ''); ?>>All-time</option>
                <option value="ec_tabs" <?php echo($instance['widget_type'] == 'ec_tabs' ? 'selected' : ''); ?>>Tabs</option>
            </select>          

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Exclude category ID:', 'eyecount'); ?></label>

            <?php
            $categories = get_terms('category', array(
                'orderby' => 'count',
                'hide_empty' => 1
            ));
            $count = count($categories);
            if ($count > 0) {
                echo "<select name='exclude_category[]' size = '10' multiple><option> -------- </option>";
                foreach ($categories as $category) {
                    if (in_array($category->term_id, $instance['exclude_category'])) {
                        echo "<option selected value= '$category->term_id'>" . $category->name . "</option>";
                    } else {
                        echo "<option value= '$category->term_id'>" . $category->name . "</option>";
                    }
                }
                echo " </select>";
            }
            ?>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Include category ID:', 'eyecount'); ?></label>

            <?php
            if ($count > 0) {
                echo "<select name='include_category'><option> -------- </option>";
                foreach ($categories as $category) {
                    if ($category->term_id == $instance['include_category']) {
                        echo "<option selected value= '$category->term_id'>" . $category->name . "</option>";
                    } else {
                        echo "<option value= '$category->term_id'>" . $category->name . "</option>";
                    }
                }
                echo " </select>";
            }
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Show post count:', 'eyecount'); ?></label>
            <input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $instance['limit']; ?>" style="width:100%;" />
        </p>


        <?php
    }

    function get_feed_block($views_row, $exclude, $include, $limit = 5, $same_period_posts = 0, $widget_type = '') {
        global $wpdb, $blog_id;
        if (!$limit) {
            $limit = 5;
        }
        $resHtml = '';
        if (function_exists('get_redis')) {
           $redis = get_redis();
           $resHtml = $redis->get($cache_key);
        }
        $cache_group = 'eyecount';
        $cache_key = md5($views_row . '-' . $limit . ' - ' . $same_period_posts . ' - ' . $include . '-' . $exclude . '-' . $widget_type . '-821');
        $resUrl = array();
        //  $resHtml = ec_cache_get($cache_key, $cache_group);

        if (!$resHtml) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            $i = 1;
            if ($views_row == 'ec_daily_views') {
                $date_sql = 'NOW() - INTERVAL 35 HOUR';
            }
            if ($views_row == 'ec_weekly_views') {
                $date_sql = 'NOW() - INTERVAL 7 DAY';
            }
            if ($views_row == 'ec_monthly_views') {
                $date_sql = 'NOW() - INTERVAL 31 DAY';
            }
            if ($views_row == 'ec_all') {
                $date_sql = 'NOW() - INTERVAL 365 DAY';
            }

            $wpml_filter = '';

            if ($same_period_posts == 1) {
                $same_period_posts_sql = " AND " . $wpdb->prefix . "posts.post_date >= $date_sql ";
            } else {
                $same_period_posts_sql = '';
            }


            $query = 'SELECT post_id, sum(ec.view_count) as view_count
                FROM ' . $wpdb->prefix . 'eyecount as ec
                INNER JOIN ' . $wpdb->prefix . 'posts ON ' . $wpdb->prefix . 'posts.ID = ec.post_id
                WHERE ' . $wpdb->prefix . 'posts.post_status = "publish" ';

            $query .= '
                AND ec.value_date >= date(' . $date_sql . ')'
                    . $wpml_filter
                    . $same_period_posts_sql . '
                GROUP BY ec.post_id
                ORDER BY view_count DESC 
                LIMIT ' . $limit;

            if ($widget_type != 'ec_tabs') {
                $block = stripslashes(get_option('eyecount_article_options_single'));
            } else {
                $block = stripslashes(get_option('eyecount_article_options_tabbed'));
            }

            //echo '<!--EDDDD ' . $query . ' ---->';
            $result = $wpdb->get_results($query, ARRAY_A);

            $resHtml = '';
            foreach ($result as $item) {
                $c = 'entry-number-odd';
                if ($i % 2 == 0)
                    $c = 'entry-number-even';
                $resHtml .= str_replace(
                        array(
                    '%EC_PERMALINK%',
                    '%EC_NUM%',
                    '%EC_THUMBNAIL%',
                    '%EC_POSTDATE%',
                    '%EC_POSTTITLE%',
                    'entry-number'
                        ), array(
                    get_permalink($item['post_id']),
                    $i,
                    get_the_post_thumbnail($item['post_id'], 'thumbnail'),
                    get_the_time('Y-m-d', $item['post_id']),
                    get_the_title($item['post_id']),
                    'entry-number ' . $c
                        ), $block);
                $i++;
                array_push($resUrl, get_permalink($item['post_id']));
            }
            $resHtml .= '<!-- ' . date('h:i:s') . '-->';
            //  ec_cache_set($cache_key, $resHtml, $cache_group, 60 * 60 * 1); //1 hour            
            if ($redis) {
                $redis->setex($cache_key, VIEWCOUNT_EXPIRE_SECONDS, $resHtml);
                $urlString = '';
                if (count($resUrl) > 0) {
                    $urlString = implode(",", $resUrl);
                }
                $redis->setex('InstantMostReadSportPosts_' . $blog_id, VIEWCOUNT_EXPIRE_SECONDS, $urlString);
            }
        }

        return $resHtml;
    }

}

function ec_cache_get($cache_key, $cache_group) {
    $memcache = new Memcache;
    // connect locally on the default port
    if (@$memcache->connect('127.0.0.1', 11211) === false) {
        return null;
    }
    return $memcache->get($cache_key);
}

function ec_cache_set($cache_key, $data, $cache_group, $expire) {
    $memcache = new Memcache;
    // connect locally on the default port
    if (@$memcache->connect('127.0.0.1', 11211) === false) {
        return false;
    }
    $memcache->set($cache_key, $data, false, $expire);
}
