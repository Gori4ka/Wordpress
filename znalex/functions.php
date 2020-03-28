<?php
/**
 * Znalex theme
 */

if(ICL_LANGUAGE_CODE == 'cs'){    
    define("ABOUTAS", 70);
    define('LATESTNEWS', 4);
}elseif(ICL_LANGUAGE_CODE == 'en'){
    define("ABOUTAS", 76);
    define('LATESTNEWS', 7);
}

if (!function_exists('znalexSetup')) {
    /**
     * Setup theme and register support wp features.
     */
    function znalexSetup() 
    {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * 
         * copy from underscores theme
         */
        load_theme_textdomain('znalex', get_template_directory() . '/languages');

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
            'primary' => __('Primary Menu', 'znalex'),
        ));

        // add post formats support
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

    }// znalexSetup
}
add_action('after_setup_theme', 'znalexSetup');


if (!function_exists('znalexWidgetsInit')) {
    /**
     * Register widget areas
     */
    function znalexWidgetsInit() 
    {
        register_sidebar(array(
            'name' => __('Sidebar right', 'znalex'),
            'id' => 'sidebar-right',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Sidebar left', 'znalex'),
            'id' => 'sidebar-left',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));




    }// znalexWidgetsInit
}
add_action('widgets_init', 'znalexWidgetsInit');


if (!function_exists('znalexEnqueueScripts')) {
    /**
     * Enqueue scripts & styles
     */
    function znalexEnqueueScripts() 
    {
        global $wp_scripts;

        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.7');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css?1332');
        wp_enqueue_style('responsive-style', get_template_directory_uri() . '/css/responsive.css?123');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);
        wp_enqueue_script('bootstrap-bundle-script', get_template_directory_uri() . '/js/vendor/bootstrap.bundle.min.js');


        wp_register_script('jquery-easing-script', get_template_directory_uri() . '/js/vendor/jquery-easing/jquery.easing.min.js', array(), '1.4.2');
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
        wp_enqueue_script('agency-min-script', get_template_directory_uri() . '/js/agency.min.js', array(), false, true);
        
        wp_enqueue_style('znalex', get_stylesheet_uri());
    }// znalexEnqueueScripts
}
add_action('wp_enqueue_scripts', 'znalexEnqueueScripts');


function add_classes_on_li($classes, $item, $args) {
  $classes = array('nav-item');
  return $classes;
}
add_filter('nav_menu_css_class','add_classes_on_li',1,3);

function add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="nav-link js-scroll-trigger"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');


function custom_post_types() {

    /**

     * Team Profiles Post Type

    */

    $labels = array(
        'name'               => _x( 'Team Profiles', 'post type general name', 'znalex' ),
        'singular_name'      => _x( 'Team Profiles', 'post type singular name', 'znalex' ),
        'menu_name'          => _x( 'Team Profiles', 'admin menu', 'znalex' ),
        'name_admin_bar'     => _x( 'Team Profiles', 'add new on admin bar', 'znalex' ),
        'add_new'            => _x( 'Add New', 'Team Profiles', 'znalex' ),
        'add_new_item'       => __( 'Add New Team Profiles', 'znalex' ),
        'new_item'           => __( 'New Team Profiles', 'znalex' ),
        'edit_item'          => __( 'Edit Team Profiles', 'znalex' ),
        'view_item'          => __( 'View Team Profiles', 'znalex' ),
        'all_items'          => __( 'All Team Profiles', 'znalex' ),
        'search_items'       => __( 'Search Team Profiles', 'znalex' ),
        'parent_item_colon'  => __( 'Parent Team Profiles:', 'znalex' ),
        'not_found'          => __( 'No Team Profiles found.', 'znalex' ),
        'not_found_in_trash' => __( 'No Team Profiles found in Trash.', 'znalex' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'znalex' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'team-profiles' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'Team Profiles', $args );

    $labels = array(
        'name'               => _x( 'Expertise', 'post type general name', 'znalex' ),
        'singular_name'      => _x( 'Expertise', 'post type singular name', 'znalex' ),
        'menu_name'          => _x( 'Expertise', 'admin menu', 'znalex' ),
        'name_admin_bar'     => _x( 'Expertise', 'add new on admin bar', 'znalex' ),
        'add_new'            => _x( 'Add New', 'Expertise', 'znalex' ),
        'add_new_item'       => __( 'Add New Expertise', 'znalex' ),
        'new_item'           => __( 'New Expertise', 'znalex' ),
        'edit_item'          => __( 'Edit Expertise', 'znalex' ),
        'view_item'          => __( 'View Expertise', 'znalex' ),
        'all_items'          => __( 'All Expertise', 'znalex' ),
        'search_items'       => __( 'Search Expertise', 'znalex' ),
        'parent_item_colon'  => __( 'Parent Expertise:', 'znalex' ),
        'not_found'          => __( 'No Team Expertise found.', 'znalex' ),
        'not_found_in_trash' => __( 'No Team Expertise found in Trash.', 'znalex' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'znalex' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'expertise' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'expertise', $args );
}

add_action( 'init', 'custom_post_types' );

function get_team_list() {
    $args = array(
        'suppress_filters' => false,
        'posts_per_page' => -1,
        'category' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'teamprofiles',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        foreach ($posts_array as $post_item) { ?>

            <div class="col-md-4">
                <?= get_the_post_thumbnail($post_item->ID, 'full', array('class' => "mx-auto team-member")); ?>      
                <div class="team-member-position"><?= get_the_title($post_item->ID) ?></div>
                <div class="member-position" data-toggle="modal" data-target="#myModal_<?= $post_item->ID ?>"><p><?= get_post($post_item->ID)->post_excerpt; ?></p></div> 
            </div>

            <!-- Modal -->
			<div class="modal fade" id="myModal_<?= $post_item->ID ?>" role="dialog">
				<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">

						<div class="col-sm-5">
							<h2 class="modal-title"><?= get_the_title($post_item->ID) ?><p class="modal_position"><?= get_post($post_item->ID)->post_excerpt; ?></p></h2>
							<div class="item-bio">
								<div class="scrollbar-inner">
									<p><?= apply_filters('the_content', get_post_field('post_content', $post_item->ID)); ?></p>
								</div>
								<div class="fadeout"></div>
							</div>
						</div>
						<div class="col-sm-7 pad-ri-0">
							<?= get_the_post_thumbnail($post_item->ID, 'full', array('class' => "modal-img")); ?>
						</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>

				</div>
			</div>
    <?php }
    }
}


function get_expertise_list() {
    $args = array(
        'suppress_filters' => false,
        'posts_per_page' => -1,
        'category' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'expertise',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    if ($posts_array) {

        foreach ($posts_array as $key => $post_item) {
            $class = 'gray-div-right';
            if($key % 2 == 0){
                $class = 'gray-div-left';
            }

            $i = $key+1;
            if($key < 10){
                $i = sprintf("%02d", $key+1);
            }

            $border = '';
            if(count($posts_array)-2 == $key){
                $border = 'unic-border';
            }
        ?>
            <div class="col-sm-6 col-md-6 <?=$class ?> <?=$border ?>">
                <ul class="gray-div">
                    <li class="numeric"><?=$i ?>.</li>
                    <li class="numeric-text"><?= get_the_title($post_item->ID) ?></li>
                    <li class="plus-icon" data-toggle="modal" data-target="#myModal_<?= $post_item->ID ?>">+</li>
                </ul>   
            </div>

                        <!-- Modal -->
			<div class="modal fade" id="myModal_<?= $post_item->ID ?>" role="dialog">
				<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">

						<div class="col-sm-7">
							<h4 class="modal-title"><?= get_the_title($post_item->ID) ?><p class="modal_position"><?= get_post($post_item->ID)->post_excerpt; ?></p></h4>
							<div class="item-bio">
								<div class="scrollbar-inner">
									<p><?= apply_filters('the_content', get_post_field('post_content', $post_item->ID)); ?></p>
								</div>
								<div class="fadeout"></div>
							</div>
						</div>
						<div class="col-sm-5">
							<?= get_the_post_thumbnail($post_item->ID, 'full', array('class' => "modal-img")); ?>
						</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>

				</div>
			</div>

    <?php }
    }
}

function get_latest_news_list($cat, $count) {
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
        foreach ($posts_array as $post_item) { 
            if(has_post_thumbnail($post_item->ID)){
                $thumbnail = get_the_post_thumbnail($post_item->ID, 'full', array('class' => "mx-auto team-member"));
            }else{
                $thumbnail = '<img class="mx-auto team-member" src="'.get_bloginfo('template_url').'/img/images/u.png" alt="">';
            }
        ?>
            <div class="col-md-4">
                <div class="post-image"><?=$thumbnail ?></div>   
                <div class="team-member-position inform-position"><span class="inform-part-title"><?= get_the_title($post_item->ID) ?></span></div>
                <a href="<?=get_permalink($post_item->ID);  ?>"><div class="member-position"><p><?php _e('Read more', 'znalex'); ?></p></div></a>
            </div>
    <?php }
    }
}

function get_about_as_page($page_id) {
    $args = array(
        'include' => $page_id,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'page',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        foreach ($posts_array as $post_item) { ?>
            <section class="pt-0 pb-0 bg-grey-right">
                <div class="container">
                    <div class="row d-flex align-items-center about-us">
                        <div class="col-12 col-md-6 pr-5" style="background: url(<?= wp_get_attachment_image_url($post_item->ID);?> no-repeat center center;">
                            <h3 class="section-subheading line-under"><?= get_the_title($post_item->ID) ?></h3>
                            <?= apply_filters('the_content', get_post_field('post_content', $post_item->ID)); ?>
                        </div>
                        <div class="col-12 col-md-6 img-block"></div>
                        
                    </div>
                </div>
            </section>
    <?php }
    }
}