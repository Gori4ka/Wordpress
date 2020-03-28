<?php
get_header();
?>
<div class="container marginTop">
    <div class="site-content clearfix">
        <div class="col-sm-9">
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

        <div class="col-sm-3">
          <div class="page-right-sidebar">
            <?php dynamic_sidebar('right-sidebar'); ?>
          </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
