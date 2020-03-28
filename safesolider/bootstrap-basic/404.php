<?php get_header();
	$lang = ICL_LANGUAGE_CODE;
	?>
	<div class="content">
	    <div class="container">
	        <?php featured($lang); ?>
	        <div class="center-content clearfix incident-page">
	            <?php incident_block(); ?>
	            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 incident">
								<h1 class="page-title"><?php _e('Oops! That page cant be found.', 'safesoldiers'); ?></h1>
	            </div>
	            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
	              <?php get_frontend_database_block($lang); ?>
	            </div>
	        </div>
	    </div>
			<?php searchresults(); ?>
	</div>
<?php get_footer(); ?>
