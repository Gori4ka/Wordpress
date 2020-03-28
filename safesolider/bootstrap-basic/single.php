<?php
get_header();
?>
<div class="content">
    <div class="container news-more">
      <?php
      get_single_featured_news_block(get_the_ID(), FEATUREDACTIVITY);
      ?>

        <div class="clearfix"></div>
        <div class="center-content">
            <div class="col-lg-2 visible-lg-block"></div>
            <div class="col-xs-12 col-sm-8 col-lg-7 main-article">
                <article class="post">
                    <?php
                    while (have_posts()) {
                        the_post();
                    }
                    ?>
                    <div class="title-holder">
                        <h2 class="title"><?php the_title(); ?></h2>
                    </div>
                    <div class="print_post">
                      <a href="javascript:window.print()"><i class="fa fa-print" aria-hidden="true"></i></a>
                      <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
                    </div>

                    <div class="img_holder">
                      <?php if(get_the_post_thumbnail()){ ?>
                      <div class = "image">
                          <?php echo get_the_post_thumbnail('','medium'); ?>
                      </div>
                      <?php } ?>
                      <div class = "text">
                          <?php the_content(); ?>
                      </div>
                    </div>
                </article>
                <span class="announcements">
                  <?php
                  $currentID = get_the_ID();
                  get_category_name($currentID);
                  ?>
                </span>

            </div>
            <div class = "col-xs-12 col-sm-4 col-lg-3 activity">
                <?php get_latest_video(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
