<?php
get_header();
?> 
<div class="container">
    <div class="site-content clearfix">
        <div class="category-page-title">
            <h1><?php single_cat_title(); ?></h1>
        </div>            

        <div class="category-page row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="news-item col-md-4">
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
    </div>
</div>
<?php get_footer(); ?> 