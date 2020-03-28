<?php
get_header();
?> 
<div class="container">
    <div class="site-content clearfix">
        <div class="category-page-title">
            <h1><?php single_cat_title(); ?></h1>
        </div>            

        <div class="category-page row" id="video-category-list">
            <?php
            $i = 1;
            $class = 'col-md-4';
            if (have_posts()) : while (have_posts()) : the_post();
                    if ($i > 3) {
                        $class = 'col-md-2 small-title';
                    }
                    ?>
                    <div class="news-item <?php echo $class ?>">
                        <a href="<?php echo get_permalink(get_the_ID()) ?>" class="preview_link">
                            <div class="item-photo">
                                <?php echo get_the_peyotto_thumbnail(get_the_ID(), 'medium-size', array('class' => 'preview', 'width' => "260")); ?>                   
                            </div>
                            <div class="item-title">
                                <?php the_title(); ?>   
                            </div>
                        </a>   
                    </div>
                    <?php
                    $i++;
                endwhile;
                ?>	
            <?php endif; ?>
        </div>
        <div data-category="<?php echo VIDEOS;?>" data-style="video" data-offset="21" data-destination="video-category-list" class="ajax-load-more"><span class="load-more-button">Ավելին</span></div>
    </div>
</div>
<?php get_footer(); ?> 