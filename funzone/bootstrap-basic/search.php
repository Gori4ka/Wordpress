<?php
get_header();
?>

<div class="container marginTop">
  <div class="category-section">
    <div class="col-sm-8 col-xs-12">
      <div class="category-block row">
        <div class="category-page-title col-xs-12">
            <h1><?php echo single_cat_title() ?></h1>
        </div>
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
        $play_video = '';
        $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
        $embede_code = get_post_meta(get_the_ID(), 'embede_code', true);
        if($video_id || $embede_code){
          $play_video = '<div class="play-video"></div>';
        }
        ?>
        <div class="category-post-item col-xs-12">

            <div class="category-post-item-title">
                <h1 class="category-post-title">
                  <a href="<?php the_permalink() ?>">
                    <?php the_title(); ?>
                  </a>
                  <div class="the-time"><?php echo the_time('H:i Y-m-d'); ?></div>
                </h1>
            </div>
            <div class="category-post-item-contant">
              <a href="<?php the_permalink() ?>">
                <div class = "category-post-item-image">
                   <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                   <?php echo $play_video; ?>
                </div>
                <div class="item-excerpt">
                  <?php echo get_the_excerpt( get_the_ID() ) ?>
                </div>
              </a>
            </div>
          </div>

            <?php
            endwhile;
        endif;?>
      </div>
      <div class="main-pagination col-xs-12">
        <?php wp_pagenavi(); ?>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <?php dynamic_sidebar('right-sidebar'); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
