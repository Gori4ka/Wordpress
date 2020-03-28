<?php
/*
  Template Name: Add incident
 */
?>
<?php
$lang = ICL_LANGUAGE_CODE;
  get_header(); ?>
<div class="content">
    <div class="container">
        <?php featured($lang); ?>
        <div class="center-content clearfix incident-page">
            <?php incident_block(); ?>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 incident">
                <?php Helper::get_frontend_add_incident_forem(1, $lang); ?>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
              <?php get_frontend_database_block($lang); ?>
            </div>
        </div>
    </div>
    <?php searchresults(); ?>
</div>
<?php get_footer(); ?>
