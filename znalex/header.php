<?php
/**
 * The theme header
 * 
 */

$lang = ICL_LANGUAGE_CODE;

?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width">

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

			  <!-- Typekit Fonts -->
	  <link rel="stylesheet" href="https://use.typekit.net/xel8qqo.css">
	  
	  <!-- Google Fonts -->
	  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
		
		<!--wordpress head-->
		<?php wp_head(); ?>
	</head>

<?php 
if(ICL_LANGUAGE_CODE == 'en') { ?>
	<style type="text/css">
		.languages-list li.wpml-ls-item-en a{
			text-decoration: underline;
			color:#A6145B;
		}
	</style>

<?php
}elseif(ICL_LANGUAGE_CODE == 'cs') { ?>
	<style type="text/css">
		.languages-list li.wpml-ls-item-cs a{
			text-decoration: underline;
			color:#A6145B;
		}
	</style>
<?php	
}
?>

	<body id="page-top" <?php body_class(); ?>>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php echo icl_get_home_url(); ?>"><img alt="Znalex logo" src="<?php echo get_bloginfo('template_url') ?>/img/images/logo.png" width="156" height="auto"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          	<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_id' => '1', 'items_wrap'=>'<ul class="navbar-nav text-uppercase ml-auto general-menu">%3$s</ul>')); ?>
			<div class="nav-item">
				<ul class="languages-list">
					<?php do_action('wpml_add_language_selector'); ?>
				</ul>
			</div>
        </div>

      </div>
    </nav>

    <header class="masthead">
      <div class="header-container" id="services">
        <div class="intro-text container">
         <h1><?php _e('Renowned Company of Legal Experts', "znalex") ?></h1> 
		 <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services"><?php _e('More about us', 'znalex') ?></a>
        </div>
      </div>
    </header>
