<?php
get_header();

$isGallerey = false;
// if ((is_single() && in_category(PHOTOS)) || post_is_in_descendant_category(PHOTOS)) {
//     $isGallerey = true;
// }
?>

<div id="content" class="container site-background clearfix single-post">
    <div class="block-title row clearfix"></div>
    <div class="row">

        <div id="main" class="col-md-12  clearfix" role="main">
            <div class="clearfix"></div>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="post-header">
                        <h1><?php the_title(); ?></h1>
                        <span class="post-meta">
                            <?php echo the_time('d F Y H:i'); ?>

                        </span>
                    </div>
                  <div class="post-content">
                  <?php
                    $video = '';
                    $class = '';
                    $thumbnail = '';
                    $GalleryId = get_post_meta(get_the_ID(), 'GalleryId', true);
                    $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);

                        if ($video_id) {
                            $video = '<iframe width="550" height="310" src="https://www.youtube.com/embed/' . $video_id . '?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
                            $thumbnail = '<iframe width="550" height="310" src="https://www.youtube.com/embed/' . $video_id . '?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
                            $class = 'video-container';
                        } else {
                            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');
                        }

                  if(!$GalleryId){
					  $catIds = get_the_category(get_the_ID());
                      if($catIds && $catIds[0]->cat_ID == VIDEO){ ?>
                          <div class="video-container col-sm-6">
                            <?php echo '<iframe width="550" height="310" src="https://www.youtube.com/embed/' . $video_id . '?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>'; ?>
                          </div>
                          <div class="text-container">
                            <?php the_content(); ?>
                          </div>
                      <?php }
                      else { ?>
                          <div class="image-container col-md-6 col-sm-12 <?php echo $class; ?>">
                            <?php echo $thumbnail; ?>
                          </div>
                          <div class="text-container clearfix">
                            <?php the_content(); ?>
                          </div>
                      <?php }
                      }else { ?>
                        <?php if($video_id){?>
                          <div class="video-container col-md-6 col-sm-12">
                            <?php echo $video; ?>
                          </div>
                        <?php } ?>
                        <div class="text-container clearfix">
                          <?php the_content(); ?>
                        </div>
                      <?php } ?>
                  </div>

                    <section class="entry-content photostory clearfix">
                        <?php if ($GalleryId) { ?>
                            <div class="slider" id="slider" style="max-width: 1070px;position: relative;margin: 20px auto 0 auto;">
                                <div class="ms-vertical-template">
                                    <!-- masterslider -->
                                    <!-- Insert to your webpage where you want to display the slider -->
                                    <div class="master-slider ms-skin-default" id="masterslider">
                                        <?php
                                        global $wpdb;
                                        if ($GalleryId) {
                                            //PHOTOSTORY
                                            $querystr = "SELECT * FROM wp_ngg_gallery WHERE gid='$GalleryId'";
                                            $gal = $wpdb->get_results($querystr, OBJECT);
                                            $galpath = $gal[0]->path;
                                            $photossql = "SELECT * FROM wp_ngg_pictures WHERE galleryid='$GalleryId' ORDER BY sortorder";
                                            $photos = $wpdb->get_results($photossql, OBJECT);
                                            $prew_image = $wpdb->get_results("SELECT ng.path, np.filename FROM wp_ngg_pictures np, wp_ngg_gallery ng WHERE np.galleryid=ng.gid AND np.galleryid=" . $GalleryId . " AND np.pid=ng.previewpic");
                                            $i = 0;
                                            $SlideShowHtml = '';
                                            $PhotoStream = '';
                                            $full_lightbox = '';
                                            foreach ($photos as $photo) {
                                                $SlideShowHtml .= '<div class="ms-slide"><img src="../js/masterslider/blank.gif" data-src="/' . $galpath . '/' . $photo->filename . '" >';
                                                $SlideShowHtml .= ' <img class="ms-thumb" src="/' . $galpath . '/thumbs/thumbs_' . $photo->filename . '">';
                                                $SlideShowHtml .= '<a href="/' . $galpath . '/' . $photo->filename . '" class="ms-lightbox" rel="prettyPhoto[gallery1]" ></a></div>';

                                                $i++;
                                            }
                                            $SlideShow = str_replace("//", "/", $SlideShowHtml);
                                            echo $SlideShow;
                                        };
                                        ?>

                                    </div>
                                </div>
                            </div> <!-- slider -->

                        <?php } ?>
                    </section> <!-- end article section -->

                <?php endwhile; ?>
            <?php endif; ?>
        </div> <!-- end #main -->
    </div> <!-- end #content -->
</div>

<?php
get_footer();
?>

<script>
var slider = new MasterSlider();
      slider.control('arrows');
      slider.control('lightbox');
      slider.control('thumblist', {autohide: false, dir: 'v', align: 'bottom', width: 190, height: 117, margin: 10, space: 10, hideUnder: 400});

      slider.setup('masterslider', {
          width: 850,
          height: 570,
          space: 0,
          loop: true,
          view: 'mask',
          autoplay: true,
          wheel: true,
          fillMode: 'fit'
      });
</script>
