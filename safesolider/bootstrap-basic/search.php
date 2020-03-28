<?php
/**
 * The template for displaying search results.
 *
 * @package bootstrap-basic
 */

get_header();
 	$lang = ICL_LANGUAGE_CODE;
 	?>
 	<div class="content">
 	    <div class="container">
 	        <?php featured($lang); ?>
 	        <div class="center-content clearfix incident-page">
 	            <?php incident_block(); ?>
 	            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 incident">
                <div id="center">
                  <h1><?php _e('Search results', 'safesoldiers') ?>:<span> <?php echo get_search_query(); ?></span></h1>
                  <?php
                  if (have_posts()) :
                      while (have_posts()) : the_post();
                          ?>
                          <div id="posts">
                              <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                              <div id="post_info">
                                  <div><?php _e('Date Added', 'safesoldiers') ?>: <?php the_date() ?></div>
                                  <div id="clear"></div>
                              </div>
                              <p><?php the_excerpt() ?></p>
                              <span><?php _e('Category', 'safesoldiers') ?>: <?php the_category(', ') ?></span>
                          </div>
                      <?php endwhile; ?>
                  <?php
                  else :?>
                      <h4><?php _e("Sorry for your result no results", "safesoldiers"); ?></h4>
                      <?php
                  endif;
                  ?>
                  <?php if(function_exists('wp_paginate')) {
                        wp_paginate();
                    }
                    else {
                        twentythirteen_paging_nav();
                    }
                    ?>
                  </div>
 	            </div>
 	            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
 	              <?php get_frontend_database_block($lang); ?>
 	            </div>
 	        </div>
 	    </div>
 			<?php searchresults(); ?>
 	</div>
 <?php get_footer(); ?>
