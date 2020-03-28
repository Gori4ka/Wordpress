<?php
get_header();
?>
<div class="content">
    <div class="container news-more">

        <div class="clearfix"></div>
        <div class="center-content">
            <div class="col-xs-12 col-sm-4 col-lg-3 companies_menu">
            <div class="holder">
              <h3><?php _e('Companies', 'safesoldiers') ?></h3>
              <?php wp_nav_menu(array('theme_location' => 'companies', 'container' => false, 'menu_class' => 'companies_menu_cont', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>
            </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-lg-6 main-article">
                <article class="post">
                    <?php
                    while (have_posts()) {
                        the_post();
                    }
                    ?>
                    <div class="title-holder">
                        <h2 class="title"><?php the_title(); ?></h2>
                    </div>
                    <div class = "text">
                        <?php the_content(); ?>
                    </div>
                </article>

            </div>
            <div class = "col-xs-12 col-sm-4 col-lg-3 activity">
                <?php get_latest_video(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();
?>
