<?php
/**
 * Template for displaying pages
 * 
 * @package lays
 */
get_header();

/**
 * determine main column size from actived sidebar
 */
?> 

<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
<?php get_sidebar('left'); ?> 
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) {
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?> 
                    <div class="clearfix"></div>
                    <?php
                    /**
                     * This wp_link_pages option adapt to use bootstrap pagination style.
                     * The other part of this pager is in inc/template-tags.php function name bootstrapBasicLinkPagesLink() which is called by wp_link_pages_link filter.
                     */
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'lays') . ' <ul class="pagination">',
                        'after' => '</ul></div>',
                        'separator' => ''
                    ));
                    ?>
                </div><!-- .entry-content -->


            </article><!-- #post-## -->
            <?php
        } //endwhile;
        ?> 
    </main>
</div>

<?php get_footer(); ?> 