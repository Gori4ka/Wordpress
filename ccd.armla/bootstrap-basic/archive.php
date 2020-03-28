<?php
get_header();
?>

<div class="container site-background">
  <div class="row">
      <div class="col-sm-12 category-block">
        <div class="row">
          <div class="category-page-title col-xs-12">
              <h1><?php echo single_cat_title() ?></h1>
          </div>
            <?php
            if (have_posts()) : while (have_posts()) : the_post();

                    $thumbnail = '';

                    $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);

                    if (get_the_post_thumbnail(get_the_ID())) {

                        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'medium');
                    } elseif ($video_id) {

                        $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
                    }
                    ?>

                    <div class="col-sm-3 col-xs-6 category-post-item">
                        <div class = "category-post-item-image image-height">
                            <a href="<?php the_permalink() ?>">
                                <?php echo $thumbnail; ?>
                            </a>
                        </div>

                        <div class="category-post-item-title">
                          <a href="<?php the_permalink(); ?>">
                            <p class="category-post-title">
                                <?php the_title(); ?>
                            </p>
                          </a>
                        </div>
                    </div>

                <?php
                endwhile;
            endif;?>
            <div class="main-pagination col-xs-12">
              <?php wp_pagenavi(); ?>
            </div>
          </div>
        </div>
      </div>
</div>

<?php get_footer(); ?>
