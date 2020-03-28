<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 */
global $blog_id;
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
        <meta name="author" content="Peyotto Technologies"/>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <link rel="manifest" href="/favicons/manifest.json">
         <meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
     
        <!--wordpress head-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 8]>
                <p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
        <![endif]-->

        <div class="header">
            <div class="top-menu-wrapper">
                <div class="container">
                    <div class="social-top-links">
                        <a href="#" style="display: none!important" class="social-block-item twitter" target="_blank"></a>
                        <a href="https://www.facebook.com/GagikTsarukyan/" style="display: none!important" class="social-block-item facebook" target="_blank"></a>
                        <a href="#" style="display: none!important" class="social-block-item youtube" target="_blank"></a>
                    </div>
                    
                    <div class="language"><?php echo getTranslateLinks(); ?></div>
                    <?php wp_nav_menu(array('theme_location' => 'top', 'container' => false, 'menu_class' => 'top-menu')); ?> 
                    

                </div>

            </div>
        </div>

        <div class="main-menu-wrapper">
            <div class="container">
                <nav class="navbar navbar-default ">


                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img class="logo-img" src="<?php echo get_bloginfo('template_url') ?>/img/logo_<?php echo $blog_id ?>.png?221"></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav main-menu', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>

                    </div>

                </nav>
            </div>
        </div>
