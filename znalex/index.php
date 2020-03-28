<?php
get_header();
?>

	  
<?= get_about_as_page(ABOUTAS) ?>
	
	<section>
        <div class="container">
	        <div class="row">
	          <div class="col-lg-12 text-center">
	            <h3 class="section-subheading our-team"><?php _e('Our Team', 'znalex'); ?></h3>
			   </div>
	        </div>
			<div class="row text-center solution-content-2">
				<?= get_team_list(); ?>
			</div>
	    </div>
	</section>
	<section class="pt-0 pb-0 zamereni-part">
		<div class="container">
			<h3 class="section-subheading line-under"><?php _e('Expertise', 'znalex'); ?></h3>
			<div class="row pt-0 pb-0 last-row">
				<?=get_expertise_list(); ?>
			</div>
		</div>
	</section>
	<section>
	  <div class="container">
		<div class="row">
		  <div class="col-lg-12 text-center">
			<h3 class="section-subheading our-team"><?php _e('Latest News', 'znalex'); ?></h3>
		   </div>
		</div>
		<div class="row text-center inform-part">
			<?=get_latest_news_list(LATESTNEWS, 3); ?>		
		</div>
		</div>
	</section>
    <section id="contact">
      <div class="container">
        <div class="row contact-us-part">
          <div class="col-sm-6 col-md-6 col-lg-4 contact-details">
            <h3 class="section-subheading line-under-last contact-text">Kontakt</h3>
			<ul class="address-section">
				<li>
					<p>Adresa</p>
					<p>Nádražní 344/23 150 00 Praha 5</p>
				</li>
				<li>
					<p>Email:</p>
					<p>carbol@znalex.cz</p>
				</li>
				<li>
					<p>Telefon:</p>
					<p>+420 604 783 823</p>
				</li>
			</ul>
			
          </div>
		<div class="col-sm-6 col-md-6 col-lg-8 map-section">
			<div id="map"></div>
		</div>	  
		<div class="row contact-btn">
			<!-- <div class="col-sm-6 col-md-6 col-lg-4 btn-part"><a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services"><?php _e('Contact us', 'znalex'); ?></a></div>
			<div class="col-sm-6 col-md-6 col-lg-8 design-rectangle"><span></span></div> -->
			<div class="col-sm-12 btn-part"><a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services"><?php _e('Contact us', 'znalex'); ?></a></div>
		</div>
        </div>       
      </div>
    </section>	

<?php get_footer();