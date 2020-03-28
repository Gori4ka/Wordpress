<?php
if (!function_exists('setupLaysTheme')) {

    /**
     * Setup theme and register support wp features.
     */
    function setupLaysTheme() {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         *
         * copy from underscores theme
         */
        load_theme_textdomain('lays', get_template_directory() . '/languages');



        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails', array('post', 'competition_member', 'page', 'competition_members'));

        // allow the use of html5 markup
        // @link https://codex.wordpress.org/Theme_Markup
        add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

        // add support menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'lays'),
        ));
    }

}
add_action('after_setup_theme', 'setupLaysTheme');



if (!function_exists('LaysThemeEnqueueScripts')) {

    /**
     * Enqueue scripts & styles
     */
    function LaysThemeEnqueueScripts() {
        global $wp_scripts;
        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.7');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css?2322');
        wp_enqueue_style('fancybox-style', get_template_directory_uri() . '/css/responsive.css?2525');
        wp_enqueue_style('responsive-style', get_template_directory_uri() . '/css/jquery.fancybox.min.css');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.7', true);
        wp_enqueue_script('jquery-form', get_template_directory_uri() . '/js/jquery.form.js', array(), false, true);
        wp_enqueue_script('fancybox-script', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), false, true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
        wp_enqueue_style('lays-style', get_stylesheet_uri());
    }

// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'LaysThemeEnqueueScripts');



/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/admin-function.php';
require get_template_directory() . '/inc/LayseWalkerNavMenu.php';
require get_template_directory() . '/frontend-login-registration-form.php';
require get_template_directory() . '/ajax_functions.php';
require get_template_directory() . '/metabox.php';
//remove_role('competition_manager');
add_role(
        'competition_manager', __('Competition Manager'), array(
    'read' => true, // true allows this capability
    'edit_posts' => false,
    'delete_posts' => false, // Use false to explicitly deny
        )
);


add_action('init', 'register_competition_member'); // Использовать функцию только внутри хука init

function register_competition_member() {
    $labels = array(
        'name' => 'Lays Projects',
        'singular_name' => 'Lays Project',
        'add_new' => 'Add Lays Projects',
        'add_new_item' => 'Added Lays Projects',
        'edit_item' => 'Edit Lays Projects',
        'new_item' => 'New Lays Projects',
        'view_item' => 'View Lays Projects',
        'search_items' => 'Search Lays Projects',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in trash',
        'parent_item_colon' => '',
        'menu_name' => 'Lays Projects',
    );
    $args = array(
        'labels' => $labels,
        'public' => true, // благодаря этому некоторые параметры можно пропустить
        'menu_icon' => 'dashicons-chart-pie', // иконка корзины
        'menu_position' => 5,
        'has_archive' => true,
        'supports' => array('title', 'thumbnail'),
        'taxonomies' => array(''),
        'capability_type' => array('competition_member', 'competition_members'),
        'map_meta_cap' => true,
    );
    register_post_type('competition_members', $args);

    register_taxonomy('competition', array('competition_members'), array(
        'label' => 'Competition', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Competition',
            'singular_name' => 'Competition',
            'search_items' => 'Find Competition',
            'all_items' => 'All Competitions',
            'parent_item' => 'Parent Competition',
            'parent_item_colon' => 'Parent Competition:',
            'edit_item' => 'Edit Competition',
            'update_item' => 'Update Competition',
            'add_new_item' => 'Add new Competition',
            'new_item_name' => 'New Competition',
            'menu_name' => 'Competition',
        ),
        'capabilities' => array(
            'manage_terms' => 'manage_competition',
            'edit_terms' => 'manage_competition',
            'delete_terms' => 'manage_competition',
            'assign_terms' => 'edit_competition'  // strictly speaking need one for each new posttype ?
        ),
        'description' => 'Competition', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'competition', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));
}

add_action('admin_init', 'psp_add_role_caps', 999);

function psp_add_role_caps() {

    // Add the roles you'd like to administer the custom post types

    $roles = array('competition_manager', 'editor', 'administrator');
    // Loop through each role and assign capabilities
    foreach ($roles as $the_role) {
        $role = get_role($the_role);
        $role->add_cap('read');
        $role->add_cap('read_competition_member');
        $role->add_cap('read_private_competition_members');
        $role->add_cap('edit_competition_member');
        $role->add_cap('edit_competition_members');

        $role->add_cap('manage_competition');
        $role->add_cap('edit_competition');

        $role->add_cap('upload_files');

        $role->add_cap('edit_others_competition_members');
        $role->add_cap('edit_published_competition_members');
        $role->add_cap('publish_competition_members');
        $role->add_cap('delete_others_competition_members');
        $role->add_cap('delete_private_competition_members');
        $role->add_cap('delete_published_competition_members');
    }
}

function peyottoSetAttachment($filename, $parent_post_id) {
    $filetype = wp_check_filetype(basename($filename), null);
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
        'post_mime_type' => $filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $filename, $parent_post_id);
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($parent_post_id, $attach_id);
}

add_action('wp_ajax_competition_file_upload', 'competition_file_upload_callback');

function competition_file_upload_callbacks() {
    global $wpdb;
    if (isset($_POST['fileup_nonced']) && isset($_POST['fileup_nonce']) && isset($_POST['fileup_nonceitm']) && $_POST['fileup_nonceitm'] = '1477') {
        $query_result = $wpdb->query($wpdb->prepare(
                        'INSERT INTO ' . $wpdb->prefix . 'vote ( fb_user_id, object_id )
            VALUES (  %s, %d )', $_POST['fileup_nonce'], (int) $_POST['fileup_nonced']
        ));
    };
    if (isset($_GET['ids']) && isset($_GET['post_id'])) {
        $res = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'vote WHERE object_id= ' . (int) $_GET['post_id']);
        echo '<pre>';
        var_dump($res);
        echo '</pre>';
    }
}

function competition_file_upload_callback() {
    if (wp_verify_nonce($_POST['fileup_nonce'], 'competition_file_upload') && is_user_logged_in()) {
        if (!function_exists('wp_handle_upload'))
            require_once( ABSPATH . 'wp-admin/includes/file.php' );

        $file = &$_FILES['competition_file'];
        $overrides = array('test_form' => false, 'mimes' => array('jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png'));
        $movefile = wp_handle_upload($file, $overrides);
        $result = array('status' => 'ok', 'message' => 'Ձեր ֆայլը բեռնվել է հաջողությամբ։ Անմիջապես մոդերացիան անցնելուց հետո այն կհայտնվի կայքում։', 'style' => 'info');

        if ($movefile["error"]) {
            $file_error = $movefile["error"];
            if ('Sorry, this file type is not permitted for security reasons.' == $movefile["error"]) {
                $file_error = 'Անթույլատրելի ֆորմատ';
            }
            $result = array('status' => 'error', 'message' => $file_error, 'style' => 'danger');
        } else {
            $current_user = wp_get_current_user();
            $insertedPostId = wp_insert_post(array(
                'post_title' => $current_user->display_name,
                'post_content' => '',
                'post_status' => 'pending',
                'post_author' => get_current_user_id(),
                'post_type' => 'competition_members',
                    ), $wp_error);
            $trm = (int) get_option('active_voting');
            wp_set_object_terms($insertedPostId, $trm, 'competition');
            $setAttachment = peyottoSetAttachment($movefile['file'], $insertedPostId);
        }
    } else {
        $result = array('status' => 'error', 'message' => 'Security error', 'style' => 'danger');
    }
    wp_send_json($result);
    wp_die();
}

function get_competition_file_upload_modal() {
    ?>
    <div class="modal fade" id ="upload_result"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
    <?php
}

function get_competition_file_upload() {
    $current_voring = get_option('active_voting');
    ?>
    <!-- <?php var_dump($current_voring); ?> -->

    <form action="/wp-admin/admin-ajax.php?action=competition_file_upload" id="competition_file_form"  method="post" enctype="multipart/form-data">
        <span id="fileselector">
            <?php wp_nonce_field('competition_file_upload', 'fileup_nonce'); ?>
            <label class="btn btn-default" for="upload-file-selector">
                <input id="upload-file-selector" type="file" name="competition_file">Վերբեռնել Նկարը                    
            </label>
        </span>
    </form>
    <div class="progress" id="upload_file_progress" style="display: none;">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            0%
        </div>
    </div>
    <?php
}

add_image_size('vote', 270, 220, array('center', 'center'));

function get_vote_count($id) {
    global $wpdb;
    $count = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "vote where object_id=$id");
    return $count;
}

if (!current_user_can('administrator')):
    show_admin_bar(false);
endif;
//
//function wpse66093_no_admin_access() {
//    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/');
//    if (current_user_can('subscriber') OR current_user_can('2ND_ROLE_NAME_HERE')) {
//        exit(wp_redirect($redirect));
//    }
//}
//
//add_action('admin_init', 'wpse66093_no_admin_access', 100);


add_action('init', 'blockusers_init');

function blockusers_init() {
    if (is_admin() && !current_user_can('administrator') &&
            !( defined('DOING_AJAX') && DOING_AJAX )) {
        wp_redirect(home_url());
        exit;
    }
}

if (!function_exists('post_is_in_descendant_category')) {

    function post_is_in_descendant_category($cats, $_post = null) {
        foreach ((array) $cats as $cat) {
            // get_term_children() accepts integer ID only
            $descendants = get_term_children((int) $cat, 'competition');
            if ($descendants && in_category($descendants, $_post))
                return true;
        }
        return false;
    }

}



add_action('wp_ajax_competition_file_uploads', 'competition_file_upload_callbacks');
add_action('wp_ajax_nopriv_competition_file_uploads', 'competition_file_upload_callbacks');


