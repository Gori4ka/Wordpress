<?php
/**
 * Template for displaying single post (read full post page).
 * 
 */

get_header();

?> 
	<div class="content-area single-page" id="main-column">
		<main id="main" class="site-main" role="main">
			<?php 
			while (have_posts()) {
				the_post(); ?>

				<div class="title-holder">
                    <h2 class="title"><?php the_title(); ?></h2>
                </div>

                <div class="post-content">
		            <div class="image">
		            	<div class="post-image"><?= get_the_post_thumbnail(get_the_ID(), 'full') ?></div>
		            </div>
	                <div class="content">
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
