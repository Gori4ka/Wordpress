<?php /* Template Name: Donate Template */ ?>
<?php
/**
 * Template for displaying pages
 *
 * @package bootstrap-basic
 */
get_header();

/**
 * determine main column size from actived sidebar
 */
?>
<?php
$lang = ICL_LANGUAGE_CODE;
get_header();
?>
<div class="content">
    <div class="container">
        <?php featured($lang); ?>
        <div class="center-content clearfix incident-page">
            <?php incident_block(); ?>
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
                    <div class = "text">
                        <?php the_content(); ?>
                    </div>
                </article>

            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <?php get_frontend_database_block($lang); ?>
            </div>
        </div>
    </div>
    <?php searchresults(); ?>
</div>
<?php get_footer(); ?>
