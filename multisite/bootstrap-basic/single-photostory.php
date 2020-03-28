<div class="col-md-12">
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
            $GalId = get_post_meta(get_the_ID(), 'GalleryId', true);
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
            ?>
            <div class = "entry-content">
                <?php the_content();
                ?> 
                <div class="clearfix"></div>
            </div><!-- .entry-content -->

        </article><!-- #post -->
        <?php
    } //endwhile;
    ?> 

</div>
<div class="clearfix">
    <div class="col-md-12">
        <div class="other-posts-title"><?php _e('Other Photos', 'bootstrap-basic')?></div>
        <?php getSimiliarPhotostory(get_the_ID(), 6) ?>
    </div>
</div>
