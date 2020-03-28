<?php
/**
 * The theme header
 *
 * @package bootstrap-basic
 */
 $lang = ICL_LANGUAGE_CODE;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <html lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Safe Soldiers</title>
            <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url') ?>/img/favicon.ico" type="favicon.ico">
            <link rel="stylesheet" href="<?php echo get_bloginfo('template_url') ?>/css/site.css" type="text/css" media="all">
            <?php wp_head(); ?>
        </head>

        <body>
            <header class="header container">
                <div class="container-fluid top-header">
                    <div class="logo-cont">
                        <a class="logo" href="<?php echo icl_get_home_url() ?>">
                          <?php if($lang == 'en'){
                            ?>
                            <img src="<?php echo get_bloginfo('template_url') ?>/img/safe.png" alt="Home" />
                            <?php
                          } elseif($lang == 'hy'){
                            ?>
                            <img src="<?php echo get_bloginfo('template_url') ?>/img/logo_arm.png" alt="Home" />
                            <?php
                          }
                          ?>

                        </a>
                    </div>
                    <div class="top-items">
                        <div class="soc-links mobile-hidden">
                            <a class="rss" href="<?php echo icl_get_home_url() ?>feed">
                                <i class="fa fa-rss" aria-hidden="true"></i>
                            </a>
                            <a class="facebook" target="_blank"  href="https://www.facebook.com/safesoldiers">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a class="twitter" target="_blank" href="https://twitter.com/peacedialogue">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a class="youtube" target="_blank" href="https://www.youtube.com/user/PeaceDialogueNGO">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a class="mail" target="_blank" href="mailto:mailbox@peacedialogue.am">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div id="lang_sel_list" class="lang_sel_list_vertical mobile-hidden">
                            <?php do_action('wpml_add_language_selector'); ?>
                        </div>
                        <div class="top_menu mobile-hidden">
                            <ul>
                                <li class="menu-item">
                                    <a href="<?php echo get_permalink(DONATE); ?>"><?php echo get_the_title(DONATE); ?></a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?php echo get_permalink(SITEMAP); ?>"><?php echo get_the_title(SITEMAP); ?></a>
                                </li>
                            </ul>
                        </div>
                        <form role="search" method="get" class="search-form form" action="/">
                            <label for="form-search-input" class="sr-only"><?php _e('Search for', 'safesoldiers') ?></label>
                            <div class="input-group">
                                <input type="search" id="form-search-input" class="form-control" placeholder="Search …" value="" name="s" title="Search for:">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><?php _e('Search', 'safesoldiers') ?></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <span class="menu"><?php _e('Menu', 'safesoldiers') ?></span>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only"><?php _e('Toggle navigation', 'safesoldiers') ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>

                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>
