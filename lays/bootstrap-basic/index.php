<?php
get_header();
?>
<div class="content_height clearfix">
    <div class="content-area clearfix" id="main-column">
        <div class="col-sm-4 block-3">
            <div class="content-block-3 zoom-block">
                <img class="home-img-4" src="<?php echo get_bloginfo('template_url') ?>/img/bloc-4.jpg">
            </div>
        </div>
        <div class="col-sm-4 block-4">
            <div class="content-block-4 zoom-block">
                <img class="home-img-3" src="<?php echo get_bloginfo('template_url') ?>/img/lays_4.jpg">

            </div>
        </div>
        <div class="col-sm-4 block-5 ">
            <div class="content-block-5 zoom-block">
                <img class="home-img-5" src="<?php echo get_bloginfo('template_url') ?>/img/bloc-5.jpg">
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2 col-sm-12 ">
            <div class="main-video-play">
                <div class="video-container">
                    <iframe width="853" height="480" src="https://www.youtube.com/embed/iW7ioYjjAZo" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>          
    </div>
</div>
<?php
if (is_user_logged_in()) {
    get_competition_file_upload_modal();
}
?>

<?php get_footer(); ?>
