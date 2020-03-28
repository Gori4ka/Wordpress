<?php
get_header();
?>

<div class="container category-page video">
  <div class="row category-block">
    <div class="category-page-title col-xs-12">
        <p><?php echo single_cat_title() ?></p>
    </div>
    <?php
    $i = 1;
    if (have_posts()) : while (have_posts()) : the_post();
    $thumbnail = '';
    $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
    if (get_the_post_thumbnail(get_the_ID())) {

        $thumbnail = get_the_post_thumbnail(get_the_ID());

    } elseif ($video_id) {
        $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
      }


      $icon = '<div class="play-icon"></div>';
      
      $thumbnail .= $icon;
        ?>

        <?php
          if($i <= 1){ ?>
          <div class="col-md-6 col-sm-6 col-xs-12 animation-element">
            <div class="video-large-posts">
              <a href="<?php echo get_permalink(get_the_ID()) ?>">
                <div class="item-image  animation-element ">
                <?php echo $play_icon; ?>
                <?php echo $thumbnail; ?>
                </div>
                <div class="text-content  animation-element ">
                  <div class="item-date"><?php echo get_the_date('d F Y | H:i', get_the_ID()); ?></div>
                  <p class="item-title"><?php echo get_the_title(get_the_ID()); ?></p>
                  <div class="item-excerpt"><?php echo custom_get_excerpt(get_the_ID()); ?> </div>
                </div>
              </a>
            </div>
          </div>
          <?php }

          else{ ?>
          <div class="col-md-3 col-sm-3 col-xs-12 medium-posts animation-element">
            <div class="item clearfix">
                <a href="<?php echo get_permalink(get_the_ID()) ?>">
                  <div class="item-image  animation-element ">
                  <?php echo $play_icon; ?>
                    <?php echo $thumbnail; ?>
                  </div>
                  <div class="text-content  animation-element ">
                    <div class="item-date"><?php echo get_the_date('d F Y | H:i', get_the_ID()); ?></div>
                    <p class="item-title"><?php echo get_the_title(get_the_ID()); ?></p>
                    <div class="item-excerpt"><?php echo custom_get_excerpt(get_the_ID()) ?> </div>
                  </div>
                </a>
            </div>
          </div>

        <?php
      }
        $i++;
        endwhile;
    endif;?>
      <?php wp_pagenavi(); ?>
  </div>
</div>

<?php get_footer(); ?>
