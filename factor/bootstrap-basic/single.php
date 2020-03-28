<?php
/**
 * Template for displaying single post (read full post page).
 *
 * @package bootstrap-basic
 */
get_header();
global $__ec__ajax_post_id;
$__ec__ajax_post_id = get_the_ID();
/**
 * determine main column size from actived sidebar
 */
?>

<div class="container">
    <div class="row">
        <div class="single-block clearfix">
            <?php
            while (have_posts()) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="single-order">
                        <?php
                        $video = '';
                        $thumbnail = '';

                        $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
                        if ($video_id) {

                            $thumbnail = '<iframe width="100%" height="476" src="https://www.youtube.com/embed/' . $video_id . '?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
                            $class = 'video-container';
                        } else {

                            $thumbnail = get_the_post_thumbnail(get_the_ID());
                        }
                        ?>

                        <div class="single-post-title clearfix col-sm-9 col-xs-12 animation-element">
                            <h2>
                                <?php the_title(); ?>
                            </h2>
                        </div>

                        <div class="post-date col-sm-3 col-xs-12">
                            
                            <?php echo '<p>' . get_cat_name(get_post_custom_category(get_the_ID())) . '</p>'; ?>                            
                            <?php echo get_the_date('d.m.Y | H:i', get_the_ID()); ?>
                        </div>

                        <div class="like col-sm-9 col-xs-12">

                            <div class="fb_share"><span class='st_facebook_hcount' displayText='Facebook'></span></div>
                            <div class="fb_like like-boxe">
                                <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo get_permalink(); ?>&width=70&layout=button_count&action=like&size=small&show_faces=true&share=false&height=21&appId" width="70" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                            </div>

                            <div class="tw_like like-boxe" style="width: 88px;">
                                <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                                <script>!function (d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0], p = 'https';
                                        if (!d.getElementById(id)) {
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = 'https://platform.twitter.com/widgets.js';
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }
                                    }(document, 'script', 'twitter - wjs');</script>
                            </div>



                            <!--                            <div class="fb_share">
                                                            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo get_permalink(); ?>&layout=button_count&size=small&mobile_iframe=true&width=136&height=20&appId" width="110" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                                        </div>
                                                        <div class="tw_like like-boxe">
                                                            <a href="<?php echo get_permalink(); ?>" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                                                        </div>-->

                            <!--                            <div class="like-text">
                            <?php _e('Կիսվել', 'bootstrap-basic'); ?>
                                                        </div>
                            
                                                        <div class="single-social-icon">
                                                            <a href="#" target="_blank">
                                                                <img class="fb" src="<?php echo get_bloginfo('template_url') ?>/img/fb.png">
                                                            </a>
                                                            <a href="https://twitter.com/factorarmenia" target="_blank">
                                                                <img class="twitter" src="<?php echo get_bloginfo('template_url') ?>/img/twitter.png">
                                                            </a>
                                                            <a href="https://www.youtube.com/channel/UCkI5KAJDh9S-BQFc6QzSUiA?sub_confirmation=1" target="_blank">
                                                                <img class="YouTube" src="<?php echo get_bloginfo('template_url') ?>/img/YouTube.png">
                                                            </a>
                                                             <a href="#" target="_blank">
                                                                <img class="vk" src="<?php //echo get_bloginfo('template_url')            ?>/img/vk.png">
                                                            </a>
                                                            <a href="#" target="_blank">
                                                                <img class="instagram" src="<?php //echo get_bloginfo('template_url')            ?>/img/instagram.png">
                                                            </a> 
                                                            <a href="#" target="_blank">
                                                                <img class="odnoklassniki" src="<?php echo get_bloginfo('template_url') ?>/img/odnoklassniki.png">
                                                            </a>
                                                        </div>-->
                            <?php if (is_user_logged_in()) { ?>
                                <div class="page-view">
                                    <?php _e('Դիտումներ՝ ', 'bootstrap-basic'); ?> <span id="viewscount">*</span>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="single-post-image col-md-9 <?php echo $class; ?> animation-element">
                            <?php echo $thumbnail; ?>
                        </div>

                        <div class="archive-right col-md-3">
                            <div class="news">
                                <?php echo get_news_posts('', 15); ?>
                            </div>
                        </div>


                        <div class="col-xs-12 col-md-9 single-post-content">
                            <div class="animation-element">
                                <?php the_content(); ?>
                            </div>
                            <?php if ($video) { ?>
                                <div class="single-post-image video-container animation-element">
                                    <?php echo $video; ?>
                                </div>
                                <?php
                            }
                            $video_player = get_post_meta(get_the_ID(), 'embede_code_1', true);

                            if ($video_player) {
                                ?>
                                <div class="video-player-single video-container animation-element">
                                    <div class="mrcontainer ">
                                        <?php echo $video_player; ?>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </article>
                <?php
            } //endwhile;
            ?>
        </div>

    </div>
</div>

<?php
$GalleryId = get_post_meta($post->ID, 'GalleryId', true);

if ($GalleryId && $GalleryId != '') {

    global $wpdb;
    $querystr = "SELECT * FROM wp_ngg_gallery WHERE gid='$GalleryId'";
    $gal = $wpdb->get_results($querystr, OBJECT);
    $galpath = $gal[0]->path;
    $photossql = "SELECT * FROM wp_ngg_pictures WHERE galleryid='$GalleryId' ORDER BY sortorder";
    $photos = $wpdb->get_results($photossql, OBJECT);
    $prew_image = $wpdb->get_results("SELECT ng.path, np.filename FROM wp_ngg_pictures np, wp_ngg_gallery ng WHERE np.galleryid=ng.gid AND np.galleryid=" . $GalleryId . " AND np.pid=ng.previewpic");

    if ($photos && $photos != '') {
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="single-carousel footer-carousel">



                    <div class="container">
                        <div class="container text-center">
                            <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="4000" id="fruitscarousel">
                                <div class="carousel-title col-xs-12">
                                    <?php _e('Բոլոր լուսանկարները', 'bootstrap-basic') ?>
                                </div>
                                <div class="carousel-inner">
                                    <?php
                                    $active = 'active';
                                    foreach ($photos as $photo) {
                                        ?>
                                        <div class="item <?php echo $active ?>">
                                            <div class="col-md-3 col-sm-4 col-xs-12 ">
                                                <div class="image-height">
                                                    <img class="ms-thumb" src="<?php echo $galpath; ?>/thumbs/thumbs_<?php echo $photo->filename; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $active = '';
                                    }
                                    ?>
                                </div>
                                <a class="left carousel-control" href="#fruitscarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                <a class="right carousel-control" href="#fruitscarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }
}
?>

<div class="container">
    <div class="row">
        <?php
        $cat_id = get_the_category(get_the_ID())[0]->cat_ID;
        if (in_category(CULTURE) || $cat_id == CULTURE) {
            $cat_id = CULTURE;
        }
        ?>
        <div class="col-sm-12 hidden-xs">
            <?php
            echo get_related_posts($cat_id, 3, 'Նմանատիպ նյութեր');
            ?>
        </div>

        <div class="hidden-sm hidden-md hidden-lg">

            <?php echo get_related_posts_mobail($cat_id, 3, 'Նմանատիպ նյութեր', 'xs-item-slider-size') ?>

        </div>

    </div>
</div>

<?php get_footer(); ?>
