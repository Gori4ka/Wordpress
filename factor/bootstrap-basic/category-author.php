<?php
get_header();
?>
<div class=" author-page">

<div class="container">
    <div class="slider-bottom-banner col-xs-12">
  		<div class="row">
  			<?php dynamic_sidebar('slider-bottom-banner'); ?>
  		</div>
  	</div>
</div>
<div class="container-fluid author-background">
  <div class="container">
    <div class="row">
      <div class="title col-xs-12">
          <p><?php _e('Վերնագիր', 'bootstrap-basic') ?></p>
      </div>
      <?php
      $i = 1;
      if (have_posts()) : while (have_posts()) : the_post();

          $icon = '<div class="text-icon"></div>';
          $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
          $thumbnail = get_the_post_thumbnail(get_the_ID());

        if ($video_id) {
          $icon = '<div class="play-icon"></div>';
        }

        $thumbnail .= $icon;
          ?>

          <?php
            if($i <= 2){
          ?>
            <div class="col-sm-6 col-xs-12 animation-element">
              <div class="author-large-posts">
                <div class="item-date"><?php echo get_the_date('d F Y | H:i', get_the_ID()); ?></div>
                <a href="<?php echo get_permalink(get_the_ID()) ?>">
                  <div class="item-image  animation-element ">
                  <?php echo $thumbnail; ?>
                  </div>
                  <div class="text-content">
                    <p class="item-title"><?php echo get_the_title(get_the_ID()); ?></p>
                    <div class="item-excerpt"><?php echo the_excerpt(get_the_ID()); ?> </div>
                  </div>
                </a>
              </div>
            </div>
      <?php }else{ ?>

        <div class="col-sm-4 col-xs-12 animation-element">
          <div class="author-posts">
            <div class="item-date"><?php echo get_the_date('d.m.Y | H:i', get_the_ID()); ?></div>
            <a href="<?php echo get_permalink(get_the_ID()) ?>">
              <div class="item-image  animation-element ">
              <?php echo $play_icon; ?>
              <?php echo $thumbnail; ?>
              </div>
              <div class="text-content  animation-element ">
                <p class="item-title"><?php echo get_the_title(get_the_ID()); ?></p>
                <div class="item-excerpt"><?php echo the_excerpt(get_the_ID()); ?> </div>
              </div>
            </a>
          </div>
        </div>

      <?php }
      $i++;
      endwhile;
  endif;?>
  <?php wp_pagenavi(); ?>
    </div>
  </div>
</div>

</div>
<?php get_footer(); ?>
