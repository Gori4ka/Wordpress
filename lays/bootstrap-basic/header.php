<?php
/**
 * The theme header
 *
 * @package lays
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

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
        <?php
        if (is_single()) {
            $trm = (int) get_option('active_voting');
            if (!has_term($trm, 'competition')) {
                wp_redirect('/', 301);
                exit;
            }
        }

        $class = '';
        wp_head();
        ?>
        <?php
        if (is_page(163)) {
            $class = 'is-single-members';
        }
        if (is_single()) {
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
            $class = 'is-single-members';
            ?>
            <meta property="og:title" content=""/>
            <meta property="og:type" content="article"/>
            <meta property="og:url" content="<?php the_permalink(); ?>" />
            <meta property="og:image" content="<?php echo $thumb; ?>" />
            <meta property="og:description" content="" />
            <?php
        } else {
            ?>
            <meta property="og:url" content="<?php echo get_home_url(); ?>"/>
            <meta property="og:title" content="<?php bloginfo('name'); ?>" />
            <meta property="og:description" content="" />
            <meta property="og:image" content="<?php echo get_bloginfo('template_url'); ?>/img/lays_fb_logo.jpg" />
            <?php
        }
        ?>
    </head>
    <body class="<?php echo $class; ?>">
        <!--[if lt IE 8]>
                <p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
        <![endif]-->
        <div class="container" id="contentWrapper">

            <div class="header clearfix">
                <div class="col-md-3 col-sm-3 col-xs-12 "style=" text-align: center;">
                    <a  href="<?php echo get_home_url(); ?>">
                        <img class="logo" src="<?php echo get_bloginfo('template_url') ?>/img/lays-logo.png">
                    </a>
                </div>
                <div class="header-center-block col-sm-offset-0 col-lg-6 col-sm-6 col-xs-6">
<!--                    <div class="menu-vote item-menu" style="margin: 0 auto; width: 193px;">
                        <a href="/">Գլխավոր Էջ</a>
                    </div>-->

                </div>

                <div class="header-right-block col-lg-3 col-sm-offset-0 col-sm-3 col-xs-6">
<!--                    <div class="peyotto-login item-menu">
                        <a href="<?php echo get_permalink(163) ?>"><?php echo get_the_title(163); ?></a>
                    </div>-->


                </div>
            </div>
