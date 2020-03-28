<?php
get_header();
?>
<div class="main-page">
    <div class="poster">
        <div class="poster_image">
            <img src="/image/poster.png" alt="Trump Banner">
        </div>
    </div>
    <div class="main-blocks clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="tsarukyan-lliance">
                        <a href="<?php echo get_category_link(lliance) ?>" style="display: block;width: 100%;">
                            <img src="/image/Logo750x200.png"  style="max-width:100%;"/>
                        </a>
                    </div>
                    <div class="clearfix">
                        <?php get_category_block(PRESS, 2, 'press-block'); ?>
                    </div>
                    <div class="clearfix">
                        <?php get_category_block(HAOK, 3, 'foundation-block'); ?>
                    </div>
                    <div class="clearfix">
                        <?php get_category_block(FOUNDATION, 2, 'press-block'); ?>
                    </div>
                    <div class="clearfix">
                        <?php get_category_block(MULTIGROUP, 3, 'foundation-block'); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php get_video_block(VIDEOS, 4); ?>
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FGagikTsarukyan%2F&tabs&width=340&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1547262945583651" width="340" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?> 