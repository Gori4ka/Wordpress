<?php
/**
 * Displaying archive page (category, tag, archives post, author's post)
 *
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */


 ?>

 <div class="container category-page">
   <div class="row">
       <div class="category-block archive-page  col-sm-8 col-xs-12">
         <div class="category-page-title">
             <p><?php _e('Արխիվ', 'bootstrap-basic'); ?>
               <span class="archive-calendar">
                 <span class="calendar-text">
                   <?php _e('Օրացույց', 'bootstrap-basic'); ?>
                 </span>
                 <span class="calendar-icon">
                   <i class="fa fa-calendar" aria-hidden="true"></i>
                 </span>
               </span>

           </p>
           <div class="calendar col-sm-offset-8 col-sm-4 "><?php get_calendar(); ?> </div>
         </div>

         <div class="row">
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
     </div>

     <div class="archive-right col-sm-4 col-xs-12 ">
      <?php echo get_live_video(LIVEVIDEO, 1); ?>
       <div class="news">
         <?php echo get_news_posts('', 15); ?>
       </div>
     </div>

  </div>
</div>
 <?php get_footer(); ?>
