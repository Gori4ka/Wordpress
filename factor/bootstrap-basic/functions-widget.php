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
        $block_name = $instance['block_name'];
        $category_id = $instance['category_id'];
        $count = $instance['count'];
        ?>
        <div class="<?php echo $block_class; ?> maincol-bottom-margin">
            <?php postBlock($category_id, $count, $block_name); //args(category_id, POST_count)   ?>

        </div>
        <?php
    }

    function form($instance) {
        $defaults = array(
            'title' => __('Advertisement', "boilerplate"));
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p><label for="<?php echo $this->get_field_id('block_name'); ?>"><?php _e('Name:', "bootstrap-basic"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('block_name'); ?>" value="<?php echo $instance['block_name']; ?>" style="width:100%;" /></p>
        <p><label for="<?php echo $this->get_field_id('block_class'); ?>"><?php _e('Block Class:', "bootstrap-basic"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('block_class'); ?>" value="<?php echo $instance['block_class']; ?>" style="width:100%;" /></p>
        <p><label for="<?php echo $this->get_field_id('category_id'); ?>"><?php _e('Category ID:', "bootstrap-basic"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('category_id'); ?>" value="<?php echo $instance['category_id']; ?>" style="width:100%;" /></p>
        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', "bootstrap-basic"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" style="width:100%;" /></p>
        <?php
    }

}

function postBlock($cat, $count, $block_name) {
    global $post;
    $tmp = $post;
    if($cat && $cat != ''){
      $cat_id = $cat;
      $name = get_cat_name( $cat_id );
    }else{
      $cat_id = get_the_category(get_the_ID())[0]->term_id;
      $name = $block_name;
    }
    $args = array(
        'posts_per_page' => $count,
        'offset' => 0,
        'category' => $cat_id,
        'exclude' => get_the_ID(),
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    if ($posts_array) { ?>
      <div class="row animation-element category-block">
          <div class="block-title  animation-element col-xs-12">
            <h3 class="cat-name"><?php echo $name; ?></h3>
          </div>
          <?php foreach ($posts_array as $post_item) {
            $thumbnail = '';
            $play_icon = '<span class="play-icon"><img src="'.get_bloginfo("template_url").'/img/text-icon.png"></span>';
            $video_id = get_post_meta($post_item->ID, 'YoutubeID', true);

            if (get_the_post_thumbnail($post_item->ID)) {

              $thumbnail = get_the_post_thumbnail($post_item->ID);

            } elseif($video_id) {

              $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
              $play_icon = '<span class="play-icon"><img src="'.get_bloginfo("template_url").'/img/video-icon.png"></span>';

            }
          ?>
            <div class="col-xs-12">
              <div class="item clearfix">
                  <a href="<?php echo get_permalink($post_item->ID) ?>">
                    <div class="item-image  animation-element">
                    <?php echo $play_icon; ?>
                      <?php echo $thumbnail; ?>
                    </div>
                    <div class="text-content  animation-element">
                      <div class="item-date"><?php echo get_the_date('d F Y', $post_item->ID); ?></div>
                      <p class="item-title"><?php echo get_the_title($post_item->ID); ?></p>
                      <!-- <div class="item-excerpt"><?php echo custom_get_excerpt($post_item->ID) ?> </div> -->
                    </div>
                  </a>
              </div>
            </div>
          <?php }
          ?>
      </div>
  <?php  }
    $post = $tmp;
}
