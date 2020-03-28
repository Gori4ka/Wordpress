<?php /* Template Name: Page Fun */ ?>
<?php get_header(); ?>
<div class="content_height clearfix">
<div class="page-fun clearfix">
  <div class="col-md-offset-2 col-md-8">
        <?php
        while (have_posts()) {
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- <header class="entry-header">
                    <h1 class="entry-title page-title"><?php the_title(); ?></h1>
                </header> -->

                <div class = "entry-content">
                    <?php the_content();
                    ?>
                </div><!-- .entry-content -->

            </article><!-- #post -->
            <?php
        } //endwhile;
        ?>
  </div>
</div>
</div>
<?php get_footer(); ?>
