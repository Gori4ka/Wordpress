<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
?>
<?php
$footerclass = '';
 if(is_home()){
	$footerclass = 'main-container';
}else {
	$footerclass = 'container';
} ?>
			<div id="site_footer">
			    <div class="site-footer container-fluid">
						<div class="<?php echo $footerclass; ?>">
							<div class="footer-section clearfix">
								<div class="col-xs-12 col-sm-8">
									<div class="subscribe-block">
										<div class="clearfix">
											<?php dynamic_sidebar('subscribe-sidebar'); ?>
										</div>
									</div>
								</div>
                <div class="col-xs-12 col-sm-4">
                  <div class="social-follow-buttons clearfix">
                      <a target="_blank" class="facebook omniture-track" href="#">
                        <div class="button-container facebook-container">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                        </div>
                      </a>
                      <a target="_blank" class="twitter omniture-track" href="#">
                        <div class="button-container twitter-container">
                          <i class="fa fa-twitter" aria-hidden="true"></i>
                        </div>
                      </a>
                      <a target="_blank" class="google omniture-track" href="#">
                        <div class="button-container google-container">
                          <i class="fa fa-google-plus" aria-hidden="true"></i>
                        </div>
                      </a>
                      <a target="_blank" class="instagram omniture-track" href="#">
                        <div class="button-container instagram-container">
                          <i class="fa fa-instagram" aria-hidden="true"></i>
                        </div>
                      </a>
                      <a target="_blank" class="rss omniture-track" href="/feed">
                        <div class="button-container rss-container">
                          <i class="fa fa-rss" aria-hidden="true"></i>
                        </div>
                      </a>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="powered_by">
                    <span>© <?php echo date("Y"); ?> Powered by <a target="_blank" href="https://peyotto.com">Peyotto Technologies</a></span>
                  </div>
                </div>
							</div>
						</div>
			    </div>
			</div>
		<!--wordpress footer-->
		<?php wp_footer(); ?>

				<script type="text/javascript">
				    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
				</script>

		<?php if (is_singular()) { ?>
			<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>

		<?php
			$ajax_nonce = wp_create_nonce( "security" );
		?>
	<script type="text/javascript" >
		(function($) {
			$(document).ready(function($) {
					var data = {
						action: 'peyotto_post_viwe',
						security: '<?php echo $ajax_nonce; ?>',
						post_id: '<?php echo get_the_ID(); ?>'
					};
					$.post( ajaxurl, data, function(response) {
						if(response.status === 'ok'){
							$('#post_views_count').html(response.count);
						}
					});
			});
		})(jQuery);
	</script>

			<?php } ?>

			<?php if (is_home()) {
					$ajax_nonce = wp_create_nonce( "home_security" );
			?>
				<script type="text/javascript" >
					(function($) {
						$(document).ready(function($) {
								var data = {
									action: 'peyotto_home_post_viwe_count',
									security: '<?php echo $ajax_nonce; ?>',
									posts_ids: $('#post_arrey_id').attr('post-arrey-id'),
									blog_id: $('#post_arrey_id').attr('blog-id')
								};
								$.post( ajaxurl, data, function(response) {
									if(response.status === 'ok'){
										//$('#post_views_count').html(response.count);
										$.each($.parseJSON(response.data), function(key, value){
												$('.cover-stat-views-'+key).html(value);
										});
									}
								});
						});
					})(jQuery);
				</script>
			<?php } ?>
	</body>
</html>
