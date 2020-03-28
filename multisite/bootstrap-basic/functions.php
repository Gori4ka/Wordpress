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
            'top' => __('Top Menu', 'bootstrap-basic'),
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
            'name' => __('Sidebar left', 'bootstrap-basic'),
            'id' => 'sidebar-left',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Header right', 'bootstrap-basic'),
            'id' => 'header-right',
            'description' => __('Header widget area on the right side next to site title.', 'bootstrap-basic'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Navigation bar right', 'bootstrap-basic'),
            'id' => 'navbar-right',
            'before_widget' => '',
            'after_widget' => '',
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
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css?11');
        wp_enqueue_style('main-responsive', get_template_directory_uri() . '/css/responsive.css');        
        wp_enqueue_style('main-style-photostory', get_template_directory_uri() . '/css/photostory.css?sss1');
        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');

        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);

        wp_enqueue_script('jquery-tmpl', get_template_directory_uri() . '/js/jquery.tmpl.min.js', array(), false, true);
        wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), false, true);
        wp_enqueue_script('jquery-elastislide', get_template_directory_uri() . '/js/jquery.elastislide.js', array(), false, true);
        wp_enqueue_script('jquery-gallery', get_template_directory_uri() . '/js/gallery.js?3ssssdsd123', array(), false, true);

        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js?2d', array(), false, true);
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
require get_template_directory() . '/function-constant.php';
require get_template_directory() . '/function-metabox.php';
require get_template_directory() . '/function-translate.php';
/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';

function get_video_block($cat, $count) {
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
        <div class="category-block video-block">
            <div class="block-title"><h5><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat) ?></a></h5></div>
            <?php foreach ($posts_array as $post_item) { ?>
                <div class="item">
                    <?php
                    $video_iframe = get_post_meta($post_item->ID, 'embede_code_1', true);
                    if ($video_iframe) {
                        ?>
                        <div class="iframe-wrapper">
                            <div class="video-container">
                                <?php echo $video_iframe; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <a href="<?php echo get_permalink($post_item->ID) ?>">                        
                        <h2 class="item-title"><?php echo get_the_title($post_item->ID); ?></h2>                        
                    </a>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }
}

function custom_get_the_excerpt($post_id) {
    global $post;
    $save_post = $post;
    $post = get_post($post_id);
    $output = get_the_excerpt();
    $post = $save_post;
    return $output;
}

function get_category_block($cat, $count, $class) {

    $args = array(
        'posts_per_page' => $count,
        'category__and' => array($cat, FEATURED),
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);

    if ($posts_array) {
        ?>
        <div class="category-block <?php echo $class; ?>">
            <div class="block-title"><h5><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat) ?></a></h5></div>
            <?php foreach ($posts_array as $post_item) { ?>
                <div class="item">
                    <a href="<?php echo get_permalink($post_item->ID) ?>">
                        <div class="item-date">- <?php echo get_the_date('F d, Y', $post_item->ID); ?> -</div>
                        <h2 class="item-title"><?php echo get_the_title($post_item->ID); ?></h2>
                        
                    </a>
                </div>
            <?php }
            ?>
        </div>
        <?php
    }
}

if (function_exists('add_image_size')) {
    add_image_size('medium-size', 350, 198, true); //(cropped)
}
add_filter('image_size_names_choose', 'my_image_sizes');

function my_image_sizes($sizes) {
    $addsizes = array(
        "medium-size" => __("Medium Size")
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}

function getSimiliarPhotostory($postId, $count) {
    $args = array(
        'posts_per_page' => $count,
        'category' => PHOTOS,
        'orderby' => 'date',
        'exclude' => $postId,
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts_array = get_posts($args);

    if ($posts_array) {       
        ?>
        <div class="category-page row">
            <div class="block-title"><h5><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat) ?></a></h5></div>
            <?php foreach ($posts_array as $post_item) { ?>
                <div class="news-item col-md-4">
                    <a href="<?php echo get_permalink($post_item->ID) ?>" class="preview_link">
                        <div class="item-photo">
                            <?php echo get_the_peyotto_thumbnail($post_item->ID, 'medium-size', array('class' => 'preview', 'width' => "260")); ?>                   
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

function get_the_peyotto_thumbnail($post_id, $size){
    global $blog_id;
    $img = '';
    if(has_post_thumbnail($post_id)){
        $img = get_the_post_thumbnail($post_id, $size);
    }

    if ($blog_id != 1 && $img == '') {
        $arm_id = get_post_meta($post_id, "arm_post_id", true);
        if($arm_id){
            switch_to_blog(1);
            $img = get_the_post_thumbnail($arm_id, $size);
            restore_current_blog();
        }  
    }

   return $img;
}

function get_peyotto_gallery_id($post_id){
    global $blog_id;

    $gallery_id = '';

    if(get_post_meta($post_id, 'GalleryId', true)){
        $gallery_id = get_post_meta($post_id, 'GalleryId', true);
    }

    if ($blog_id != 1 && $gallery_id == ''){
        switch_to_blog(1);
        $arm_id = get_post_meta($post_id, "arm_post_id", true);
        if($arm_id){
            $gallery_id = get_post_meta($arm_id, 'GalleryId', true);
        }
        restore_current_blog();
    }
   return $gallery_id;
}


function my_post_queries( $query ) {
  // not an admin page and it is the main query
  if (!is_admin() && $query->is_main_query()){

    if(is_category(VIDEOS)){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', 21);
    }
  }
}
add_action( 'pre_get_posts', 'my_post_queries' );