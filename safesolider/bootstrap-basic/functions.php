<?php
/**
 * Bootstrap Basic theme
 *
 * @package bootstrap-basic
 */
/**
 * Required WordPress variable.
 */
require get_template_directory() . '/functions-constant.php';
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
        load_theme_textdomain('safesoldiers', get_template_directory() . '/languages');

        // add theme support title-tag
        add_theme_support('title-tag');

        // add theme support post and comment automatic feed links
        add_theme_support('automatic-feed-links');

        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails', array('post'));

        // allow the use of html5 markup
        // @link https://codex.wordpress.org/Theme_Markup
        add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

        // add support menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'bootstrap-basic'),
        ));

        register_nav_menus(array(
            'companies' => __('Companies Menu', 'bootstrap-basic'),
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


add_image_size('featured-post-image', 476, 244, true); //(cropped)


add_filter('image_size_names_choose', 'featured_image_sizes');

function featured_image_sizes($sizes) {
    $addsizes = array(
        "featured-post-image" => __("Featured Size")
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}

if (!function_exists('bootstrapBasicWidgetsInit')) {

    /**
     * Register widget areas
     */
    function bootstrapBasicWidgetsInit() {
        register_sidebar(array(
            'name' => __('Header right', 'bootstrap-basic'),
            'id' => 'header-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
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

        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.6');
        wp_enqueue_style('bootstrap-select-min', get_template_directory_uri() . '/css/bootstrap-select.min.css', array(), '3.3.6');
        wp_enqueue_style('datepicker', get_template_directory_uri() . '/css/bootstrap-datetimepicker.min.css', array(), '3.3.6');
        wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '3.3.6');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');
        wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());


        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');

        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');
        wp_enqueue_script('form_jquery', get_template_directory_uri() . '/js/jquery.form.js', array(), '3.7.3');
        wp_enqueue_script('boot-box', get_template_directory_uri() . '/js/bootbox.min.js', array(), '3.7.3');
        wp_enqueue_script('bootstrap-select-min', get_template_directory_uri() . '/js/bootstrap-select.min.js', array(), '3.7.3');
        wp_enqueue_script('owl.carousel.min', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), '3.7.3');
        wp_enqueue_script('search-ajax', get_template_directory_uri() . '/js/search-ajax.js', array(), '3.7.3');
        wp_enqueue_script('bootstrap-moment', get_template_directory_uri() . '/js/moment.min.js', array(), '3.3.6', true);
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.6', true);
        wp_enqueue_script('datepicker', get_template_directory_uri() . '/js/bootstrap-datetimepicker.min.js', array(), '3.3.6', true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/site.js', array(), false, true);
        wp_enqueue_script('exporting', get_template_directory_uri() . '/js/exporting.js', array(), false, true);
        wp_enqueue_script('highcharts', get_template_directory_uri() . '/js/highcharts.js', array(), false, true);
        //wp_enqueue_script('main-google', 'https://www.google.com/recaptcha/api.js', array(), false, true);
    }

// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');
/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';
/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';

function incident_block() {
    ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 incident-block">
        <span class="button-1"><?php _e('Add an incident', 'safesoldiers') ?></span>
        <div class="incidents">
            <div class="buttons">
                <span class="button-2">
                    <a href="<?php echo get_permalink(ADDINCIDENT) ?>"><?php _e('Violation against you or your relatives in the RA armed forces', 'safesoldiers') ?>
                    </a>
                </span>
                <span class="button-3">
                    <a href="<?php echo get_permalink(ADDDEATH) ?>"><?php _e('Related to the non combat fatalities in the RA armed forces after 1994', 'safesoldiers') ?>
                    </a>
                </span>
                <i class="fa fa-caret-up" aria-hidden="true"></i>
            </div>
            <div class="info">
                <i class="fa fa-caret-left" aria-hidden="true"></i>
                <p>
                    <?php _e('With the help of these buttons it is possible to anonymously enter information about the violations practiced against you or your relatives in the RA armed forces or Fatality cases recorded in the RA Armed Forces after 1994. This information, after being reviewed by the website administration, will be included in the website and in the database with the tags Verified and Unverified.', 'safesoldiers') ?>
                </p>
            </div>
        </div>
    </div>
    <div class="db-title-mobile mobile-hidden">
        <h1><?php _e('Database', 'safesoldiers') ?></h1>
    </div>
    <?php
}

function featured($lang) {
    $death_id = get_new_death_id($lang);
    ?>
    <div class="featured clearfix">
        <div class="col-xs-12 col-sm-5 col-md-3">
            <div class="col-md-12 col-xs-6">
                <div class="featured-news">
                    <div class="image-cont">
                        <a href="<?php echo get_page_cases_url($death_id); ?>"><img src="<?php echo Helper::get_media_by_cases_id($death_id); ?>" alt="zinvor" /></a>
                    </div>
                    <div class="title-holder">
                        <span class="title"><?php _e('Story of fallen soldier', 'safesoldiers') ?></span>
                        <a href="<?php echo get_page_cases_url($death_id); ?>"><?php _e('Read more', 'safesoldiers') ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xs-6">
                <div class="featured-news">
                    <div class="title-holder">
                        <p>
                            <?php _e('The database now lists a total of', 'safesoldiers') ?> <?php echo count_death($lang) ?> <?php _e('fatalities recorded in the Armenian and Nagorno-Karabakh armed forces since 1994.', 'safesoldiers') ?>
                        </p>
                        <a href="<?php echo get_permalink(CASESLIST) . '?' . pagenum . '=1'; ?>"><?php _e('Read more', 'safesoldiers') ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-9">
            <?php get_latest_news_block(); ?>
        </div>
    </div>
    <?php
}

function count_death($lang) {
    global $wpdb;
    $count = $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where lang= %s AND type = %s AND c.status = %d AND c.cases_type = %d ', array($lang, "cases", 1, 0)));
    if ($count) {
        return $count;
    } else {
        return;
    }
}

function get_latest_news_block() {
    $args = array(
        'posts_per_page' => 3,
        'offset' => 0,
        'category' => NEWS,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);
    $list_html = '';
    if ($posts_array) {
        $first_item = '';
        foreach ($posts_array as $post_item) {
            if ($first_item == '') {
                $first_item = '<div class="featured-item-image">' . get_the_post_thumbnail($post_item->ID, 'featured-post-image') . '</div>'
                        . '<div class="featured-item-title"><a href=' . get_permalink($post_item->ID) . '>' . get_the_title($post_item->ID) . '</a></div>';
            }

            $list_html .= '<div class="news-item">'
                    . '<div class="news-item-image">' . get_the_post_thumbnail($post_item->ID, 'thumbnail') . '</div>'
                    . '<a data-img=" ' . get_the_post_thumbnail_url($post_item->ID, 'featured-post-image') . '" data-title="' . get_the_title($post_item->ID) . '"'
                    . ' data-url="' . get_permalink($post_item->ID) . '" href="' . get_permalink($post_item->ID) . '">' . get_the_title($post_item->ID) . '</a></div>';
        }
        ?>
        <div class="featured-post-image">
            <?php echo $first_item; ?>
        </div>
        <div class="featured-post-list">
            <h2><?php _e('Featured:', 'safesoldiers') ?></h2>
            <?php echo $list_html; ?>
        </div>
        <?php
    }
}

function get_custom_loop_excerpt($post_id) {
    $temp = $post;
    $post = get_post($post_id);
    setup_postdata($post);
    $excerpt = get_the_excerpt();
    wp_reset_postdata();
    $post = $temp;
    return $excerpt;
}

function searchresults() {
    ?>
    <div class="search-results" id="search-results">
        <div class="holder">
            <div class="container">
                <div class="results-title">
                    <h1><?php _e('have been found', 'safesoldiers') ?> <span id="search_results_count">0</span> <?php _e('cases', 'safesoldiers') ?></h1>
                </div>
            </div>
            <!-- Owl Carousel -->
            <div id="search-result-content" class="owl-carousel">

            </div>
            <!-- end of Owl Carousel -->
        </div>
        <div class="close-results">
            <span class="left-line"></span>
            <div class="button-wrapper">
                <button id="result-close"><?php _e('Close', 'safesoldiers') ?><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <span class="right-line"></span>
        </div>
    </div>
    <?php
}

function get_data_cases($id, $lang) {
    global $wpdb;
    $result = $wpdb->get_row($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where lang= %s AND type = %s AND c.id = %d AND c.status = %d', array($lang, "cases", $id, 1)));
    if ($result) {
        return $result;
    } else {
        return;
    }
}

function country_name($id) {
    global $wpdb;
    $country_name = $wpdb->get_var($wpdb->prepare('SELECT name FROM ' . $wpdb->prefix . 'cases_country WHERE id=%d', array($id)));
    if ($country_name) {
        return $country_name;
    } else {
        return _e('unknown', 'safesoldiers');
    }
}

function region_name($id) {
    global $wpdb;
    $region_name = $wpdb->get_var($wpdb->prepare('SELECT name FROM ' . $wpdb->prefix . 'cases_region WHERE id=%d', array($id)));
    if ($region_name) {
        return $region_name;
    } else {
        return _e('unknown', 'safesoldiers');
    }
}

function reason_name($id) {
    global $wpdb;
    $reason_name = $wpdb->get_var($wpdb->prepare('SELECT name FROM ' . $wpdb->prefix . 'cases_reason WHERE id=%d', array($id)));
    if ($reason_name) {
        return $reason_name;
    } else {
        return _e('unknown', 'safesoldiers');
    }
}

function conent_status($num) {
    if ($num == 1) {
        return _e('Verified', 'safesoldiers');
    } else {
        return _e('Unverified', 'safesoldiers');
    }
}

function arrows_right($id, $lang) {
    global $wpdb;
    $page_id = $wpdb->get_var($wpdb->prepare('SELECT c.id FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where lang= %s AND type = %s AND c.id > %d AND c.status = %d ORDER BY c.id ASC', array($lang, "cases", $id, 1)));
    if ($page_id) {
        return get_page_cases_url($page_id);
    } else {
        return false;
    }
}

function arrows_left($id, $lang) {
    global $wpdb;
    $page_id = $wpdb->get_var($wpdb->prepare('SELECT c.id FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where lang= %s AND type = %s AND c.id < %d AND c.status = %d ORDER BY c.id DESC', array($lang, "cases", $id, 1)));
    if ($page_id) {
        return get_page_cases_url($page_id);
    } else {
        return false;
    }
}

function get_page_cases_url($id) {
    return get_the_permalink(CASESPAGE) . '?id=' . $id;
}

function get_new_death_id($lang) {
    global $wpdb;
    $death_id = $wpdb->get_var($wpdb->prepare('SELECT c.id FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id
                        INNER JOIN ' . $wpdb->prefix . 'cases_media as m ON m.cases_id = c.id where t.lang= %s AND t.type = %s AND c.status = %d AND c.cases_type = %d AND m.is_featured = %d ORDER BY c.id DESC', array($lang, "cases", 1, 0, 1)));
    if ($death_id) {
        return $death_id;
    }
}

function get_featurd_news_block($cat_id) {
    $args = array(
        'posts_per_page' => 4,
        'offset' => 0,
        'category' => $cat_id,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        ?>
        <div class="articles">
            <a href="#"><?php _e('Featured articles', 'safesoldiers') ?></a>
            <a href="#"><?php _e('Latest news', 'safesoldiers') ?></a>
        </div>
        <div class="news-block">
            <?php foreach ($posts_array as $post_item) { ?>
                <div class="item">
                    <div class="img-cont">
                        <?php echo get_the_post_thumbnail($post_item->ID) ?>
                    </div>
                    <div class="title-holder">
                        <a class="title" href="<?php echo get_permalink($post_item->ID); ?>"><?php echo get_the_title($post_item->ID) ?></a>
                        <div class="date-category">
                            <span class="post_date"><?php _e('Posted', 'safesoldiers') ?> <?php echo get_the_date('d F, Y', $post_item->ID); ?></span>
                            <?php get_post_category_list($post_item->ID) ?>
                            <a href="<?php echo get_permalink($post_item->ID); ?>"><?php _e('Read more', 'safesoldiers') ?></a>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }
}

function get_single_featured_news_block($post_id, $featured_cat_id) {
    $post_cats = get_the_terms($post_id, 'category');
    $cat_id = '';
    foreach ($post_cats as $cat_item) {
        if (check_in_exclude($cat_item->term_id)) {
            $cat_id = $cat_item->term_id;
        }
    }
    if ($cat_id == '') {
        $cat_id = $featured_cat_id;
    }
    $args = array(
        'posts_per_page' => 3,
        'category__and' => $cat_id, $featured_cat_id,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'post__not_in'=> array($post_id)
    );

    $posts_array = query_posts($args);

    if ($posts_array) {
        ?>
        <div class="articles">
            <a href="#"><?php _e('Latest news', 'safesoldiers') ?></a>
        </div>
        <div class="news-block">
            <?php
            while (have_posts()) : the_post();
                ?>
                <div class="item">
                    <div class="img-cont">
                        <?php echo get_the_post_thumbnail(get_the_ID()) ?>
                    </div>
                    <div class="title-holder">
                        <a class="title" href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(get_the_ID()) ?></a>
                        <div class="date-category">
                            <span class="post_date"><?php echo get_the_date('d F, Y', get_the_ID()); ?></span>
                            <a href="<?php echo get_permalink(get_the_ID()); ?>"><?php _e('Read more', 'safesoldiers') ?></a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_query();
            ?>
        </div><?php
    }
}

function get_post_category_list($post_id) {
    $cat_id_list = wp_get_post_categories($post_id);
    if ($cat_id_list) {
        ?>
        <ul class="categories">
            <?php
            foreach ($cat_id_list as $cat_id) {
                if ($cat_id == FEATURED || $cat_id == FEATUREDANALYSIS || $cat_id == FEATUREDACTIVITY) {
                  continue;

                } else{
                  ?>
                  <li><a href="<?php echo get_category_link($cat_id); ?>"><?php echo get_cat_name($cat_id); ?></a></li>
                  <?php
                }
            }
            ?>
        </ul>
        <?php
    }
}

function get_current_category_menu($cat_id) {
    $args = array(
        'type' => 'post',
        'child_of' => $cat_id,
        'parent' => '',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 0,
        'hierarchical' => 1,
        'exclude' => FEATURED,
        'include' => '',
        'number' => '',
        'taxonomy' => 'category',
        'pad_counts' => false
    );
    $categories = get_categories($args);
    ?>
    <h3><?php echo get_cat_name($cat_id) ?></h3>
    <div class="links">
        <ul>
            <?php
            foreach ($categories as $category) {
                ?>
                <li><a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo get_cat_name($category->cat_ID); ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>

    <?php
}

function post_is_in_descendant_category($cats, $_post = null) {
    foreach ((array) $cats as $cat) {
        // get_term_children() accepts integer ID only
        $descendants = get_term_children((int) $cat, 'category');
        if ($descendants && in_category($descendants, $_post))
            return true;
    }
    return false;
}

function get_latest_video() {
    $args = array(
        'posts_per_page' => 1,
        'offset' => 0,
        'category' => VIDEO,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        ?>
        <div class="latest_video mobile-hidden">
            <h3><?php _e('Latest video', 'safesoldiers'); ?></h3>
            <?php foreach ($posts_array as $post_item) { ?>
                <div class="item">
                    <h2><a href="<?php echo get_permalink($post_item->ID); ?>"><?php echo get_the_title($post_item->ID) ?></a></h2>
                    <?php
                    $videoId = get_post_meta($post_item->ID, 'YouTubeId', true);
                    if ($videoId) {
                        echo '<iframe width="100%" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
                    }
                    ?>
                    <span class="post_date"><?php _e('Posted', 'safesoldiers') ?> <?php echo get_the_date('d F, Y', $post_item->ID); ?></span>
                    <?php get_post_category_list($post_item->ID) ?>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }
    ?>

    <?php
}

function get_interactive_latest_analysis($cat_id, $count) {
    $args = array(
        'posts_per_page' => $count,
        'offset' => 0,
        'category' => $cat_id,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        foreach ($posts_array as $post_item) {
            ?>

            <div class="item col-sm-4 col-xs-12">
                <div class="img-cont">
                    <a href="<?php echo get_permalink($post_item->ID) ?>">
                        <?php echo get_the_post_thumbnail($post_item->ID) ?>
                    </a>
                </div>
                <div class="title-holder">
                    <a class="title" href="<?php echo get_permalink($post_item->ID) ?>">
                        <?php echo get_the_title($post_item->ID) ?>
                    </a>
                    <div class="date-category">
                        <span class="post_date"><?php echo get_the_date('d F, Y', $post_item->ID); ?></span>
                        <ul class="categories">
                            <li><a href="<?php echo get_category_link(ACTIVITY); ?>"><?php echo get_cat_name(ANALYSIS); ?></a></li>
                        </ul>
                        <a href="<?php echo get_permalink($post_item->ID) ?>">
                            <?php _e('Read more', 'safesoldiers') ?>
                        </a>
                    </div>
                </div>
            </div>

            <?php
        }
    }
}

function get_frontend_database_block($lang) {
    ?>
    <div class="database">
        <h1><?php _e('Database', 'safesoldiers') ?></h1>
        <form role="form" method="get" id="frontend-database" enctype="multipart/form-data" class="database-search form" action='<?php echo get_permalink(CASESLIST) ?>'>
            <select name="filter_deats" class="selectpicker">
                <option value="2"><?php _e('Death', 'safesoldiers') ?></option>
                <option value="1"><?php _e('Incident', 'safesoldiers') ?></option>
            </select>
            <div class="form-group name-details">
                <input type="text" name="first_name" class="form-control" id="name" placeholder="<?php _e('First Name', 'safesoldiers') ?>">
                <input type="text" name="last_surname" class="form-control" id="surname" placeholder="<?php _e('Last Name', 'safesoldiers') ?>">
            </div>
            <div class="form-group dates">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' name="date_start" id="datetimeinput1" placeholder="1994-05-12" value="" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' name="date_end" placeholder="<?php echo date("Y-m-d") ?>" value="" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group region">
                <select id="country_list" name="country" class="selectpicker">
                    <option value=""><?php _e('Place', 'safesoldiers') ?></option>
                    <?php
                    $countryList = Helper::get_country_list($lang);
                    if ($countryList) {
                        foreach ($countryList as $country) {
                            echo '<option value="' . $country->id . '">' . $country->name . '</option>';
                        }
                    }
                    ?>
                </select>
                <select id="region_list" name="region" class="selectpicker">
                    <option value=""><?php _e('Region', 'safesoldiers') ?></option>
                    <?php
                    $RegionList = Helper::get_region_list($lang);
                    if ($RegionList) {
                        foreach ($RegionList as $region) {
                            echo '<option value="' . $region->id . '" class= "country_' . $region->country_id . '">' . $region->name . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <select name="reason" id="reason" class="selectpicker">
                <option value=""><?php _e('Reason', 'safesoldiers') ?></option>
                <?php
                $reasonList = Helper::get_reason_list($lang);
                if ($reasonList) {
                    foreach ($reasonList as $reason) {
                        echo '<option value="' . $reason->id . '"  ' . $selected . '>' . $reason->name . '</option>';
                    }
                }
                ?>
            </select>
            <span class="input-group-btn">
                <!-- <input type="hidden" name="action" value="frontend_cases_search">
                <input type="hidden" name="security" value="<?php //echo wp_create_nonce("frontend_database_ajax_security");                                                       ?>"> -->
                <button type="submit" name="database-name" class="btn btn-default"><?php _e('Search', 'safesoldiers') ?></button>
            </span>
        </form>
    </div>
    <?php
}

function page_cases_list($lang, $limit) {
    global $wpdb;
    $filter = '';
    $args = array();
    $url = '';
    if (isset($_GET['database-name'])) {
        if (isset($_GET['filter_deats']) && (int) $_GET['filter_deats'] != 0) {
            $filter.= ' AND cases_type = %d ';
            if ((int) $_GET['filter_deats'] == 1) {
                array_push($args, 1);
            } elseif ((int) $_GET['filter_deats'] == 2) {
                array_push($args, 0);
            }
        }
        if (isset($_GET['first_name']) && $_GET['first_name'] != '') {
            $filter.= ' AND frst_name LIKE %s ';
            array_push($args, '%' . $_GET['first_name'] . '%');
        }
        if (isset($_GET['last_surname']) && $_GET['last_surname'] != '') {
            $filter.= ' AND last_name LIKE %s ';
            array_push($args, '%' . $_GET['last_surname'] . '%');
        }
        if (isset($_GET['date_start']) && $_GET['date_start'] != '') {
            $filter.= ' AND date >=  "%s" ';
            array_push($args, $_GET['date_start']);
        }
        if (isset($_GET['date_end']) && $_GET['date_end'] != '') {
            $filter.= ' AND date <=  "%s" ';
            array_push($args, $_GET['date_end']);
        }

        if (isset($_GET['country']) && (int) $_GET['country'] != 0) {
            $filter.= ' AND country_id = %d ';
            array_push($args, (int) $_GET['country']);
        }

        if (isset($_GET['region']) && (int) $_GET['region'] != 0) {
            $filter.= ' AND region_id =  %d ';
            array_push($args, (int) $_GET['region']);
        }
        if (isset($_GET['reason']) && (int) $_GET['reason'] != 0) {
            $filter.= ' AND reason_id = %d ';
            array_push($args, (int) $_GET['reason']);
        }
    }
    array_unshift($args, $lang, 'cases', 1);
    $pagenum = 1;
    if (isset($_GET['pagenum']) && (int) $_GET['pagenum']) {
        $pagenum = (int) $_GET['pagenum'];
    }
    $offset = ( $pagenum - 1 ) * $limit;

    if($filter && $args){
      $cases_list = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases as c'
                      . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id '
                      . ' WHERE t.lang= %s AND t.type = %s AND c.status=%d ' . $filter . ' ORDER BY c.id DESC LIMIT ' . $limit . ' OFFSET ' . $offset, $args));

      $total_count = $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id '
                    . ' WHERE t.lang= %s AND t.type = %s AND c.status=%d ' . $filter . ' ORDER BY c.id DESC ', $args));
    }else{

      $cases_list = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases as c'
                      . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id '
                      . ' WHERE t.lang= %s AND t.type = %s AND c.status=%d AND cases_type=0 ' . $filter . ' ORDER BY c.id DESC LIMIT ' . $limit . ' OFFSET ' . $offset, $args));

      $total_count = $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM ' . $wpdb->prefix . 'cases as c'
                    . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id '
                    . ' WHERE t.lang= %s AND t.type = %s AND c.status=%d AND cases_type=0 ' . $filter . ' ORDER BY c.id DESC ', $args));

    }
    $result = array();
    if ($cases_list && $total_count) {
        array_push($result, $cases_list, $total_count);
        return $result;
    } else {
        return false;
    }
}

add_action('wp_ajax_get_interactive_ajax', 'get_interactive_ajax');
add_action('wp_ajax_nopriv_get_interactive_ajax', 'get_interactive_ajax');

function get_interactive_ajax() {
    check_ajax_referer('interactivSecurity', 'security');
    $params = array(
        'date' => $_POST['date'],
        'type' => (int) $_POST['type'],
        'country_id' => (int) $_POST['country'],
        'region_id' => (int) $_POST['region'],
        'lang' => $_POST['lang']
    );
    $result = get_interactive_result($params);
}

function get_interactive_result($params) {
    global $wpdb;
    $sql = get_region_count_sql($params);
    $region = $wpdb->get_results($wpdb->prepare($sql));
    wp_send_json(array('region' => $region));
}

function get_region_count_sql($params) {
    global $wpdb;
    $sql = 'SELECT count(*) as count, c.region_id FROM ' . $wpdb->prefix . 'cases as c '
            . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as ct ON ct.id_trans = c.id '
            . ' WHERE  1=1 AND ct.type="cases" AND c.status=1 AND c.cases_type=0 ';

    if ($params['date'] == null) {
        $sql .= ' AND YEAR(c.date) <= "' . date("Y") . '" AND YEAR(c.date) >= "1994"';
    } elseif (is_array($params['date'])) {
        $date = '';
        foreach ($params['date'] as $year) {
            if ($date) {
                $date.=',' . $year;
            } else {
                $date.=$year;
            }
        }
        $sql .= ' AND YEAR(c.date) IN (' . $date . ') ';
    } elseif ($params['date']) {
        $sql .= ' AND YEAR(c.date) = "' . $params['date'] . '"';
    }

    if ($params['country_id']) {
        $sql .= ' AND c.country_id = "' . $params['country_id'] . '"';
    }
    if ($params['region_id']) {
        $sql .= ' AND c.region_id = "' . $params['region_id'] . '"';
    }
    if ($params['lang']) {
        $sql .= ' AND ct.lang = "' . $params['lang'] . '"';
    }
    $sql .= ' GROUP BY c.region_id';
    return $sql;
}

add_action('wp_ajax_get_interactive_highcharts_ajax', 'get_interactive_highcharts_ajax');
add_action('wp_ajax_nopriv_get_interactive_highcharts_ajax', 'get_interactive_highcharts_ajax');

function get_interactive_highcharts_ajax() {
    check_ajax_referer('interactivSecurity', 'security');
    $params = array(
        'date' => $_POST['date'],
        'type' => (int) $_POST['type'],
        'country_id' => (int) $_POST['country'],
        'region_id' => (int) $_POST['region'],
        'lang' => $_POST['lang']
    );
    $result = get_highcharts_ajax($params);
}

function get_highcharts_ajax($params) {
    global $wpdb;
    $sql = get_reason_count_sql($params);
    $reason = $wpdb->get_results($wpdb->prepare($sql));
    wp_send_json(array('reason' => $reason));
}

function get_reason_count_sql($params) {
    global $wpdb;
    $sql = 'SELECT count(*) as count, c.reason_id, rt.name FROM ' . $wpdb->prefix . 'cases as c '
            . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as ct ON ct.id_trans = c.id '
            . ' INNER JOIN ' . $wpdb->prefix . 'cases_reason as rt ON rt.id = c.reason_id '
            . ' WHERE  1=1 AND ct.type="cases" AND c.status=1 AND c.cases_type=0 ';

    if ($params['date'] == null) {
        $sql .= ' AND YEAR(c.date) <= "' . date("Y") . '" AND YEAR(c.date) >= "1994"';
    } elseif ($params['date']) {
        $sql .= ' AND YEAR(c.date) = "' . $params['date'] . '"';
    }
    if ($params['country_id']) {
        $sql .= ' AND c.country_id = "' . $params['country_id'] . '"';
    }
    if ($params['region_id']) {
        $sql .= ' AND c.region_id = "' . $params['region_id'] . '"';
    }
    if ($params['lang']) {
        $sql .= ' AND ct.lang = "' . $params['lang'] . '"';
    }
    $sql .= ' GROUP BY c.reason_id';
    return $sql;
}

function get_category_name($post_id) {
  $categories = get_the_category($post_id);
  if ($categories) {
    foreach ($categories as $category) {
      if (check_in_exclude($category->term_id) == false) {
        continue;
      } else {
        ?>
        <a href="<?php echo get_category_link($category->term_id); ?>"><?php _e('Back to', 'safesoldiers'); echo ' ' . $category->name; ?></a>
        <?php
        break;
      }
    }
  }
}

function check_in_exclude($cat_id) {
  $excluded = array(FEATURED, FEATUREDANALYSIS, FEATUREDACTIVITY);
  if (in_array($cat_id, $excluded)) {
    return false;
    }
    return true;
}

function nickname_region($region_name){
  if(stripos($region_name, 'ի մարզ')){
    return str_replace('ի մարզ', '', $region_name);
  }
  elseif(stripos($region_name, 'ու մարզ')){
    return str_replace('ու մարզ', 'ի', $region_name);
  }
  elseif(stripos($region_name, 'ի շրջան')){
    return str_replace('ի շրջան', '', $region_name);
  }
  elseif(stripos($region_name, 'ու շրջան')){
    return str_replace('ու շրջան', 'ի', $region_name);
  }
  else{
    return $region_name;
  }
}
