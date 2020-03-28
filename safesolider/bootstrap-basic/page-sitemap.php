<?php /* Template Name: SiteMap Template */ ?>
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
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 incident">
                <h3 class="page-title"><?php the_title(); ?></h3>
                <ul>
                    <?php
                    $args = array(
                        'type' => 'post',
                        'parent' => 0,
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => 0,
                        'hierarchical' => 1,
                        'exclude' => ExcludeCat,
                        'include' => '',
                        'number' => '',
                        'taxonomy' => 'category',
                        'pad_counts' => false
                    );
                    $categories = get_categories($args);
                    foreach ($categories as $cat) {
                        echo '<li><a href="' . get_category_link($cat->term_id) . '" >' . $cat->name . '</a>';
                        $subarg = array(
                            'type' => 'post',
                            'parent' => $cat->term_id,
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => 0,
                            'hierarchical' => 1,
                            'exclude' => '23,1,5',
                            'include' => '',
                            'number' => '',
                            'taxonomy' => 'category',
                            'pad_counts' => false
                        );
                        $subcats = get_categories($subarg);
                        if ($subcats) {
                            echo '<ul>';
                            foreach ($subcats as $scat) {

                                echo '<li><a href="' . get_category_link($scat->term_id) . '" >' . $scat->name . '</a></li>';
                            }
                            echo '</ul>';
                        }

                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                <?php get_frontend_database_block($lang); ?>
            </div>
        </div>
    </div>
    <?php searchresults(); ?>
</div>
<?php get_footer(); ?>
