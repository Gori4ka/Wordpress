<?php
/**
 * Template Name: personnel
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>

<div id="content" class="container site-background personnel clearfix ">
    <div class="">
        <div class="block-title"><?php the_title(); ?></div>
        <div id="main" class="col-md-12 clearfix" role="main">

            <?php
            $args = array(
                'posts_per_page' => 50,
                'offset' => 0,
                'orderby' => 'date',
                'order' => 'ASC',
                'post_type' => 'personnel',
                'post_status' => 'publish'
            );
            $posts_array = get_posts($args);
            if ($posts_array) {
                foreach ($posts_array as $post_item) {
                    $position = get_post_meta($post_item->ID, 'user_position', true);
                    ?>
                    <div class="lawyers clearfix">
                        <div class="lawyer-img">
                            <p>
                                <?php echo get_the_post_thumbnail($post_item->ID, 'medium'); ?>
                            </p>
                            <div class="lawyer-img-text"><span class="name"><?php echo get_the_title($post_item->ID); ?></span><span class="lawyer-post"><?php echo $position; ?></span></div>
                        </div>
                        <div class="lawyer-info">
                            <?php
                            $content_post = get_post($post_item->ID);
                            $content = $content_post->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]&gt;', $content);
                            echo $content;
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </div> <!-- end #main -->

    </div>
</div> <!-- end #content -->

<?php get_footer(); ?>
