<?php
/**
 * Bootstrap Basic theme
 *
 * @package bootstrap-basic
 */
/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
    $content_width = 1170;
}


if (!function_exists('bootstrapBasicSetup')) {

    /**
     * Setup theme and register support wp features.
     */
    function bootstrapBasicSetup() {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         *
         * copy from underscores theme
         */
        load_theme_textdomain('bootstrap-basic', get_template_directory() . '/languages');

        // add theme support title-tag
        add_theme_support('title-tag');

        // add theme support post and comment automatic feed links
        add_theme_support('automatic-feed-links');

        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails');

        // allow the use of html5 markup
        // @link https://codex.wordpress.org/Theme_Markup
        add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

        // add support menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'bootstrap-basic'),
        ));

        // add post formats support
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        // add support custom background
        add_theme_support(
                'custom-background', apply_filters(
                        'bootstrap_basic_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => ''
                        )
                )
        );
    }

// bootstrapBasicSetup
}
add_action('after_setup_theme', 'bootstrapBasicSetup');


if (!function_exists('bootstrapBasicWidgetsInit')) {

    /**
     * Register widget areas
     */
    function bootstrapBasicWidgetsInit() {
        register_sidebar(array(
            'name' => __('Sidebar right', 'bootstrap-basic'),
            'id' => 'sidebar-right',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Calendar', 'bootstrap-basic'),
            'id' => 'calendar-sidebar',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));
    }

// bootstrapBasicWidgetsInit
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


if (!function_exists('bootstrapBasicEnqueueScripts')) {

    /**
     * Enqueue scripts & styles
     */
    function bootstrapBasicEnqueueScripts() {
        global $wp_scripts;

        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.7');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('masterslider-style', get_template_directory_uri() . '/js/masterslider/masterslider.css');
        wp_enqueue_style('masterslider-default-style', get_template_directory_uri() . '/js/masterslider/default-style.css?aaa');

        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css?fa2ar');
        wp_enqueue_style('responsive-style', get_template_directory_uri() . '/css/responsive.css?89uy');

        wp_enqueue_style('eventCalendar-style', get_template_directory_uri() . '/css/eventCalendar.css?323');
        wp_enqueue_style('eventCalendar_theme_responsive-style', get_template_directory_uri() . '/css/eventCalendar_theme_responsive.css?a23');
        wp_enqueue_style('masterslider-css', get_template_directory_uri() . '/js/masterslider/style.css');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js?6k5', array(), false, true);
        wp_enqueue_script('jquery.ad-gallery.js-script', get_template_directory_uri() . '/js/jquery.ad-gallery.js');
        wp_enqueue_script('masterslider-script', get_template_directory_uri() . '/js/masterslider/masterslider.min.js');
        wp_enqueue_script('masterslider-easing-script', get_template_directory_uri() . '/js/masterslider/jquery.easing.min.js');

        wp_enqueue_script('jquery.min-script', get_template_directory_uri() . '/js/jquery.min.js');
        wp_enqueue_script('moment-script', get_template_directory_uri() . '/js/moment.js');
        wp_enqueue_script('jquery.eventCalendar.min-script', get_template_directory_uri() . '/js/jquery.eventCalendar.js?122');
        wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
    }

// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');


/**
 * admin page displaying help.
 */
if (is_admin()) {
    require get_template_directory() . '/inc/BootstrapBasicAdminHelp.php';
    $bbsc_adminhelp = new BootstrapBasicAdminHelp();
    add_action('admin_menu', array($bbsc_adminhelp, 'themeHelpMenu'));
    unset($bbsc_adminhelp);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';

require get_template_directory() . '/functions-constant.php';
require get_template_directory() . '/functions-metabox.php';
require get_template_directory() . '/function-translate.php';

function get_main_slider($count) {
    $args = array(
        'posts_per_page' => $count,
        'category' => SLIDER,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        ?>
        <!-- masterslider -->
        <div class="master-slider ms-skin-default" id="masterslider">
            <?php foreach ($posts_array as $post_item) {
                $featured_image = get_post_meta($post_item->ID, 'featured_image', true);
                ?>
                <!-- new slide -->
                <div class="ms-slide slide-1" data-delay="2">
                    <!-- slide background -->
                    
                    <img src="<?php echo $featured_image ?>" alt="<?php echo get_the_title($post_item->ID); ?>">
                    
                    <div class="slider-title">
                        <a href="<?php echo get_permalink($post_item->ID) ?>"><?php echo get_the_title($post_item->ID); ?></a>
                    </div>
                </div>
                <!-- end of slide -->
            <?php }
            ?>
        </div>
        <!-- end of masterslider -->
        <?php
    }
}

function get_news_posts($cat, $count) {
    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        ?>
        <div class="category_name">
            <a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat); ?></a>
        </div>
        <div class="item-list row">
            <?php
            foreach ($posts_array as $post_item) {

                $youtubeId = get_post_meta($post_item->ID, 'YoutubeID', true);
                $play_icon = '';
                if (get_the_post_thumbnail($post_item->ID) && $youtubeId || $youtubeId) {
                    $play_icon = '<i class="icon fa fa-play-circle-o"></i>';
                }
                if (get_the_post_thumbnail($post_item->ID)) {
                    $thumbnail = get_the_post_thumbnail($post_item->ID, 'medium');
                } elseif ($youtubeId) {
                    $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $youtubeId . '/0.jpg">';
                }
                ?>

                <div class="col-md-3 col-sm-6 col-xs-6 post-item">
                    <a href="<?php echo get_permalink($post_item->ID) ?>" title=" <?php echo get_the_title($post_item->ID); ?> ">
                        <div class="item-image">
            <?php echo $thumbnail; ?>
                            <?php echo $play_icon; ?>
                        </div>
                        <div class="item-title">
            <?php echo get_the_title($post_item->ID); ?>
                        </div>
                    </a>
                </div>

            <?php }
        ?>
        </div>
            <?php
        }
    }

    function get_video_block($cat, $count) {
        $args = array(
            'posts_per_page' => $count,
            'category' => $cat,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish'
        );
        $posts_array = get_posts($args);
        if ($posts_array) {
            $i = 0;
            ?>
        <div class="category_posts clearfix video-block category_block">
            <div class="category_name"><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat); ?></a></div>
            <div class="item-list">
        <?php
        foreach ($posts_array as $post_item) {
            $class = 'video-item';
            if ($i == 0) {
                $i++;
                $class = 'first-video-item';
            }
            $youtubeId = get_post_meta($post_item->ID, 'YoutubeID', true);
            if (get_the_post_thumbnail($post_item->ID)) {
                $thumbnail = get_the_post_thumbnail($post_item->ID, 'medium');
            } elseif ($youtubeId) {
                $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $youtubeId . '/0.jpg">';
            }
            ?>
                    <div class="video-block-mobail">
                        <div class="<?php echo $class; ?> item clearfix">

                            <a href="<?php echo get_permalink($post_item->ID) ?>" title=" <?php echo get_the_title($post_item->ID); ?> ">
                                <div class="entry_image">
            <?php echo $thumbnail ?>
                                </div>
                            </a>
                            <i class="icon fa fa-play-circle-o"></i>
                        </div>
                    </div>
            <?php
        }
        ?>
            </div>
        </div>
                <?php
            }
        }

        function get_photo_block($cat, $count) {
            $args = array(
                'posts_per_page' => $count,
                'category' => $cat,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            );
            $posts_array = get_posts($args);
            if ($posts_array) {
                ?>
        <div class="photo-list row">
            <div class="category_name">
                <a href="<?php echo get_category_link($cat) ?>">
        <?php echo get_cat_name($cat); ?>
                </a>
            </div>

        <?php foreach ($posts_array as $post_item) { ?>
                <div class="photo-item clearfix col-sm-4 col-xs-6">
                    <a href="<?php echo get_permalink($post_item->ID) ?>" title=" <?php echo get_the_title($post_item->ID); ?> ">
                        <div class="photo-item-image">
            <?php echo get_the_post_thumbnail($post_item->ID, 'medium'); ?>
                        </div>
                    </a>
                </div>
            <?php
        }
        ?>
        </div>
            <?php
        }
    }

    function get_categoty_events($cat, $count) {
        $args = array(
            'posts_per_page' => $count,
            'category' => $cat,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish'
        );
        $posts_array = get_posts($args);
        if ($posts_array) {
            ?>
        <div class="events-list row">
            <div class="category_name">
                <a href="<?php echo get_category_link($cat) ?>">
        <?php echo get_cat_name($cat); ?>
                </a>
            </div>

        <?php foreach ($posts_array as $post_item) { ?>
                <div class="events-item col-xs-12 clearfix">
                    <a href="<?php echo get_permalink($post_item->ID) ?>" title=" <?php echo get_the_title($post_item->ID); ?> ">
                        <div class="events-item-image">
            <?php echo get_the_post_thumbnail($post_item->ID, 'medium'); ?>
                        </div>
                        <div class="events-item-title">
                            <?php echo get_the_title($post_item->ID); ?>
                        </div>
                    </a>
                </div>
            <?php
        }
        ?>
        </div>
            <?php
        }
    }

// add archive future posts

    add_action('pre_get_posts', function ( $wp_query ) {
        global $wp_post_statuses;

        if (
                !empty($wp_post_statuses['future']) &&
                !is_admin() &&
                $wp_query->is_main_query() && (
                $wp_query->is_date() ||
                $wp_query->is_single()
                )
        ) {
            $wp_post_statuses['future']->public = true;
        }
    });

    add_action('wp_head', 'ajax_url');

    function ajax_url() {
        ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}

add_action('wp_ajax_get_main_calendar', 'get_main_calendar');
add_action('wp_ajax_nopriv_get_main_calendar', 'get_main_calendar');

function get_main_calendar() {
    global $blog_id;
    
    check_ajax_referer('security', 'security');

    $args = array(
        'numberposts' => 1000,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'future, publish',
    );

    $posts = get_posts($args);

    if ($posts) {
        $data = array();
        foreach ($posts as $item) {

            $originalDate = $item->post_date;
            $y = date("Y", strtotime($originalDate));
            $m = date("m", strtotime($originalDate));
            $d = date("d", strtotime($originalDate));
            array_push($data, array('date' => $item->post_date, 'url' => get_day_link($y, $m, $d)));
        }
        wp_send_json(array('status' => 'ok', 'data' => $data, 'blogID' => $blog_id));
    }
}

function personnel_post_type() {
    $labels = array(
        'name' => _x('personnel', 'post type general name'),
        'singular_name' => _x('personnel', 'post type singular name'),
        'add_new' => _x('Add New', 'book'),
        'add_new_item' => __('Add New personnel'),
        'edit_item' => __('Edit personnel'),
        'new_item' => __('New personnel'),
        'all_items' => __('All personnel'),
        'view_item' => __('View personnel'),
        'search_items' => __('Search personnel'),
        'not_found' => __('No personnel found'),
        'not_found_in_trash' => __('No personnel found in the Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Personnel'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Our personnel',
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive' => true,
    );
    register_post_type('personnel', $args);
}

add_action('init', 'personnel_post_type');

function restore_lost_capabilities() {

    global $wp_roles;

    $caps_to_restore = array(
        'NextGEN Gallery overview',
        'NextGEN Use TinyMCE',
        'NextGEN Upload images',
        'NextGEN Manage gallery',
        'NextGEN Manage others gallery',
        'NextGEN Manage tags',
        'NextGEN Edit album',
        'NextGEN Change style',
        'NextGEN Change options',
        'NextGEN Attach Interface'
    );

    $role = $wp_roles->get_role('administrator');
    foreach ($caps_to_restore as $cap) {
        if (!$role->has_cap($cap)) {
            $role->add_cap($cap, true);
        }
    }
}

add_action('admin_init', 'restore_lost_capabilities');
