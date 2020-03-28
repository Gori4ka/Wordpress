<?php
/**
 * Template for displaying single post (read full post page).
 *
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
 ?>

<div class="container marginTop">
  <div class="single-page">
      <div class="social_fixed hidden-xs">
        <div style="position:fixed; top: 95px;">
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
            <div class="fb_fix">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </div>
          </a>
          <a href="https://twitter.com/home?status=<?php echo get_permalink(); ?>" target="_blank">
            <div class="tw_fix">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </div>
          </a>
          <a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank">
            <div class="gp_fix">
                <i class="fa fa-google-plus" aria-hidden="true"></i>
            </div>
          </a>
        </div>
      </div>
		<div class="col-sm-8 single-block">
				<?php
				while (have_posts()) { the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
            $cat_id = get_post_custom_category(get_the_ID());
            $class_video = '';
            $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
            $embede_code = get_post_meta(get_the_ID(), 'embede_code', true);
            if($video_id){
              $class_video = 'video-container';
              $thumbnail = '<iframe height="340" src="https://www.youtube.com/embed/'.$video_id.'?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
            }elseif($embede_code){
              $class_video = 'video-container';
              $thumbnail = $embede_code;
            }
            else{
              $thumbnail = get_the_post_thumbnail(get_the_ID());
            }?>

  					<div class="single-header clearfix">
  						<h1 class="single-post-title">
  							<?php the_title(); ?>
                <div class="meta">
                  <div class="post-views">Views: <span id="post_views_count" class="post-views-count">*</span></div>
                  <div class="the-time"><?php echo the_time('H:i Y-m-d'); ?></div>
                </div>
  						</h1>

              <div class="facebook-like">
                <div id="fb-root"></div>
                <div class="like">Like on FB:</div>
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
              </div>
              <div class="social-hidden-scroll hidden-xs">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
                  <div class="fb_fix">
                      <i class="fa fa-facebook" aria-hidden="true"></i>
                  </div>
                </a>
                <a href="https://twitter.com/home?status=<?php echo get_permalink(); ?>" target="_blank">
                  <div class="tw_fix">
                      <i class="fa fa-twitter" aria-hidden="true"></i>
                  </div>
                </a>
                <a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank">
                  <div class="gp_fix">
                      <i class="fa fa-google-plus" aria-hidden="true"></i>
                  </div>
                </a>
              </div>
        		</div>

  					<div class="single-post-image <?php echo $class_video; ?>">
  						<?php echo $thumbnail; ?>
  					</div>

  					<div class="single-post-content">
  						<?php the_content(); ?>
  					</div>

            <div class="clearfix" style="text-align: center;    margin-top: 25px;">
                <div class="facebook-shareing">
                    <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>">
                        <img class="" src="<?php echo get_bloginfo('template_url') ?>/img/fbshare.png">
                    </a>
                </div>
                <div class="twitter-shareing">
                    <a target="_blank" href="http://twitter.com/share?text=168blog.vs.am&amp;url=<?php echo get_permalink(); ?>">
                        <img class="" src="<?php echo get_bloginfo('template_url') ?>/img/twshare.png">
                    </a>
                </div>
            </div>
        </article>
			<?php
				} //endwhile;
			?>

      <div class="related-section">
        <div class="row">
          <div class="related-name col-xs-12">
            <?php _e('Related news', 'bootstrap-basic'); ?>
          </div>
          <?php
            get_related_posts('', 6); //$cat_id 
          ?>
        </div>
      </div>

		</div>

    <div class="col-sm-4">
      <?php dynamic_sidebar('right-sidebar'); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
