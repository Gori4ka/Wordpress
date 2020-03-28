<?php
/**
 * The main template file
 *
 * @package bootstrap-basic
 */
$lang = ICL_LANGUAGE_CODE;
get_header();
?>
<div class="content">
    <div class="container">
        <?php featured($lang); ?>
        <div class="center-content clearfix">
            <?php incident_block(); ?>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 infograph-container">
                <?php the_widget('cases_infograph'); ?>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <?php get_frontend_database_block($lang); ?>
            </div>
        </div>
    </div>
    <?php searchresults(); ?>
</div>

<?php get_footer(); ?>
