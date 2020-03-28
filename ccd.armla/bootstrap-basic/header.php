<?php
/**
 * The theme header
 *
 * @package bootstrap-basic
 */
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
        <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url') ?>/img/favicon.ico" type="image/x-icon">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <!--wordpress head-->
        <?php wp_head(); ?>
    </head>
    <?php global $blog_id; ?>
    <body <?php body_class(); ?> id="blog_<?php echo $blog_id; ?>">
        <!--[if lt IE 8]>
                <p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
        <![endif]-->

        <div class="container site-background">
            <div class="header clearfix">
                <div class="header-top row">
                    <div class="col-md-7 col-sm-9 col-xs-12">
                        <div class="logo1-block col-md-3 col-sm-4 col-xs-6">
                            <a href="<?php echo get_home_url(); ?>">
                                <img class="logo-img" src="<?php echo get_bloginfo('template_url') ?>/img/logo1.png">
                            </a>
                        </div>
                        <div class="header-top-text ">
                            <p>
                                <?php _e('Commitment to Constructive Dialogue', 'bootstrap-basic') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-3 col-xs-12">
                        <div class="logo2-block col-md-7 hidden-sm hidden-xs">
                            <a href="<?php echo get_home_url(); ?>">
                                <img class="logo-img" src="<?php echo get_bloginfo('template_url') ?>/img/logo3.png">
                            </a>
                        </div>
                        <div class="lenguge-block ">
                            <div class="header-phone">
                                <span class="glyphicon glyphicon-phone-alt"></span> <span class="phone-number">0 8000 1110<span>
                                        </div>
                                        <p class="support_us">
                                            <a href="<?php echo get_permalink(SUPPORT_US) ?>" class="header-donate clearfix">
                                                <?php echo get_the_title(SUPPORT_US); ?>
                                            </a>
                                        </p>
                                        <div class="lenguge">
                                            <?php echo getTranslateLinks(); ?>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="main-navigation row">
                                            <nav class="navbar navbar-default" role="navigation">
                                                <div class="navbar-header">
                                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary-collapse">
                                                        <span class="sr-only"><?php _e('Toggle navigation', 'bootstrap-basic'); ?></span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                    </button>
                                                </div>

                                                <div class="collapse navbar-collapse navbar-primary-collapse">
                                                    <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav main-menu', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>

                                                </div><!--.navbar-collapse-->
                                            </nav>

                                        </div><!--.main-navigation-->
                                        </div>
                                        </div>
