<?php
get_header();
?>
<?php

  $paged = get_query_var('paged') ? get_query_var('paged') : 1;

  $query_args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => $paged,
  );
  
  $the_query = new WP_Query( $query_args );
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 news-feed">
            <div class="category-page-title">
              <p><?php the_title() ?></p>
            </div>
            <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

                $icon = '<div class="text-icon"></div>';
                $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);

                $thumbnail = get_the_post_thumbnail(get_the_ID());

                if ($video_id) {
                    $icon = '<div class="play-icon"></div>';
                }

                $thumbnail .= $icon;
                  ?>

         
            <div class="col-xs-12">
                <div class="item row clearfix">
                    <a href="<?php echo get_permalink(get_the_ID()) ?>">
                      <div class="item-image col-sm-4  animation-element">
                        <?php echo $thumbnail; ?>
                      </div>
                      <div class="text-content col-sm-8">
                        <div class="title">
                          <span class="item-date"><?php echo get_the_date('d F Y | H:i', get_the_ID()); ?></span>
                          <span class="item-title"><?php echo get_the_title(get_the_ID()); ?></span>
                        </div>
                        <p class="item-excerpt"><?php echo custom_get_excerpt(get_the_ID()) ?></p>
                      </div>
                    </a>
                </div>
            </div>


            <?php endwhile; ?>
            
            <?php wp_pagenavi( array( 'query' => $the_query ) ); ?>
            <?php wp_reset_query(); ?>

        </div>

        <div class="col-sm-4">
            <?php echo get_live_video(LIVEVIDEO, 1); ?>
        </div>

        <?php else: ?>
          <div>
            <h1>Sorry...</h1>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
          </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>