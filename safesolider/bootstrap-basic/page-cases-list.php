<?php
/*
  Template Name: cases-list
 */
?>
<?php
$lang = ICL_LANGUAGE_CODE;
$limit = 10;

get_header();
?>
<div class="content">
    <div class="container">
        <?php featured($lang); ?>
        <div class="center-content clearfix incident-page">
            <?php incident_block(); ?>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 solider_stories">
                <div class="stories row">
                    <div class="item_stories">
                        <?php
                        $cases_list = page_cases_list($lang, $limit);
                        if (!$cases_list) {
                            ?>
                            <div class="nothing-found"><?php _e('There are no cases of such data.', 'safesoldiers') ?></div>
                            <?php
                        }
                        foreach ($cases_list[0] as $cases) {
                            ?>
                            <div class="col-xs-12 col-sm-6">
                                <div class="item">
                                    <div class="item_name">
                                        <a href="<?php echo get_page_cases_url($cases->id); ?>">
                                            <?php echo $cases->frst_name . ' ' . $cases->last_name; ?></a>
                                    </div>
                                    <div class="item_image">
                                        <a href="<?php echo get_page_cases_url($cases->id); ?>">
                                            <img src="<?php echo Helper::get_media_by_cases_id($cases->id); ?>"/>
                                        </a>
                                    </div>
                                    <div class="item_description">
                                        <?php echo $cases->content; ?>
                                    </div>
                                    <div class="read_more">
                                        <a href="<?php echo get_page_cases_url($cases->id); ?>"><?php _e('Read more', 'safesoldiers') ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="navigation">
                            <?php
                            Helper::cases_paginator($cases_list[1], 4, $limit, $_SERVER[REQUEST_URI]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <?php get_frontend_database_block($lang); ?>
            </div>
        </div>
    </div>
    <?php searchresults(); ?>
</div>
<?php get_footer(); ?>
