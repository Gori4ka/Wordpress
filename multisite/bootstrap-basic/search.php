
<?php
get_header();
?> 
<div class="container">
    <div class="site-content clearfix cat_multi-group">
        <div id="main" class="col-md-8 clearfix">
            <div class="category-page-title ">
                <h1 class="page-title"><?php printf(__('Search Results for: %s', 'bootstrap-basic'), '<span>' . get_search_query() . '</span>'); ?>      </h1>
            </div>            

            <div class="category-page row">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="news-item col-md-6">
                            <a href="<?php echo get_permalink(get_the_ID()) ?>" class="preview_link">
                                <div class="item-photo">
                                    <?php echo get_the_peyotto_thumbnail(get_the_ID(), 'medium-size', array('class' => 'preview', 'width' => "260")); ?>                   
                                </div>
                                <div class="item-title">
                                    <?php the_title(); ?>   
                                </div>
                            </a>   
                        </div>
                    <?php endwhile; ?>	
                <?php endif; ?>
            </div>
            <?php wp_pagenavi(); ?>
        </div> <!-- end #main -->
        <div class="col-md-4">
            <?php get_video_block(VIDEOS, 4); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?> 
