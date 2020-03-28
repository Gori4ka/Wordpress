<?php
get_header();
?>

<div class="container category-page">
  <div class="row">
		<h1 class="page-title col-sm-12 col-xs-12">
			<?php printf(__('Search Results for: %s', 'bootstrap-basic'), '<span>' . get_search_query() . '</span>'); ?>
		</h1>
    <div class="category-page-title col-xs-12">
        <h1><?php echo single_cat_title() ?></h1>
    </div>
    <?php
    if (have_posts()) : while (have_posts()) : the_post();

    $thumbnail = '';
    $icon = '<div class="text-icon"></div>';
    $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
    if (get_the_post_thumbnail(get_the_ID())) {

        $thumbnail = get_the_post_thumbnail(get_the_ID());

    } elseif ($video_id) {
        $thumbnail = '<img class="youtube_thumb" src="http://img.youtube.com/vi/' . $video_id . '/0.jpg">';
        $icon = '<div class="play-icon"></div>';
      }

      $thumbnail .= $icon;
            ?>

            <div class="col-sm-4 col-xs-12 category-post-item animation-element">
              <a href="<?php the_permalink() ?>">
                <div class = "category-post-item-image">
                    <?php echo $thumbnail; ?>
                </div>

                <div class="category-post-item-title">
                    <h4 class="category-post-title">
                        <?php the_title(); ?>
                    </h4>
                </div>
              </a>
            </div>

        <?php
        endwhile;
    endif;?>
      <?php wp_pagenavi(); ?>
  </div>
</div>

<?php get_footer(); ?>
