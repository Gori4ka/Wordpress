<?php
get_header();
?>
<div class="main-container site-content clearfix marginTop">
  <div class="home-top-section col-xs-12">
    <?php get_home_top_section_posts(FEATURED, 4); ?>
  </div>
  <div class="home-content-section col-xs-12">
    <div class="row">
      <div class="home-post-section col-sm-9">
        <div class="row">
          <?php echo get_home_posts_list(12) ?>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="home-right-sidebar">
          <?php dynamic_sidebar('right-sidebar'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
