<?php
/*
  Plugin Name: Cases Infograph
  Plugin URI: http://peyotto.com
  Version: 15.0
  Author: Edgar Marukyan Artush Mkrtchyan
  Description: Show cases infograph...
 */

class cases_infograph extends WP_Widget {

    function __construct() {
        parent::__construct(
                'cases_infograph', __('Cases Infograph', 'cases-infograph'), array('description' => __('Show infograph', 'cases-infograph'),)
        );
    }

    public function widget($args, $instance) {
        get_infograph();
    }

    public function form($instance) {

    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        return $new_instance;
    }

}

// Class wpb_widget ends here
// Register and load the widget
function wpb_load_widget() {
    include('function.php');
    register_widget('cases_infograph');
}

function wp_load_infograph_styles() {
    $pluginfolder =  '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
    wp_enqueue_style('infograph-style', $pluginfolder . '/css/infograph-style.css');
    wp_enqueue_style('infograph-style', $pluginfolder . '/css/bootstrap.min.css');
    wp_enqueue_style('infograph-style', $pluginfolder . '/css/bootstrap-combined.min.css');
    wp_enqueue_script('infographic-function', $pluginfolder . '/js/infograph-functions.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'wp_load_infograph_styles');
add_action('widgets_init', 'wpb_load_widget');
add_action('wp_head', 'infograph_ajaxurl');

function infograph_ajaxurl() {
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}
