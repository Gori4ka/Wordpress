<?php
get_header();
?> 
<div class="container">
    <div class="site-content clearfix">
        <div class="col-md-8">
            <?php
            while (have_posts()) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title page-title"><?php the_title(); ?></h1>
                    </header>

                    <div class = "entry-thumbnail">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full') ?>
                    </div>

                    <div class = "entry-content">
                        <?php the_content();
                        ?> 
                        <div class="clearfix"></div>
                    </div><!-- .entry-content -->

                </article><!-- #post -->
                <?php
            } //endwhile;
            ?> 

        </div>

        <div class="col-md-4">
            <?php get_video_block(VIDEOS, 4); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 