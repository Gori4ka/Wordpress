<?php
/**
 * Template for displaying single post (read full post page).
 * 
 */

get_header();

?> 
	<div class="content-area container" id="main-column">
		<main id="main" class="site-main" role="main">
			<?php 
			while (have_posts()) {
				the_post(); ?>

				<div class="title-holder">
                    <h2 class="title col-xs-12"><?php the_title(); ?></h2>
                </div>

                <div class="post-content">
                  <?php
                  if(has_post_thumbnail(get_the_ID())){
		                $thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');
		            }else{
		                $thumbnail = '<img class="mx-auto team-member" src="'.get_bloginfo('template_url').'/img/images/u.png" alt="">';
		            } ?>

		            <div class="col-sm-4 col-xs-12">
		            	<div class="post-image"><?= $thumbnail ?></div>
		            </div>
	                <div class="col-sm-8 col-xs-12">
	                	<div class = "text">
		                    <?php the_content(); ?>
		                </div>
	                </div>
                </div>

<?php
			} //endwhile;
			?> 
		</main>
	</div>
<?php get_footer(); ?> 
