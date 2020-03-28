<?php /* Template Name: Page Vote */ ?>
<?php
get_header();
?>
<div class="clearfix content_height">
<div class = "vote clearfix">
    <div class = "peyotto-vote clearfix">
        <div class = "col-sm-12">
            <div class = "content-vote sinle-vote clearfix">
                <?php
                while (have_posts()) {
                    the_post();
                    ?>
                    <div class="col-sm-6 col-sm-offset-3 col-xs-offset-1 col-xs-10 stmp-<?php echo get_the_ID(); ?>">
                        <div class="post-item">
                            <div class="item-image">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                            </div>
                            <div class="item-title">
                                <?php echo get_the_title(get_the_ID()); ?>
                            </div>
                            <div class="item-info vote_item_id_<?php echo get_the_ID() ?>">
                                <div class="load_vote_content vote-item-wrapper" data-id="<?php echo get_the_ID() ?>">
                                    <div class="load_vote_items"></div>
                                </div>
                                <div class="item-vote-info">
                                    <?php $count = get_vote_count(get_the_ID()); ?>
                                    <div class="item-count" data-count="<?php echo $count ?>">
                                        <?php echo $count ?>
                                    </div>
                                    <div class="share-area">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(get_the_ID()) ?>" target="_blank">
                                            <img src="<?php echo get_bloginfo('template_url') ?>/img/SHARE.png">
                                        </a>
                                        <!-- <div class="fb-share-button" data-href="<?php echo get_permalink(get_the_ID()); ?>" data-layout="button" data-size="large" data-mobile-iframe="false"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
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
