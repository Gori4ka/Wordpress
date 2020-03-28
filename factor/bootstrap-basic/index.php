<?php
/**
 * The main template file
 *
 * @package bootstrap-basic
 */
get_header();
?>

<div class="container home-block">
    <?php if (get_option('breaking-news') && get_option('breaking-news') == 1) { ?>
        <div class="breaking-news clearfix">
            <div class="title col-md-2 col-sm-3">
                <?php _e('Breaking news', 'bootstrap-basic'); ?>
            </div>
            <div class="news-link col-md-10 col-sm-9">
                <?php echo get_breaking_news(BREAKINGNEWS, 3) ?>
            </div>
        </div>
        <?php
    }
    $live = get_main_live_video(LIVEVIDEO, 1);
    $live_class = '';
    if ($live != '') {
        $live_class = 'have_live';
    }
    ?>
    <div class="row top-block ordrable-section">
        <div class="col-md-4 col-sm-12 second-section">
            <div class="news  <?php echo $live_class; ?>">
                <?php echo get_news_posts('', 15); ?>
            </div>
        </div>

        <div class="col-md-8 col-sm-12 first-section">
            <?php
            if ($live != '') {
              echo $live;
            }
            ?>
            <div  class="slider-wrapper ">
                <div id="myCarousel" class="carousel carousel-fade slide animation-element" data-ride="carousel" >
                    <?php echo get_home_slider(SLIDER, 3) ?>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-menu-left"></span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-menu-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-bottom-banner col-xs-12">
        <div class="row">
            <?php dynamic_sidebar('slider-bottom-banner'); ?>
        </div>
    </div>
</div>

<div class="container stories hidden-xs">
    <?php echo get_about_important(IMPORTANT, 3); ?>
</div>

<div class="container hidden-sm hidden-md hidden-lg">
    <?php echo get_about_important_mobaile(IMPORTANT, 3, 'xs-item-slider-size'); ?>
</div>

<div class="container-lightstrip container-fluid">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="col-sm-3 col-xs-12">
                    <?php echo get_item_post(IRADARCAYIN, 1, ''); ?>
                </div>

                <div class="col-sm-3 col-xs-12">
                    <?php echo get_item_post(FACTUAL, 1, ''); ?>
                </div>

                <div class="col-sm-3 col-xs-12">
                    <?php echo get_item_post(INTERVIEW, 1, ''); ?>
                </div>

                <div class="col-sm-3 col-xs-12">
                    <?php echo get_item_post(COMMENTARY, 1, ''); ?>
                </div>

            </div>

            <!--            <div class="item-slide hidden-sm hidden-md hidden-lg">
            
                            <div id="itemSlide" class="carousel slide" data-interval="4000" data-ride="carousel">
                                 Wrapper for slides 
                                <div class="carousel-inner" role="listbox">
            
                                    <div class="item slid-wrapper active"><?php //echo get_item_post(IRADARCAYIN, 1, 'xs-item-slider-size');              ?></div>
                                    <div class="item slid-wrapper"><?php //echo get_item_post(FACTUAL, 1, 'xs-item-slider-size');              ?></div>
                                    <div class="item slid-wrapper"><?php //echo get_item_post(INTERVIEW, 1, 'xs-item-slider-size');              ?></div>
                                    <div class="item slid-wrapper"><?php //echo get_item_post(COMMENTARY, 1, 'xs-item-slider-size');              ?></div>
            
                                    <a class="left carousel-control" href="#itemSlide" data-slide="prev">
                                        <span class="glyphicon glyphicon-menu-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#itemSlide" data-slide="next">
                                        <span class="glyphicon glyphicon-menu-right"></span>
                                    </a>
                                </div>
                            </div>
            
                        </div>-->
        </div>
    </div>
</div>
<div class="container most-read">
    <div class="row">
        <div class="col-md-4">
            <?php //echo get_most_read_post(POLITICS, 5)  ?>
            <div class="animation-element most-read-list " >
                <?php dynamic_sidebar('most_read_list'); ?>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?php echo get_item_post(DEMAND, 1, ''); ?>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?php echo get_item_post(RIGHTHOLDER, 1, ''); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
