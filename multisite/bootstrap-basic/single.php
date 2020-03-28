<?php
get_header();
?> 
<div class="container">
    <div class="site-content clearfix">

        <?php
        if (in_category(PHOTOS)) {
            include('single-photostory.php');
        } else {
            ?>
            <div class="col-md-8">
                <?php
                while (have_posts()) {
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>

                            <div class="entry-meta">
                                <?php the_date('Y F, d'); ?> 
                            </div>
                        </header>


                        <?php

                        $GalId = get_peyotto_gallery_id(get_the_ID());

                        if ($GalId) {
                            $querystr = "SELECT * FROM wp_ngg_gallery WHERE gid='$GalId'";
                            $gal = $wpdb->get_results($querystr, OBJECT);
                            $galpath = $gal[0]->path;
                            $photossql = "SELECT * FROM wp_ngg_pictures WHERE galleryid='$GalId' ORDER BY sortorder";
                            $photos = $wpdb->get_results($photossql, OBJECT);
                            $SlideShowHtml = '';
                            foreach ($photos as $photo) {
                                $SlideShowHtml .= '<li><a class="" href="#" ><img data-large="' . $galpath . '/' . $photo->filename . '" src="' . $galpath . '/thumbs/thumbs_' . $photo->filename . '" ></a></li>'; //thumbs/thumbs_
                            }
                            ?>

                            <div class="clearfix">
                                <div id="rg-gallery" class="rg-gallery">
                                    <div class="rg-thumbs">
                                        <!-- Elastislide Carousel Thumbnail Viewer -->
                                        <div class="es-carousel-wrapper">
                                            <div class="es-nav">
                                                <span class="es-nav-prev">Previous</span>
                                                <span class="es-nav-next">Next</span>
                                            </div>
                                            <div class="es-carousel">
                                                <ul>
                                                    <?php echo $SlideShowHtml; ?>                                          
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End Elastislide Carousel Thumbnail Viewer -->
                                    </div><!-- rg-thumbs -->
                                </div><!-- rg-gallery -->
                            </div>
                            <?php
                        }
                        if (!$GalId) {
                            ?>
                            <div class = "entry-thumbnail">
                                <?php echo get_the_peyotto_thumbnail(get_the_ID(), 'full') ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class = "entry-content">
                            <?php the_content();
                            ?> 
                            <div class="clearfix"></div>
                        </div><!-- .entry-content -->
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                            $video_ids = get_post_meta(get_the_ID(), 'embede_code_' . $i, false);
                            if ($video_ids) {
                                foreach ($video_ids as $video_id) {
                                    ?>
                                    <div class="video-player-single"> 
                                        <div class="mrcontainer">
                                            <?php echo $video_id; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </article><!-- #post -->
                    <?php
                } //endwhile;
                ?> 

            </div>

            <div class="col-md-4">
                <?php get_video_block(VIDEOS, 4); ?>
            </div>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?> 
