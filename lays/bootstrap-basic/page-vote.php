<?php /* Template Name: Page Vote */ ?>
<?php
get_header();
$trm = (int) get_option('active_voting');
?>
<div class="content_height clearfix">
    <?php
    $args = array(
        'posts_per_page' => -1,
        'orderby' => 'date',
        'tax_query' => array(
            array(
                'taxonomy' => 'competition',
                'field' => 'term_id',
                'terms' => $trm,
            )
        ),
        'order' => 'DESC',
        'post_type' => 'competition_members',
        'post_status' => 'publish'
    );
    $posts_array = get_posts($args);
    ?>
    <div class="vote clearfix">
        <div class="peyotto-vote clearfix">
            <?php
            if ($posts_array) {
                ?>
                <div class="col-sm-12">
                    <div class="content-vote clearfix">
                        <?php foreach ($posts_array as $post_item) { ?>
                            <div class="col-sm-3 custom-margin">
                                <div class="post-item">
                                    <div class="item-image">
                                        <a class="fancybox" href="<?php echo get_the_post_thumbnail_url($post_item->ID, 'full') ?>">
                                            <?php echo get_the_post_thumbnail($post_item->ID, 'vote'); ?>
                                        </a>
                                    </div>
                                    <div class="item-title">
                                        <?php echo get_the_title($post_item->ID); ?>
                                    </div>
                                    <div class="item-info vote_item_id_<?php echo $post_item->ID ?>">
                                        <div class="load_vote_content vote-item-wrapper" data-id="<?php echo $post_item->ID ?>">                                           
                                            <div class="item-button item_id_<?php echo $post_item->ID ?> disabled_vote_user_not_logged_in">
                                                <a class="send_like" data-id="<?php echo $post_item->ID ?>">
                                                    Քվեարկել</a>
                                            </div>
                                        </div>
                                        <div class="item-vote-info clearfix">
                                            <?php $count = get_vote_count($post_item->ID); ?>
                                            <div class="item-count" data-count="<?php echo $count ?>">
                                                <?php echo $count ?>
                                            </div>
                                            <div class="share-area">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink($post_item->ID) ?>" target="_blank">
                                                    <img src="<?php echo get_bloginfo('template_url') ?>/img/SHARE.png">
                                                </a>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        <?php }
                        ?>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="col-sm-12 block-6">
            <div class="main-section-text">
                <p class="text">
                    <a target="_blank" href="/2017-Lays-summer-Promo-Rules-07-06-17.pdf">Մրցույթի կանոններ</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
