<?php
get_header();
$cat = get_query_var('cat');
?>
<div class="content">
    <div class="container news">
        <div class="clearfix">
            <?php
            if (cat_is_ancestor_of(ACTIVITY, $cat) || $cat == ACTIVITY) {
                get_featurd_news_block($cat, FEATUREDACTIVITY);
            } else if (cat_is_ancestor_of(ANALYSIS, $cat) || $cat == ANALYSIS) {
                get_featurd_news_block($cat);
            }
            ?>
        </div>
        <div class="center-content">
            <div class="col-xs-12 col-sm-4 col-lg-3 activity">
                <?php
                if (cat_is_ancestor_of(ACTIVITY, $cat) || is_category(ACTIVITY)) {
                    get_current_category_menu(ACTIVITY);
                } elseif (cat_is_ancestor_of(ANALYSIS, $cat) || is_category(ANALYSIS)) {
                    get_current_category_menu(ANALYSIS);
                } elseif(cat_is_ancestor_of(LEGAL, $cat) || is_category(LEGAL)){
                  get_current_category_menu(LEGAL);
                }
                ?>

                <?php get_latest_video(); ?>
            </div>
            <div class="col-xs-12 col-sm-8 col-lg-6 more_articles">
                <h3><?php _e('More articles', 'safesoldiers'); ?></h3>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="item">
                            <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                            <span class="post_date"><?php _e('Posted', 'safesoldiers') ?> <?php echo get_the_date('d F, Y', $post_item->ID); ?></span>
                            <?php get_post_category_list($post_item->ID) ?>
                            <div class="img_holder">
                                <?php if (get_the_post_thumbnail()) { ?>
                                    <div class = "image">
                                        <?php echo get_the_post_thumbnail('', 'thumbnail'); ?>
                                    </div>
                                <?php } ?>
                                <p class="text">
                                    <?php the_excerpt(); ?>
                                </p>
                            </div>
                            <a href="<?php the_permalink() ?>"><?php _e('Read more', 'safesoldiers') ?></a>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>

                <?php
                if (function_exists('wp_paginate')) {
                    wp_paginate();
                } else {
                    twentythirteen_paging_nav();
                }
                ?>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-3 latest_video">
                <?php get_latest_video(); ?>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<?php get_footer(); ?>
