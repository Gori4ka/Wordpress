
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?php echo get_bloginfo('template_url') ?>/images/user/favicon-32-ico-aqmagatrapjbnh5tzsdk.ico">
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url') ?>/images/user/favicon-16-png-aqmagatrapjbnh5tzsdk.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url') ?>/images/user/favicon-32-png-aqmagatrapjbnh5tzsdk.png" sizes="32x32">
    <meta property="og:title" content="Nexus Global" />
    <meta property="og:description" content="Nexus Global" />
    <meta property="og:image" content="<?php echo get_bloginfo('template_url') ?>/images/user/pqjomcufu6j7f6zjzmg0.png" />
    <meta property="og:image:width" content="2000" />
    <meta property="og:image:height" content="875" />
    <title>Nexus Global</title>
    <meta name="description" content="Nexus Global">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,700italic,400italic' rel='stylesheet' type='text/css'>
    <link class="gfont" href='https://fonts.googleapis.com/css?family=Montserrat:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link class="gfont" href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link class="gfont" href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link class="gfont" href='https://fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link class="gfont" href='https://fonts.googleapis.com/css?family=Ubuntu:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link class="gfont" href='https://fonts.googleapis.com/css?family=Nunito:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>

    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1455381624791110');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=1455381624791110&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->

    <?php wp_head(); ?>
</head>
<body>


    <div id="pcon" class="lang_<?=pll_current_language()?>">
        <div class="pb_section" id="sec_1">
            
            <div class="pb_row pb_row-pad" id="row_0">
                <div class="pb_col pb_col-1-4" id="col_0">
                    <div class="el_type_image" id="element_0">
                        <div id="element_image_0" class=""><a href="<?=get_home_url()?>"><img src="<?php echo get_bloginfo('template_url') ?>/images/user/wrmnuccwpk811yjtl8yz.jpg"></a></div>
                    </div>
                </div>
                <div class="pb_col pb_col-3-4" id="col_1">
                    <div id="element_1_loop">

                        <div class="el_type_dropdown" id="element_1">
                            <?php 
                            	wp_nav_menu(
                                	array(
                                		'theme_location' => 'primary',
                                		'container' => false,
                                		'menu_id' => '1',
                                		'items_wrap'=>'<ul id="element_dropdown_1" class="ig_dd ig_dropdown">%3$s</ul>'
                            		)
                            	);
                            ?>
                        </div>
                    </div>
                </div>
            </div>