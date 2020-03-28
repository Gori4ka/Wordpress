<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="footer  animation-element">
            <?php if (is_single(get_the_ID())) { ?>
                <div class="single-footer clearfix">

                    <div class="single-footer-laft container">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="tags">
                                    <p class="title"><?php _e('Թեգերը', 'bootstrap-basic'); ?></p>
                                    <?php wp_nav_menu(array('menu' => 'single-footer', 'menu_class' => 'single-footer clearfix')); ?>
                                </div>

                                <div class="input">
                                    <p class="title"><?php _e('Տեղադրել', 'bootstrap-basic'); ?></p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="input_iframe" name="input_iframe" placeholder='<iframe width="100%" height="175px" src="//www.youtube.com/embed/nfbMCB6OujY?autoplay=" frameborder="0" allowfullscreen=""></iframe>'>
                                    </div>
                                </div>
                            </div>

                            <div class="single-footer-right col-sm-3">
                                <?php echo get_live_video(LIVEVIDEO, 1); ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } elseif (!is_category(AUTHOR)) { ?>
                <div class="footer-carousel">
                    <div class="hidden-xs">
                        <?php echo get_footer_carousel(VIDEO, 40, 'Բոլոր տեսանյութերը'); ?>
                    </div>
                    <div class="hidden-sm hidden-md hidden-lg">
                        <?php echo get_footer_carousel_mobail(VIDEO, 16, 'Բոլոր տեսանյութերը'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="footer-bottom  footer-order clearfix">
            <div class="container social-icon">
                <div class="row">
                    <div class="clearfix col-xs-12">
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
            </div>

            <div class="container-fluid">
                <div class="row footer-logo">
                    <div class="footer-logo-xs col-xs-offset-1 hidden-sm hidden-md hidden-lg">
                        <a href="<?php echo get_home_url(); ?>">
                            <img src="<?php echo get_bloginfo('template_url') ?>/img/footer-logo-xs.png">
                        </a>
                    </div>

                    <div class="container footer-address">
                        <p> Ք. Երևան, Մաշտոցի 42, բն 23 <i class="fa fa-map-marker" aria-hidden="true"></i></p>
                    </div>

                    <div class="footer-img hidden-xs">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/footer-img.png">
                    </div>

                </div>
            </div>

            <div class="container information">
                <div class="row information-order">
                    <div class="footer-phone col-xs-12">
                        <span>ՀԵՌ. + (374) 96 311 080</span></br>
                        <span> + (374) 77 311 080</span>
                        </span>
                        <div class="fa-phone-icon">
                            <i class="fa fa-phone col-xs-1" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="footer-menu col-md-9 col-xs-12">
                        <?php wp_nav_menu(array('menu' => 'footer-menu', 'menu_class' => 'menu-footer')); ?>

                    </div>
                    <div class="footer-email col-md-3 col-xs-12">
                        <span> EMAIL: info@factor.am </span><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>
                    <div class="clearfix">

                        <div class="copyright col-md-8"> © <?php echo date("Y"); ?> factor.am Բոլոր իրավունքները պաշտպանված են: Մեջբերումներ անելիս հղումը factor.am-ին պարտադիր է: Կայքում արտահայտված կարծիքները պարտադիր չէ, որ համընկնեն խմբագրության տեսակետի հետ:</div>
                        <div class="peyotto col-xs-12 col-md-3 col-md-offset-1">
                            powered by <a target="_blank" href="https://peyotto.com">Peyotto Technologies</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--wordpress footer-->
<?php wp_footer(); ?>


<?php if (!is_home()) : ?>
    <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "c47d18da-8f86-4808-bdf1-0b0445fab4d3", doNotHash: false, doNotCopy: true, hashAddressBar: false});</script>
<?php endif; ?>


<script src="<?php bloginfo('template_directory'); ?>/js/vendor/bootstrap.min.js?sw"></script>


<script src="<?php bloginfo('template_directory'); ?>/js/main.js?sw"></script>
<?php
if (is_single()) {
    global $__ec__ajax_post_id;

    $ajaxurl = '/ajax-helper.php?action=eyecount&id=';
    ?>
    <script>
        // Counter
        var eyecount_post_id = '<?php echo $__ec__ajax_post_id; ?>';
        var eyecount_element_selector = '<?php echo get_option('eyecount_element_selector'); ?>';

        if (typeof eyecount_post_id != "undefined" && eyecount_post_id != null) {
            jQuery.get('<?php echo $ajaxurl; ?>' + eyecount_post_id,
                    {},
                    function (data) {
                        var viewscount = parseInt(data);
                        jQuery(eyecount_element_selector).empty().text(viewscount);
                    });
        }
    </script>

    <?php
}
?>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-98108338-1', 'auto');
    ga('send', 'pageview');

</script>


<script src="<?php bloginfo('template_directory'); ?>/js/jquery.tmpl.js"></script>
<script type="text/javascript">
    var json_news = [];
    var seconds = 1 * 60 * 1000;
    window.setInterval(function () {
        jQuery.getJSON('/news_loader.php', {},
                function (data) {
                    //  data.reverse();                   
                    jQuery.each(data, function (i, item) {

                        if (!jQuery('#newsfeed-' + item.post_id).length) {
                            json_news[i] = item;
                        }
                    });
                    if (json_news != '') {
                        console.log(json_news);
                        jQuery("#newsfeedTemplate").tmpl(json_news).prependTo("#newsfeed");
                    }
                    json_news = [];
                });
    }, seconds);
</script>
<script id="newsfeedTemplate" type="text/x-jquery-tmpl">
    <div 
    class="news-loader item-post clearfix"
    id="newsfeed-${post_id}">
    <a href="${post_url}">
    <div class="post-list-image  ">
    <img width="150" height="150" src="${post_thumb_url}" class="attachment-thumbnail wp-post-image" alt="${post_title}" title="${post_title}">
    <div class="${icon}"></div>
    </div>

    <div class="text-content ">
    <div class="item-title">
    <span class="item-date">${post_date}</span>
    <div class="title ">${post_title}</div>
    </div>
    </div>
    </a>
    </div>
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        function addLink() {
            var body_element = document.getElementsByTagName('body')[0];
            if (body_element == null)
                return;
            var selection;
            selection = window.getSelection();
            var pagelink = "\n\r<br>\n\r<br> Ամբողջական հոդվածը կարող եք կարդալ այս հասցեով՝ <a href='" + document.location.href + "'>" + document.location.href + "\n\r<br>\n\r<br> © factor.am";
            var copytext = selection + pagelink;
            var newdiv = document.createElement('div');
            newdiv.style.position = 'absolute';
            newdiv.style.left = '-99999px';
            body_element.appendChild(newdiv);
            newdiv.innerHTML = copytext;

            selection.selectAllChildren(newdiv);
            window.setTimeout(function () {
                body_element.removeChild(newdiv);
            }, 0);
        }
        document.oncopy = addLink;
    });
</script>

</body>
</html>
