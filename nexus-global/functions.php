<?php
/**
 * nexus-global theme
 */

if (!function_exists('NexusGlobalSetup')) {
    /**
     * Setup theme and register support wp features.
     */
    function NexusGlobalSetup() 
    {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * 
         * copy from underscores theme
         */
        load_theme_textdomain('nexus_global', get_template_directory() . '/languages');

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
            'primary' => __('Primary Menu', 'nexus_global'),
        ));

        // add post formats support
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

    }// NexusGlobalSetup
}
add_action('after_setup_theme', 'NexusGlobalSetup');

if (!function_exists('NexusGlobalEnqueueScripts')) {
    /**
     * Enqueue scripts & styles
     */
    function NexusGlobalEnqueueScripts() 
    {
        global $wp_scripts;

        wp_enqueue_style('igloo-embed-min', get_template_directory_uri() . '/css/igloo.embed.min.css');
        wp_enqueue_style('flag-icon-min', get_template_directory_uri() . '/css/flag-icon.min.css');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/style.css');
        wp_enqueue_style('responsive-style', get_template_directory_uri() . '/css/responsive.css');

        wp_enqueue_script('igloo-embed-min-js', get_template_directory_uri() . '/js/igloo.embed.min.js', array(), false, true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js?12', array(), false, true);
        
        wp_enqueue_style('nexus_global', get_stylesheet_uri());
    }// NexusGlobalEnqueueScripts
}
add_action('wp_enqueue_scripts', 'NexusGlobalEnqueueScripts');



add_filter( 'wp_nav_menu_items', 'your_custom_menu_item');
function your_custom_menu_item ($items)
{
    if(pll_current_language() == 'en'){
        $icon = 'gb';
    }elseif (pll_current_language() == 'cs') {
        $icon = 'cz';
    }
    elseif (pll_current_language() == 'hi') {
        $icon = 'in';
    }
    elseif (pll_current_language() == 'ja') {
        $icon = 'jp';
    }elseif (pll_current_language() == 'ko') {
        $icon = 'kr';
    }
    elseif (pll_current_language() == 'ar') {
        $icon = 'sa';
    }
    elseif (pll_current_language() == 'vi') {
        $icon = 'vn';
    }else{
        $icon = pll_current_language();
    }

    $items = '<li class="dropdown">
                <a style="cursor: pointer;"><span class="dynva"><span class="flag-icon flag-icon-'.$icon.'"></span> '.pll_current_language("name").'</span></a>
                <div class="dropdown-content">
                    <ul class="dropdown-menu dropdown-menu-right" style="-webkit-padding-start: 0px; text-align: left; width: 160px;">
                            <li><a href="'.pll_home_url("ar").'" style="text-decoration:none;"><span class="flag-icon flag-icon-sa"></span> العربية</a></li>
                            <li><a href="'.pll_home_url("cs").'" style="text-decoration:none;"><span class="flag-icon flag-icon-cz"></span> česk&#253;</a></li>
                            <li><a href="'.pll_home_url("de").'" style="text-decoration:none;"><span class="flag-icon flag-icon-de"></span> Deutsch</a></li>
                            <li><a href="'.pll_home_url("en").'" style="text-decoration:none;"><span class="flag-icon flag-icon-gb"></span> English</a></li>
                            <li><a href="'.pll_home_url("fr").'" style="text-decoration:none;"><span class="flag-icon flag-icon-fr"></span> fran&#231;ais</a></li>
                            <li><a href="'.pll_home_url("hi").'" style="text-decoration:none;"><span class="flag-icon flag-icon-in"></span> हिन्दी</a></li>
                            <li><a href="'.pll_home_url("it").'" style="text-decoration:none;"><span class="flag-icon flag-icon-it"></span> italiano</a></li>
                            <li><a href="'.pll_home_url("ja").'" style="text-decoration:none;"><span class="flag-icon flag-icon-jp"></span> 日本の</a></li>
                            <li><a href="'.pll_home_url("ko").'" style="text-decoration:none;"><span class="flag-icon flag-icon-kr"></span> 한국의</a></li>
                            <li><a href="'.pll_home_url("pl").'" style="text-decoration:none;"><span class="flag-icon flag-icon-pl"></span> polski</a></li>
                            <li><a href="'.pll_home_url("pt").'" style="text-decoration:none;"><span class="flag-icon flag-icon-pt"></span> portugu&#234;s</a></li>
                            <li><a href="'.pll_home_url("ru").'" style="text-decoration:none;"><span class="flag-icon flag-icon-ru"></span> русский</a></li>
                            <li><a href="'.pll_home_url("th").'" style="text-decoration:none;"><span class="flag-icon flag-icon-th"></span> ไทย</a></li>
                            <li><a href="'.pll_home_url("tr").'" style="text-decoration:none;"><span class="flag-icon flag-icon-tr"></span> T&#252;rk</a></li>
                            <li><a href="'.pll_home_url("vi").'" style="text-decoration:none;"><span class="flag-icon flag-icon-vn"></span> tiếng việt</a></li>
                            <li><a href="'.pll_home_url("cn").'" style="text-decoration:none;"><span class="flag-icon flag-icon-cn"></span> 中國</a></li>
                    </ul>
                </div>
            </li>' . $items;
    return $items;
}


function add_classes_on_li($classes, $item, $args) {
  $classes = array('');
  return $classes;
}
add_filter('nav_menu_css_class','add_classes_on_li',0,3);

function add_menuclass($ulclass) {
   return preg_replace('/<a href="#">/', '<a><span class="dynva">', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');

function add_menuclass_1($ulclass) {
   return preg_replace('/<\/a>/', '</span></a>', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass_1');

$i=0;
function change_menu_item_id($item, $args)
{
  global $i;
  $i++;
  $item = "menu_item_".$i;
  return $item;
}
add_filter('nav_menu_item_id', 'change_menu_item_id', 10, 2);


function custom_post_types() {

    /**

     * Team Post Type

    */

    $labels = array(
        'name'               => _x( 'Team', 'post type general name', 'nexus_global' ),
        'singular_name'      => _x( 'Team', 'post type singular name', 'nexus_global' ),
        'menu_name'          => _x( 'Team', 'admin menu', 'nexus_global' ),
        'name_admin_bar'     => _x( 'Team', 'add new on admin bar', 'nexus_global' ),
        'add_new'            => _x( 'Add New', 'Team', 'nexus_global' ),
        'add_new_item'       => __( 'Add New Team', 'nexus_global' ),
        'new_item'           => __( 'New Team', 'nexus_global' ),
        'edit_item'          => __( 'Edit Team', 'nexus_global' ),
        'view_item'          => __( 'View Team', 'nexus_global' ),
        'all_items'          => __( 'All Team', 'nexus_global' ),
        'search_items'       => __( 'Search Team', 'nexus_global' ),
        'parent_item_colon'  => __( 'Parent Team:', 'nexus_global' ),
        'not_found'          => __( 'No Team found.', 'nexus_global' ),
        'not_found_in_trash' => __( 'No Team found in Trash.', 'nexus_global' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'nexus_global' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'team' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );

    register_post_type( 'Team', $args );
}

add_action( 'init', 'custom_post_types' );

function get_team_list($posts_array) {
    $i = 3;
    foreach ($posts_array as $post_id) { 
        $post_id = pll_post_id($post_id) ? pll_post_id($post_id) : $post_id; ?>

    <div class="eb_popup" id="popup_<?= $i ?>" pwidth="800" pheight="400">
        <div class="eb_popup_close" onclick="igloo.closePopup('<?= $i ?>')"><i class="icons8-delete-2"></i></div>
        <div class="eb_popup_inside">
            <div class="pb_row pb_row-pad" id="row_pop<?= $i ?>_0">
                <div class="pb_col pb_col-1-3" id="col_pop<?= $i ?>_0">
                    <div id="element_pop<?= $i ?>_0_loop">
                        <div class="el_type_image" id="element_pop<?= $i ?>_0"></div>
                    </div>
                </div>
                <div class="pb_col pb_col-2-3" id="col_pop<?= $i ?>_1">
                    <div id="element_pop<?= $i ?>_1_loop">
                        <div class="el_type_text" id="element_pop<?= $i ?>_1">
                            <div id="element_text_pop<?= $i ?>_1"><span class="el_text dynva"><?=get_the_title($post_id) ?></></div>
                        </div>
                    </div>
                    <div id="element_pop<?= $i ?>_2_loop">
                        <div class="el_type_text" id="element_pop<?= $i ?>_2">
                            <div id="element_text_pop<?= $i ?>_2">
                                <span class="el_text dynva"><?=get_post_field('post_content', $post_id) ?></span>
                            </div>
                        </div>
                    </div>
                    <div id="element_pop<?= $i ?>_3_loop">
                        <div class="el_type_text" id="element_pop<?= $i ?>_3">
                            <div id="element_text_pop<?= $i ?>_3"><span class="el_text dynva"><span style="color: rgb(209, 213, 216);"><em><?=get_the_excerpt($post_id) ?></em></span></></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php   $i++;
    }
}


function get_popup_content($post_id, $num) { 
    $post_id = pll_get_post($post_id) ? pll_get_post($post_id) : $post_id
    ?>
    
    <div class="eb_popup_close" onclick="igloo.closePopup('<?=$num?>')"><i class="icons8-delete-2"></i></div>
    <div class="eb_popup_inside">
        <div class="pb_row pb_row-pad" id="row_pop<?=$num?>_0">
            <div class="pb_col pb_col-1-1" id="col_pop<?=$num?>_0">
                <div id="element_pop<?=$num?>_0_loop">
                    <div class="el_type_text" id="element_pop<?=$num?>_0">
                        <div id="element_text_pop<?=$num?>_0"><span class="el_text dynva"><em><?=get_the_title($post_id) ?></em></></div>
                    </div>
                </div>
                <div id="element_pop<?=$num?>_1_loop">
                    <div class="el_type_text" id="element_pop<?=$num?>_1">
                        <div id="element_text_pop<?=$num?>_1">
                            <span class="el_text dynva">
                                <?=get_post_field('post_content', $post_id) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}

function pll_post_id($post_id) {
    $post_id = pll_get_post($post_id) ? pll_get_post($post_id) : $post_id; 
    return $post_id;
}