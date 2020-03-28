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
            'name' => __('Subscribe sidebar', 'bootstrap-basic'),
            'id' => 'subscribe-sidebar',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));
        register_sidebar(array(
            'name' => __('After Top menu Banner', 'bootstrap-basic'),
            'id' => 'after-top-menu-banner',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Right sidebar', 'bootstrap-basic'),
            'id' => 'right-sidebar',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Left sidebar', 'bootstrap-basic'),
            'id' => 'left-sidebar',
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
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css?1a5');
        wp_enqueue_style('responsive-style', get_template_directory_uri() . '/css/responsive.css?23e');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js?111', array(), false, true);
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
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';
require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';
require get_template_directory() . '/functions-constant.php';
require get_template_directory() . '/function-metabox.php';
require get_template_directory() . '/functions-widget.php';
require get_template_directory() . '/function-redis-cache.php';

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


function get_home_posts_list($count) {
  global $wpdb, $blog_id;
    $args = array(
        'posts_per_page' => $count,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
    );
    $posts_array = get_posts($args);
    $post_arrey_id = [];
    if ($posts_array) { ?>
      <div class="cover-section clearfix">
      <?php
        foreach ($posts_array as $post_item) {
          $play_video = '';
          $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
          $embede_code = get_post_meta($post_item->ID, 'embede_code', true);
          if($video_id || $embede_code){
            $play_video = '<div class="play-video"></div>';
          }
          array_push($post_arrey_id, $post_item->ID);
        ?>

          <div class="cover-block col-sm-4">
            <div class="project-cover cfix first " >
                <div class="cover-img">
                  <div class="cover-image">
                    <a class="cover-img-link" href="<?php echo get_permalink($post_item->ID) ?>">
                      <?php echo get_the_post_thumbnail($post_item->ID, 'cover-img'); ?>
                      <?php echo $play_video; ?>
                    </a>
                  </div>
                </div>
                <div class="cover-title">
                  <a href="<?php echo get_permalink($post_item->ID) ?>">
                    <?php echo get_the_title($post_item->ID); ?>
                  </a>
                </div>
                <div class="cover-info-stats">
                    <div class="cover-stat-fields-wrap">
                      <div class="cover-stat-wrap">
                          <span class="cover-stat cover-stat-appreciations " >
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>320</span>
                            <span class="cover-stat"><i class="fa fa-eye" aria-hidden="true"></i>
                              <span class="cover-stat-views-<?php echo $post_item->ID; ?>">*</span>
                            </span>
                          <div class="cover-date">
                              <?php echo get_the_date("H:i", $post_item->ID) ?>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
<?php
        }?>
      </div>
        <div style="display:none;" id='post_arrey_id' blog-id="<?php echo $blog_id;?>" post-arrey-id="<?php echo json_encode($post_arrey_id); ?>"></div>
        <div class="main-pagination col-sm-12">
          <?php wp_pagenavi(); wp_reset_postdata(); ?>
        </div>
<?php
    }
}


function get_home_top_section_posts($cat_id, $count){
  $args = array(
      'posts_per_page' => $count,
      'offset' => 0,
      'category' => $cat_id,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' => 'post',
      'post_status' => 'publish'
  );
  $posts_array = get_posts($args);
  if ($posts_array) { ?>
    <div class="clearfix">
  <?php
  foreach ($posts_array as $post_item) {
    $play_video = '';
    $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
    $embede_code = get_post_meta($post_item->ID, 'embede_code', true);
    if($video_id || $embede_code){
      $play_video = '<div class="play-video"></div>';
    }
  ?>
  <div class="col-sm-3 col-xs-12 hero-item-post">
      <a href="<?php echo get_permalink($post_item->ID) ?>" class="hero omniture-track">
        <div class="hero-image-container">
          <div class="hero-image">
            <?php echo get_the_post_thumbnail($post_item->ID, 'hero-image'); ?>
          </div>
          <?php echo $play_video; ?>
        </div>
        <div class="hero-content">
              <div class="hero-channel">
                <?php echo get_cat_name(get_post_custom_category($post_item->ID)); ?>
              </div>
              <div class="hero-title">
                <?php echo get_the_title($post_item->ID); ?>
              </div>
              <div class="meta">
                <div class="item-date">
                    <?php echo get_the_date("H:i d-m-Y", $post_item->ID) ?>
                </div>
                  <!-- <span class="by"> by </span> <?php echo get_the_author_meta('display_name', $post_item->post_author); ?> -->
              </div>
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

function get_related_posts($cat, $count){

  $args = array(
    'category' => $cat,
    'posts_per_page' => $count,
    'offset' => 0,
    'exclude' => get_the_ID(),
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish'
  );

  $posts_array = get_posts($args);
  if ($posts_array) {
      foreach ($posts_array as $post_item) {
        $play_video = '';
        $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
        $embede_code = get_post_meta($post_item->ID, 'embede_code', true);
        if($video_id || $embede_code){
          $play_video = '<div class="play-video"></div>';
        }
          ?>
          <div class="col-sm-4 col-xs-6">
            <div class="related-item clearfix">
              <a href="<?php echo get_permalink($post_item->ID); ?>">
                <div class="related-item-image">
                  <?php echo get_the_post_thumbnail($post_item->ID, 'related-image'); ?>
                  <?php echo $play_video; ?>
                </div>
                <div class="related-item-title">
                    <?php echo get_the_title($post_item->ID); ?>
                </div>
              </a>
            </div>
          </div>
  <?php
    }
  }
}

function get_post_custom_category($post_id) {

    $cat = get_the_category($post_id)[0]->cat_ID;
    if ($cat == FEATURED || $cat == ALLNEWS) {
        $cat_id = get_the_category($post_id)[1]->cat_ID;
    } else {
        $cat_id = $cat;
    }



    if (post_is_in_descendant_category(VIDEO, $post_id) || $cat_id == VIDEO) {
        return VIDEO;
    } elseif (post_is_in_descendant_category(SPORT, $post_id) || $cat_id == SPORT) {
        return SPORT;
    } elseif (post_is_in_descendant_category(SHOPPING, $post_id) || $cat_id == SHOPPING) {
        return SHOPPING;
    } elseif (post_is_in_descendant_category(FESHION, $post_id) || $cat_id == FESHION) {
        return FESHION;
    } else {
        return '';
    }
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


add_action( 'pre_get_posts',  'set_posts_per_page'  );
function set_posts_per_page( $query ) {
  if (is_archive() || is_search()) {
    $query->set( 'posts_per_page', 5 );
  }
  return $query;
}

function get_post_view($post_id) {
    global $blog_id, $wpdb;

    if ($blog_id == 1) {
        $prefix = 'wp';
    } else {
        $prefix = 'wp_' . $blog_id;
    }

    $redis = get_redis();
    $key = 'post_view_' . $blog_id . '_' . $post_id;
    $calculator = 'calculator_' . $blog_id . '_' . $post_id;
    $post_view = 0;
    if ($redis) {
        $post_view = $redis->get($key);
        if ($post_view) {
            $redis->incr($key);
            $redis->incr($calculator);
            if ($redis->get($calculator) > 10) {
                $wpdb->query($wpdb->prepare('UPDATE ' . $prefix . '_popularpostsdata SET post_view = %d WHERE postid = %d', $post_view, $post_id));
                $redis->set($calculator, 0);
            }
        } else {
            $post_view = $wpdb->get_var('SELECT post_view FROM ' . $prefix . '_popularpostsdata WHERE postid = ' . $post_id);

            if (!$post_view) {
                $wpdb->insert(
                    $prefix . '_popularpostsdata', array(
                    'postid' => $post_id,
                    'date' => date('Y-m-d H:i:s'),
                    'post_view' => 0
                        ), array(
                    '%d',
                    '%s',
                    '%d'
                        )
                );
            }

            $post_view++;
            $redis->set($key, (int) $post_view);
            $redis->set($calculator, 0);
        }
    }

//        if($post_id == 243575){
//            $redis->set($key, 3478);
//        }

    return $post_view;
}

add_action('wp_ajax_peyotto_post_viwe', 'peyotto_post_viwe');
add_action('wp_ajax_nopriv_peyotto_post_viwe', 'peyotto_post_viwe');

function peyotto_post_viwe() {
    check_ajax_referer( 'security', 'security' );
    if(!$_POST['post_id']){
      wp_send_json(array('status' => 'error'));
    }
    $post_id = intval($_POST['post_id']);
    $viwe_count = get_post_view($post_id);
    wp_send_json(array('status' => 'ok', 'count' => $viwe_count, 'post_id' => $post_id));
    die;
}
//
// $request = new FacebookRequest(
//   $session,
//   'GET',
//   '/',
//   array(
//     'id' => get_permalink($post_id),
//     'fields' => 'engagement'
//   )
// );
//
// $response = $request->execute();
// $graphObject = $response->getGraphObject();
// /* handle the result */

add_action('wp_ajax_peyotto_home_post_viwe_count', 'peyotto_home_post_viwe_count');
add_action('wp_ajax_nopriv_peyotto_home_post_viwe_count', 'peyotto_home_post_viwe_count');

function peyotto_home_post_viwe_count() {
  global $blog_id, $wpdb;
  $redis = get_redis();
    check_ajax_referer( 'home_security', 'security' );
    if(!$_POST[posts_ids] || !$_POST[blog_id]){
      wp_send_json(array('status' => 'error'));
    }
    $data = [];
    foreach (json_decode($_POST[posts_ids]) as $post_id) {
      $key = 'post_view_' . $_POST[blog_id] . '_' . $post_id;
      $post_view = $redis->get($key);
      if(!$post_view){
        $post_view = $wpdb->get_var('SELECT post_view FROM wp_popularpostsdata WHERE postid = ' . $post_id);
        if(!$post_view){
          $post_view = 0;
        }
      }
      $data[$post_id] = $post_view;

    }
    wp_send_json(array('status' => 'ok', 'blog_id' => $_POST[blog_id], 'data' => json_encode($data)));
    die;
}

add_image_size('hero-image', 360, 360, array('center', 'center'));
add_image_size('cover-img', 330, 180, array('center', 'center'));
add_image_size('sidebar-image', 300, 150, array('center', 'center'));
add_image_size('related-image', 220, 170, array('center', 'center'));
