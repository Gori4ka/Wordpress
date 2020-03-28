<?php
/* ----------------------------------------------------------------------------------- */
// This starts the CATEGORY BLOCK.
/* ----------------------------------------------------------------------------------- */

add_action('widgets_init', 'category_block_widgets');

function category_block_widgets() {
    register_widget('Categoery_Widget');
}

class Categoery_Widget extends WP_Widget {

    function Categoery_Widget() {
        $widget_ops = array('classname' => 'category_block', 'description' => __('Category_block', "boilerplate"));
        $this->WP_Widget('categoery_widget', __('Categoery Widget', "boilerplate"), $widget_ops, '');
    }

    function widget($args, $instance) {
        extract($args);
        // $title = apply_filters('widget_title', __($instance['title'], 'boilerplate'));
        $block_class = $instance['block_class'];
        $category_id = $instance['category_id'];
        $count = $instance['count'];
        ?>
        <div class="<?php echo $block_class; ?> maincol-bottom-margin">
            <?php postBlock($category_id, $count); //args(category_id, POST_count)   ?>
        </div>
        <?php
    }

    function form($instance) {
        $defaults = array(
            'title' => __('Advertisement', "boilerplate"));
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p><label for="<?php echo $this->get_field_id('block_class'); ?>"><?php _e('Block Class:', "boilerplate"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('block_class'); ?>" value="<?php echo $instance['block_class']; ?>" style="width:100%;" /></p>
        <p><label for="<?php echo $this->get_field_id('category_id'); ?>"><?php _e('Category ID:', "boilerplate"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('category_id'); ?>" value="<?php echo $instance['category_id']; ?>" style="width:100%;" /></p>
        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', "boilerplate"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" style="width:100%;" /></p>
        <?php
    }

}

function postBlock($cat, $count) {
    $args = array(
      'category' => $cat,
      'posts_per_page' => $count,
      'offset' => 0,
      'exclude' => is_singular() ? get_the_ID() : '',
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' => 'post',
      'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    if ($posts_array) {
        $curr_cat = get_category($cat);
        echo '<div class="post-block-widget ' . $curr_cat->slug . '-widget">';
        echo '<div class="block-title"><a href="' . get_category_link($cat) . '">' . get_cat_name($cat) . '</a></div>';
        echo '<ul class="post-block-list">';
        foreach ($posts_array as $post_item) {

          $play_video = '';
          $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);
          $embede_code = get_post_meta($post_item->ID, 'embede_code', true);
          if($video_id || $embede_code){
            $play_video = '<div class="play-video"></div>';
          }
            ?>
            <li class="item clearfix">
                <a class="preview" href="<?php echo get_permalink($post_item->ID); ?>">
                  <div style="position: relative">
                    <?php echo get_the_post_thumbnail($post_item->ID, 'sidebar-image'); ?>
                    <?php echo $play_video; ?>
                  </div>
                </a>
                <div class="right_column">
                    <a class="link" href="<?php echo get_permalink($post_item->ID); ?>" rel="nofollow">
                        <?php echo get_the_title($post_item->ID); ?>
                    </a>
                </div>
            </li>
            <?php
        }
        echo '</ul></div>';
    }
}
