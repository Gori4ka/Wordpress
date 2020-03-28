<?php
/**
 * The main template file
 *
 * @package bootstrap-basic
 */

get_header();

?>
<div class="home-page container site-background">
	<div class="home-image row">
		<?php get_main_slider(3) ?>
	</div>

	<div class="category_block row">
		<div class="news col-sm-9">
			<?php echo get_news_posts (NEWS, 4); ?>
		</div>
		<div class="col-sm-3 calendar">
			<div class="title">
          <?php _e('Events calendar', 'bootstrap-basic'); ?>
      </div>
			<div id="eventCalendar" ></div>
		</div>
	</div>
	<div class="row">
		<?php echo get_video_block(VIDEO, 7) ?>
	</div>

	<div class="row">
		<div class="photo-section col-sm-7">
			<?php echo get_photo_block(PHOTOS, 6); ?>
		</div>
		<div class="col-sm-5 events-section">
			<?php echo get_categoty_events (EVENTS, 2); ?>
		</div>
	</div>

</div>
			<script>
        var slider = new MasterSlider();

        // adds Arrows navigation control to the slider.
        slider.control('arrows');
        slider.control('bullets');

        slider.setup('masterslider', {
            width: 1190, // slider standard width
            height: 365, // slider standard height
            loop: true,
            preload: 0,
            speed: 25,
            autoplay: true
        });
        var slide = new MasterSlider();
        // adds Arrows navigation control to the slider.


        slide.setup('iravabanSlide', {
            width: 555, // slider standard width
            height: 300, // slider standard height
            layout: 'fillwidth',
            fillMode: 'center',
            heightLimit: true,
            loop: true,
            preload: 0,
            speed: 20,
            autoplay: true
        });
    </script>

<?php get_footer(); ?>
