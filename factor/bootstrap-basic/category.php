<?php
get_header();
$category = get_category( get_query_var( 'cat' ) );
  if ($category->category_parent == AUTHORPROGRAMS) {
    include 'category-author-programs.php';
}else{

?>

<div class="container category-page ">
  <div class="row">
    <div class="category-block archive-page col-sm-8 col-xs-12">
      <div class="category-page-title col-xs-12">
          <p><?php echo single_cat_title() ?></p>
      </div>
      <?php
      if (have_posts()) : while (have_posts()) : the_post();

          $icon = '<div class="text-icon"></div>';
          $video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
          $thumbnail = get_the_post_thumbnail(get_the_ID());

        if ($video_id) {
          $icon = '<div class="play-icon"></div>';
        }

        $thumbnail .= $icon;
          ?>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="item clearfix right">
                <a href="<?php echo get_permalink(get_the_ID()) ?>">
                  <div class="item-image  animation-element">
                    <?php echo $thumbnail; ?>
                  </div>
                  <div class="text-content">
                    <span class="item-date"><?php echo get_the_date('d F Y | H:i', get_the_ID()); ?></span>
                    <span class="item-title"><?php echo get_the_title(get_the_ID()); ?></span>
                  </div>
                </a>
            </div>
          </div>

          <?php
          endwhile;
      endif;?>
        <?php wp_pagenavi(); ?>

      </div>
      
      <div class="archive-right col-sm-4 col-xs-12 ">
       <?php echo get_live_video(LIVEVIDEO, 1); ?>
        <div class="news">
          <?php echo get_news_posts('', 15); ?>
        </div>
      </div>

  </div>
</div>
<?php } ?>
<?php get_footer(); ?>
