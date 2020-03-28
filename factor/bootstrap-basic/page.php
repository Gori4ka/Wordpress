<?php
get_header();
?>
<div class="page-content clearfix container">
  <div class="row">
    <div class="col-sm-8">
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
    <div class="archive-right col-sm-4 col-xs-12 ">
      <div class="news">
        <?php echo get_news_posts('', 15); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
