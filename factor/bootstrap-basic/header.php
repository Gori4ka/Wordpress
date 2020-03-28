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
        <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url') ?>/img/favicon.png" type="favicon.ico">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <meta name="viewport" content="width=device-width">
        <meta property="fb:pages" content="1906191082855202" />
        <meta name="author" content="Peyotto Technologies"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- social meta -->
        <meta property="og:site_name" content="factor.am">
        <?php
        global $post;
        $DefaultThumbnail = get_bloginfo('template_directory') . '/img/logo_logo_1.png';
        if (is_singular()) {
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
            $thumb_url = $thumb['0'];
            if (!$thumb_url) {
                $thumb_url = $DefaultThumbnail;
            }
            $conten = wp_trim_words($post->post_content, $num_words = 55, $more = null);
            if ($conten == '') {
                $conten = 'factor.am';
            }
            ?>       

            <meta itemprop="name" content="<?php wp_title(' '); ?>">
            <meta itemprop="description" content="<?php echo $conten; ?>">
            <meta property="og:image" content="<?php echo $thumb_url; ?>">
            <meta property="og:title" content="<?php echo $post->post_title; ?>">
            <meta property="og:description" content="<?php echo $conten; ?>">
            <meta property="og:type" content="website">
            <meta property="og:url" content="<?php the_permalink() ?>">
        <?php } else { ?>
            <meta property="og:url" content="<?php echo home_url(); ?>">
            <meta property="og:title" content="<?php bloginfo('name'); ?>">
            <meta property="og:description" content="factor.am">
            <meta property="og:image" content="<?php echo $DefaultThumbnail; ?>">
        <?php } ?>
        <!--wordpress head-->
        <?php wp_head(); ?>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 8]>
                <p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
        <![endif]-->




        <div class="header-background container-fluid"></div>
        <div class="header">
            <div class="header-top clearfix">
                <div class="container">
                    <div class="social-icon col-xs-12">
                        <a href="#" target="_blank">
                            <i class="fa fa-odnoklassniki" aria-hidden="true"></i>
                        </a>
                        <!-- <a href="#" target="_blank">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="#" target="_blank">
                            <i class="fa fa-vk" aria-hidden="true"></i>
                        </a> -->
                        <a href="https://twitter.com/factorarmenia" target="_blank">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="https://www.facebook.com/factor.am/" target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UCkI5KAJDh9S-BQFc6QzSUiA?sub_confirmation=1" target="_blank">
                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="logo-block">
                        <div class="row">
                            <div class="col-lg-offset-1">
                                <img class="logo-background" src="<?php echo get_bloginfo('template_url') ?>/img/header_img_1.png">
                            </div>
                            <div class="container">
                                <div class="logo">
                                    <a class="col-sm-12 logo-link" href="<?php echo get_home_url(); ?>">
                                        <img class="logo_logo" src="<?php echo get_bloginfo('template_url') ?>/img/logo_logo_1.png">
                                    </a>
                                </div>

                                <div class="logo-text">
                                    <p>
                                        <a href="#">
                                            <img class="logo-img" src="<?php echo get_bloginfo('template_url') ?>/img/factor.png">
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-navigation">
                <div class="container">

                    <div class="fixed-menu-logo col-sm-3  col-xs-10">
                        <a  href="<?php echo get_home_url(); ?>">
                            <img  src="<?php echo get_bloginfo('template_url') ?>/img/logo_logo.png">
                        </a>
                    </div>

                    <nav class="navbar navbar-default  col-sm-12 col-xs-2" role="navigation">

                        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>


                        <div class="collapse  navbar-collapse navbar-primary-collapse row">
                            <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav main-menu', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>
                        </div>

                    </nav>
                    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav main-menu-mobile', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>
                    </div>


                    <div class="search-block  col-md-offset-9 col-md-3 col-sm-offset-9 col-sm-3  col-xs-10">
                        <form action="/" class="search-form">
                            <div class="form-group has-feedback">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" class="form-control" name="s" id="search" placeholder="<?php _e('որոնել...', 'bootstrap-basic'); ?>">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </form>
                    </div>


                </div>


            </div><!--.main-navigation-->

        </div>
