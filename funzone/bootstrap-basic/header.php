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

        <?php
        global $post;
        $DefaultThumbnail = get_bloginfo('template_directory') . '/img/LOGO.png';
        if (is_singular()) {
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
            $thumb_url = $thumb['0'];
            if (!$thumb_url) {
                $thumb_url = $DefaultThumbnail;
            }
            $conten = wp_trim_words($post->post_content, $num_words = 55, $more = null);
            if ($conten == '') {
                $conten = '168blog.vs.am';
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
            <meta property="og:description" content="168blog.vs.am">
            <meta property="og:image" content="<?php echo $DefaultThumbnail; ?>">
        <?php } ?>

        <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url') ?>/img/favicon.ico" type="image/x-icon">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header role="banner" id='fixed_top' class="container-fluid">
            <div class="row">
                <div class="main-navigation main-container">
                  <div class="nav-logo-container">
                    <a href="<?php echo get_home_url(); ?>">
                      <img class="main-logo" src="<?php echo get_bloginfo('template_url') ?>/img/LOGO.png" alt="main-logo">
                    </a>
                  </div>
                    <nav class="navbar navbar-default">
                        <div class="language navbar-right">

                        </div>
                          <div class="site-menu">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>

                            </div>
                          </div>
                    </nav>
                    <div class="custom-search-form">
                      <div class="search-icon">
                        <i id='font_icon' class="fa fa-search" aria-hidden="true"></i>
                      </div>
                      <div class="search_form">
                        <form class="navbar-form" role="search" action="/">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="<?php _e('Search', 'bootstrap-basic') ?>" name="s">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </header>
				<!-- <div class="top-banner">
        	<?php dynamic_sidebar('after-top-menu-banner'); ?>
				</div> -->
