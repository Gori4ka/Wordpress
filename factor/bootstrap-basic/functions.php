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
            'name' => __('Single Right Sidebar', 'bootstrap-basic'),
            'id' => 'single-right-sidebar',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Moste Read', 'bootstrap-basic'),
            'id' => 'most_read_list',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Author Programs Banner', 'bootstrap-basic'),
            'id' => 'author-programs-banner',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Slider Bottom Banner', 'bootstrap-basic'),
            'id' => 'slider-bottom-banner',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));


        register_sidebar(array(
            'name' => __('Footer left', 'bootstrap-basic'),
            'id' => 'footer-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Footer right', 'bootstrap-basic'),
            'id' => 'footer-right',
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

        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.7');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');
        wp_enqueue_style('responsive-style', get_template_directory_uri() . '/css/responsive.css?5t');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');

        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');



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
require 'function-redis-cache.php';

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
require get_template_directory() . '/functions-widget.php';
require get_template_directory() . '/functions_settings.php';


add_action('admin_head', 'iframe_btn_add_tinymce');

add_action('admin_head', 'video_btn_add_tinymce');

function iframe_btn_add_tinymce() {
    global $typenow;

// Only on Post Type: post and page
    if (!in_array($typenow, array('post', 'page')))
        return;

    add_filter('mce_external_plugins', 'playbuzz_add_tinymce_plugin');

// Add to line 1 form WP TinyMCE
    add_filter('mce_buttons', 'playbuzz_add_tinymce_button');
}

function playbuzz_add_tinymce_plugin($plugin_array) {

    $plugin_array['video_embed'] = '/wp-content/themes/bootstrap-basic/js/btn-plugin.js';
    return $plugin_array;
}

// Add the button key for address via JS
function playbuzz_add_tinymce_button($buttons) {

    array_push($buttons, 'playbuzz_button_key');
//array_push($buttons, 'video_button_key');
// Print all buttons
    return $buttons;
}

function get_home_slider($cat_id, $count) {
    global $wpdb;

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
    $active = 'active';
    ?>
    <ol class="carousel-indicators">
        <?php
        for ($i = 0; $i < $count; $i++) {
            ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>" ></li>
            <?php $active = null; ?>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php
        if ($posts_array) {
            $active = 'active';
            foreach ($posts_array as $post_item) {

                $thumbnail = '';
                $playIcon = '';
                $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                if (get_the_post_thumbnail($post_item->ID)) {
                    $thumbnail = get_the_post_thumbnail($post_item->ID, 'custom-slider-size');
                }
                if ($video_id) {
                    $playIcon = '<div class="big-play-icon"></div>';
                }
                ?>
                <div class="item <?php echo $active; ?>">
                    <a href="<?php echo get_permalink($post_item->ID) ?>">
                        <div class="slider-item-wrapper"><?php echo $playIcon . $thumbnail ?> </div>
                        <div class="carousel-caption">
                            <!-- <div class="carousel-date"><?php //echo get_the_date('F d | H:i | Y', $post_item->ID);                             ?></div> -->
                            <div class="title"><?php echo get_the_title($post_item->ID); ?></div>
                        </div>
                    </a>
                </div>


                <?php
                $active = null;
            }
        }
        ?>
    </div>
    <?php
}

function custom_get_excerpt($post_id) {
    global $post;
    $temp = $post;
    $post = get_post($post_id);
    setup_postdata($post);
    $excerpt = get_the_excerpt();
    wp_reset_postdata();
    $post = $temp;
    return $excerpt;
}

function get_category_block($cat, $count, $class) {

    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="row animation-element category-block <?php echo $class; ?>">
            <div class="block-title  animation-element col-xs-12"><h3 class="cat-name"><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat) ?></a></h3></div>
            <?php
            foreach ($posts_array as $post_item) {
                $thumbnail = '';
                $icon = '<div class="text-icon"></div>';
                $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                if (get_the_post_thumbnail($post_item->ID)) {
                    if ($video_id) {
                        $icon = '<div class="play-icon"></div>';
                    }
                    $thumbnail = get_the_post_thumbnail($post_item->ID);
                } elseif ($video_id) {
                    $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                    $icon = '<div class="play-icon"></div>';
                }

                $thumbnail .= $icon;
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="item clearfix">
                        <a href="<?php echo get_permalink($post_item->ID) ?>">
                            <div class="item-image  animation-element">

                                <?php echo $thumbnail; ?>
                            </div>
                            <div class="text-content animation-element">
                                <div class="item-date"><?php echo get_the_date('d F Y', $post_item->ID); ?></div>
                                <p class="item-title"><?php echo get_the_title($post_item->ID); ?></p>
                                <div class="item-excerpt"><?php echo custom_get_excerpt($post_item->ID) ?> </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }
}

function get_related_posts($cat, $count, $name) {
    $args = array(
        'posts_per_page' => $count,
        'offset' => 0,
        'category' => $cat,
        'exclude' => get_the_ID(),
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="row animation-element related-bloc">
            <div class="related-bloc-title  animation-element col-xs-12"><h3 class="cat-name"><?php echo $name; ?></h3></div>
            <?php
            foreach ($posts_array as $post_item) {
                $thumbnail = '';
                $icon = '<div class="text-icon"></div>';
                $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                if (get_the_post_thumbnail($post_item->ID)) {
                    if ($video_id) {
                        $icon = '<div class="play-icon"></div>';
                    }
                    $thumbnail = get_the_post_thumbnail($post_item->ID);
                } elseif ($video_id) {
                    $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                    $icon = '<div class="play-icon"></div>';
                }

                $thumbnail .= $icon;
                ?>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="related-item clearfix">
                        <?php /*
                          $category_id = get_post_custom_category($post_id);

                          if ($cat != SLIDER && $cat != IMPORTANT && $category_id !='') { ?>
                          <div class="related-cat-name">
                          <a href="<?php echo get_category_link($category_id) ?>">
                          <?php echo get_cat_name($category_id) ?>
                          </a>
                          </div>
                          <?php } */ ?>
                        <a href="<?php echo get_permalink($post_item->ID) ?>">
                            <div class="related-item-image  animation-element">

                                <?php echo $thumbnail; ?>
                            </div>
                            <div class="related-text-content animation-element">
                                <p class="related-item-title"><?php echo get_the_title($post_item->ID); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
            ?>

        </div>
        <?php
    }
}

function get_related_posts_mobail($cat, $count, $name, $img_size) {
    $args = array(
        'posts_per_page' => $count,
        'offset' => 0,
        'category' => $cat,
        'exclude' => get_the_ID(),
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="animation-element related-bloc">
            <div class="related-bloc-title  animation-element col-xs-12"><h3 class="cat-name"><?php echo $name; ?></h3></div>

            <div id="relatedSlid" class="carousel slide" data-interval="4000" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php
                    $i = 0;
                    foreach ($posts_array as $post_item) {
                        $thumbnail = '';
                        $icon = '<div class="text-icon"></div>';
                        $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                        if (get_the_post_thumbnail($post_item->ID)) {
                            if ($video_id) {
                                $icon = '<div class="play-icon"></div>';
                            }
                            $thumbnail = get_the_post_thumbnail($post_item->ID, $img_size);
                        } elseif ($video_id) {
                            $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                            $icon = '<div class="play-icon"></div>';
                        }

                        $thumbnail .= $icon;
                        $active = 'active';
                        if ($i > 0) {
                            $active = '';
                        }
                        ?>

                        <div class="item <?php echo $active ?> col-xs-12">
                            <div class="related-item clearfix">

                                <a href="<?php echo get_permalink($post_item->ID) ?>" >

                                    <div class="related-item-image  animation-element">

                                        <?php echo $thumbnail; ?>
                                    </div>
                                    <div class="related-text-content animation-element">
                                        <p class="related-item-title"><?php echo get_the_title($post_item->ID); ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <a class="left carousel-control" href="#relatedSlid" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#relatedSlid" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <?php
    }
}

function get_breaking_news($cat, $count) {
    $args = array(
        'posts_per_page' => $count,
        'offset' => 0,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <marquee style="background: none;" bgcolor="rgba(204, 204, 204, 0.2)">
            <?php foreach ($posts_array as $post_item) { ?>
                <a href="<?php echo get_permalink($post_item->ID) ?>">
                    <?php echo get_the_title($post_item->ID); ?>
                </a>
            <?php } ?>
        </marquee>
        <?php
    }
}

function get_about_important($cat, $count) {
    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="row animation-element category-block top-stories">
            <div class="block-title  animation-element col-xs-12"><h3 class="cat-name"><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat); ?></a></h3></div>
            <?php
            foreach ($posts_array as $post_item) {
                $thumbnail = '';
                $icon = '<div class="text-icon"></div>';
                $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                if (get_the_post_thumbnail($post_item->ID)) {
                    if ($video_id) {
                        $icon = '<div class="play-icon"></div>';
                    }
                    $thumbnail = get_the_post_thumbnail($post_item->ID);
                } elseif ($video_id) {
                    $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                    $icon = '<div class="play-icon"></div>';
                }

                $thumbnail .= $icon;
                ?>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="item clearfix">
                        <a href="<?php echo get_permalink($post_item->ID) ?>">
                            <div class="item-image  animation-element">

                                <?php echo $thumbnail; ?>
                            </div>
                            <div class="text-content">
                                <p class="item-title"><?php echo get_the_title($post_item->ID); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
            ?>
            <div class="col-xs-12">
                <a class="read-more" href="<?php echo get_category_link($cat) ?>">Բոլորը <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <?php
    }
}

function get_about_important_mobaile($cat, $count, $img_size) {
    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="row animation-element category-block top-stories">
            <div class="block-title  animation-element col-xs-12"><h3 class="cat-name"><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat); ?></a></h3></div>
            <div id="topstoriesSlid" class="carousel slide"  data-interval="4000" data-slide-to="0" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php
                    $i = 0;
                    foreach ($posts_array as $post_item) {
                        $thumbnail = '';
                        $icon = '<div class="text-icon"></div>';
                        $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                        if (get_the_post_thumbnail($post_item->ID)) {
                            if ($video_id) {
                                $icon = '<div class="play-icon"></div>';
                            }

                            $thumbnail = get_the_post_thumbnail($post_item->ID, $img_size);
                        } elseif ($video_id) {
                            $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                            $icon = '<div class="play-icon"></div>';
                        }

                        $thumbnail .= $icon;
                        $active = 'active';
                        if ($i > 0) {
                            $active = '';
                        }
                        ?>

                        <div class="item <?php echo $active ?> col-xs-12 ">
                            <a href="<?php echo get_permalink($post_item->ID) ?>">
                                <div class="item-image  animation-element">

                                    <?php echo $thumbnail; ?>
                                </div>
                                <div class="text-content animation-element">
                                    <p class="item-title"><?php echo get_the_title($post_item->ID); ?></p>
                                </div>
                            </a>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <a class="left carousel-control" href="#topstoriesSlid" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#topstoriesSlid" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <div class="col-xs-12">
                    <a class="read-more" href="<?php echo get_category_link($cat) ?>">Բոլորը <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
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
        <div class=" post-list">
            <div class="post-list-name newsfeed"><h3>Լուրեր</h3></div>
            <div class="lists" id="newsfeed">
                <?php
                foreach ($posts_array as $post_item) {
                    $thumbnail = '';
                    $icon = '<div class="text-icon"></div>';
                    $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                    if (get_the_post_thumbnail($post_item->ID)) {
                        if ($video_id) {
                            $icon = '<div class="play-icon"></div>';
                        }
                        $thumbnail = get_the_post_thumbnail($post_item->ID, 'thumbnail');
                    } elseif ($video_id) {
                        $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                        $icon = '<div class="play-icon"></div>';
                    }

                    $thumbnail .= $icon;
                    ?>


                    <?php
                    if (get_post_meta($post_item->ID, 'bold', true) && get_post_meta($post_item->ID, 'bold', true) != '') {
                        $font_weight = 'font_weight';
                    } else {
                        $font_weight = '';
                    }
                    ?>

                    <div class="item-post clearfix" id="newsfeed-<?php echo $post_item->ID ?>">
                        <a href="<?php echo get_permalink($post_item->ID) ?>">
                            <div class="post-list-image  ">
                                <?php echo $thumbnail; ?>
                            </div>
                            <div class="text-content ">
                                <div class="item-title">
                                    <span class="item-date">
                                        <?php echo get_the_date('d.m.Y | H:i', $post_item->ID); ?>
                                    </span>
                                    <div class="title <?php echo $font_weight ?>"><?php echo get_the_title($post_item->ID); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php }
                ?>
            </div>
            <a class="read-more" href="<?php echo get_permalink(NEWSFEED) ?>">Բոլորը <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
        <?php
    }
}

function get_most_read_post($cat, $count) {
    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="animation-element most-read-list " >
            <div class="block-title"><p>Ամենաընթերցվածը</p></div>
            <?php
            foreach ($posts_array as $post_item) {
                ?>
                <div class=" most-read-post-item clearfix ">
                    <div class="most-read-cat-name">
                        <a href="<?php echo get_category_link($cat) ?>">
                            <?php echo get_cat_name($cat) ?>
                        </a>
                    </div>
                    <div class="item-number"><?php echo $i ?> </div>

                    <div class="item-title">
                        <a href="<?php echo get_permalink($post_item->ID) ?>">
                            <?php echo get_the_title($post_item->ID); ?>
                        </a>
                    </div>
                </div>
            <?php } ?>

        </div>

        <?php
    }


// <article>
//    <a href = "%EC_PERMALINK%">
//         <span class = "entry-number">%EC_NUM%</span>
//         <span class = "entry-thumb">%EC_THUMBNAIL%</span>
//         <span class = "entry-date">%EC_POSTDATE%</span>
//         <span class = "entry-title">%EC_POSTTITLE%</span>
//    </a>
// </article>
}

function get_footer_carousel($cat, $count, $title) {
    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        $active = 'active';
        ?>

        <div class="container">

            <div class="text-center">
                <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="4000" data-slide-to="0" id="slid">
                    <div class="carousel-title col-xs-12">
                        <a href="<?php echo get_category_link($cat) ?>"> <?php echo $title ?></a>
                    </div>
                    <div class="carousel-inner">

                        <?php
                        $i = 0;
                        foreach ($posts_array as $post_item) {

                            if ($i == 0) {
                                ?>
                                <div class="item <?php echo $active ?>">
                                    <?php
                                }
                                $thumbnail = get_the_post_thumbnail($post_item->ID, 'video-slider', array('class' => 'img-responsive'));
                                ?>

                                <div class="col-sm-3 col-xs-12 ">
                                    <a href="<?php echo get_permalink($post_item->ID) ?>">
                                        <div class="image-height">
                                            <?php echo $thumbnail ?>
                                        </div>
                                        <!-- <span class="play-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></span> -->
                                    </a>
                                </div>

                                <?php
                                $i++;
                                if ($i == 4) {
                                    $i = 0;
                                    ?> 
                                </div>
                                <?php
                            }

                            $active = '';
                        }
                        ?>

                    </div>
                    <a class="left carousel-control" href="#slid" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#slid" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>

        <?php
    }
}

function get_footer_carousel_mobail($cat, $count, $title) {
    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        $active = 'active';
        ?>

        <div class="container">

            <div class="text-center">
                <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="4000" id="fruitscarousel_mobail">
                    <div class="carousel-title col-xs-12">
                        <a href="<?php echo get_category_link($cat) ?>"> <?php echo $title ?></a>
                    </div>
                    <div class="carousel-inner">

                        <?php
                        foreach ($posts_array as $post_item) {

                            $thumbnail = get_the_post_thumbnail($post_item->ID, 'video-slider', array('class' => 'img-responsive'));
                            ?>
                            <div class="item <?php echo $active ?>">
                                <div class="col-xs-12 ">
                                    <a href="<?php echo get_permalink($post_item->ID) ?>">
                                        <div class="image-height">
                                            <?php echo $thumbnail ?>
                                        </div>
                                        <!-- <span class="play-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></span> -->
                                    </a>
                                </div>
                            </div>
                            <?php
                            $active = '';
                        }
                        ?>

                    </div>
                    <a class="left carousel-control" href="#fruitscarousel_mobail" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#fruitscarousel_mobail" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>

        <?php
    }
}

function get_item_post($cat, $count, $img_size) {

    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true,
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="category-block animation-element post-list">
            <div class="post-list-name  animation-element"><h3><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat) ?></a></h3></div>
            <?php
            foreach ($posts_array as $post_item) {
                $thumbnail = '';
                $icon = '<div class="text-icon"></div>';
                $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
                if (get_the_post_thumbnail($post_item->ID)) {
                    if ($video_id) {
                        $icon = '<div class="play-icon"></div>';
                    }
                    if ($img_size && $img_size != '') {
                        $thumbnail = get_the_post_thumbnail($post_item->ID, $img_size);
                    } else {
                        $thumbnail = get_the_post_thumbnail($post_item->ID);
                    }
                } elseif ($video_id) {
                    $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                    $icon = '<div class="play-icon"></div>';
                }

                $thumbnail .= $icon;
                ?>
                <div class="col-xs-12">
                    <div class="item clearfix row">
                        <a href="<?php echo get_permalink($post_item->ID) ?>">
                            <div class="item-image  animation-element">
                                <?php echo $thumbnail; ?>
                            </div>
                            <div class="text-content  animation-element">
                                <p class="item-title"><?php echo get_the_title($post_item->ID); ?></p>
                            </div>
                        </a>
                        <a class="read-more" href="<?php echo get_category_link($cat) ?>">Բոլորը <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            <?php }
            ?>

        </div>
        <?php
    }
}

function get_main_live_video($cat, $count) {
    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true,
    );
    $posts_array = get_posts($args);
    $result = '';
    if ($posts_array) {
        foreach ($posts_array as $post_item) {
            $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
            $result .= '<div class="add-live-border"><div class=" post-list live-main-title"><h3>' . get_the_title($post_item->ID) . '</h3></div>';
            $result .= '<div class="main-live-video live-video-container">';
            $result .= '<iframe width="100%" height="175px" src="//www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
            $result .= '</div></div>';
        }
    }
    return $result;
}

function get_live_video($cat, $count) {

    $args = array(
        'posts_per_page' => $count,
        'category' => $cat,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true,
    );
    $posts_array = get_posts($args);
    $result = '';
    if ($posts_array) {
        $result = '<div class="live-video">';
        $result .= '<p class="title"><a>' . get_cat_name($cat) . '</a></p>';
        foreach ($posts_array as $post_item) {
            $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
            $result .='<div class="live-item video-container">';
            $result .= '<iframe width="100%" height="175px" src="//www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
            $result .='</div>';
        }
        $result .='</div>';
    }
    return $result;
}

add_image_size('custom-slider-size', 750, 385, array('center', 'center'));

add_image_size('xs-item-slider-size', 418, 272, array('center', 'center'));

add_image_size('video-slider', 510, 340, array('center', 'center'));




// ONLY WORDPRESS DEFAULT POSTS
add_filter('manage_post_posts_columns', 'ST4_columns_head', 10);
add_action('manage_post_posts_custom_column', 'ST4_columns_content', 10, 2);

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function ST4_columns_head($defaults) {
    $defaults['time'] = 'Publish date';
    return $defaults;
}

function ST4_columns_content($column_name, $post_ID) {
    if ($column_name == 'time') {
        echo get_the_time('Y-m-d H:i', $post_ID);
        // show content of 'directors_name' column
    }
}

function get_post_custom_category($post_id) {

    $cat = get_the_category($post_id)[0]->cat_ID;
    if ($cat == SLIDER || $cat == IMPORTANT || $cat == NEWS) {
        $cat_id = get_the_category($post_id)[1]->cat_ID;
    } else {
        $cat_id = $cat;
    }

    if (post_is_in_descendant_category(CULTURE, $post_id) || $cat_id == CULTURE) {
        return CULTURE;
    } elseif (post_is_in_descendant_category(POLITICS, $post_id) || $cat_id == POLITICS) {
        return POLITICS;
    } elseif (post_is_in_descendant_category(ECONOMY, $post_id) || $cat_id == ECONOMY) {
        return ECONOMY;
    } elseif (post_is_in_descendant_category(SOCIET, $post_id) || $cat_id == SOCIET) {
        return SOCIET;
    } elseif (post_is_in_descendant_category(PROGRAMS, $post_id) || $cat_id == PROGRAMS) {
        return PROGRAMS;
    } elseif (post_is_in_descendant_category(VIDEO, $post_id) || $cat_id == VIDEO) {
        return VIDEO;
    } else {
        return '';
    }
}

if (!function_exists('post_is_in_descendant_category')) {

    function post_is_in_descendant_category($cats, $_post = null) {
        foreach ((array) $cats as $cat) {
            // get_term_children() accepts integer ID only
            $descendants = get_term_children((int) $cat, 'category');
            if ($descendants && in_category($descendants, $_post))
                return true;
        }
        return false;
    }

}

add_action('pre_get_posts', 'mp_design_cat_posts_per_page');

function mp_design_cat_posts_per_page($query) {
    if ($query->is_main_query() && is_category(VIDEO) && !is_admin()) {
        $query->set('posts_per_page', '21');
    }
}

add_filter('the_content', 'wpse8170_add_custom_table_class');

function wpse8170_add_custom_table_class($content) {
    return str_replace('<table ', '<table class="table table-bordered" ', $content);
}
