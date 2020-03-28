<?php
/**
 * Template for displaying single post (read full post page).
 * 
 * @package lays
 */
get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 
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

                    <div class="entry-meta">
                        <?php bootstrapBasicPostOn(); ?> 
                    </div><!-- .entry-meta -->
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

                <footer class="entry-meta">
                    <?php
                    /* translators: used between list items, there is a space after the comma */
                    $category_list = get_the_category_list(__(', ', 'lays'));

                    /* translators: used between list items, there is a space after the comma */
                    $tag_list = get_the_tag_list('', __(', ', 'lays'));

                    echo bootstrapBasicCategoriesList($category_list);
                    if ($tag_list) {
                        echo ' ';
                        echo bootstrapBasicTagsList($tag_list);
                    }
                    echo ' ';
                    printf(__('<span class="glyphicon glyphicon-link"></span> <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>.', 'lays'), get_permalink(), the_title_attribute('echo=0'));
                    ?> 

                    <?php bootstrapBasicEditPostLink(); ?> 
                </footer><!-- .entry-meta -->
            </article><!-- #post -->
            <?php
            echo "\n\n";

            bootstrapBasicPagination();

            echo "\n\n";

            // If comments are open or we have at least one comment, load up the comment template
            if (comments_open() || '0' != get_comments_number()) {
                comments_template();
            }

            echo "\n\n";
        } //endwhile;
        ?> 
    </main>
</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 
