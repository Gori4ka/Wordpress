<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
?>

<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
?>
<div class="footer container site-background">
    <div class="footer-top clearfix">
        <div class="col-md-12">

            <p class="text">
                <span class="eu_img">
                    <img  src="<?php echo get_bloginfo('template_url') ?>/img/eu-banner.png">
                </span>
                <?php _e('Commitment to Constructive Dialogue” project section in ', 'bootstrap-basic') ?><a href="http://armla.am/">armla.am</a> <?php _e('website has been produced and launched with the assistance of the European Union. The contents of this section are the sole responsibility of the Project and can in no way be taken to reflect the views of the European Union.', 'bootstrap-basic') ?></p>
        </div>

    </div>

    <div class="footer-bottom clearfix">
        <div class="col-sm-4">
            <div class="footer-section-title">ccd.armla.am</div>
            <?php wp_nav_menu(array('menu' => 'footer-menu', 'menu_class' => 'menu-footer')); ?>
        </div>
        <div class="col-sm-4">
            <div class="footer-section-title">
                <a href="<?php echo get_permalink(CONTACT_US) ?>">
                    <?php echo get_the_title(CONTACT_US); ?>
                </a>
            </div>
            <p> <?php _e('Yerevan 0010,', 'bootstrap-basic') ?> <br>
                <?php _e('7 Nalbandyan Str. Suite 2,', 'bootstrap-basic') ?> <br>
                <?php _e('Phone: +374 10 540199', 'bootstrap-basic') ?> <br>
                <?php _e('E-mail: info@armla.am ', 'bootstrap-basic') ?> <br>
                www.ccd.armla.am
            </p>

        </div>
        <div class="col-sm-4 ">
            <div class="footer-section-title"><?php _e('Join us', 'bootstrap-basic') ?></div>
            <div class="footer-social">
                <a href="#" target="_blank"><i class="fa fa-facebook-square"></i></a>
                <a href="#" target="_blank"><i class="fa fa-twitter-square"></i></a>
            </div>
            <div class="footer-search">
                <form method="get" id="searchform" action="/">
                    <div class="input-group">
                        <input id="s" type="text" name="s" class="form-control" placeholder="<?php _e('Search', 'bootstrap-basic') ?> ">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xs-12 peyotto">
        <?php _e('powered by', 'bootstrap-basic') ?> <a target="_blank" href="https://peyotto.com">Peyotto</a>
    </div>

</div>

<!--wordpress footer-->
<?php wp_footer(); ?>
</body>
</html>

<?php
if (is_home()) {
    $ajax_nonce = wp_create_nonce("security");
    ?>
    <script type="text/javascript" >

        $(document).ready(function ($) {
            var data = {
                action: 'get_main_calendar',
                security: '<?php echo $ajax_nonce ?>'
            };

            $.post(ajaxurl, data, function (response) {
                if (response.status === 'ok') {
                    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    var weekdaysShort = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

                    if (response.blogID == 1) {
                        months = ["Հունվար", "Փետրվար", "Մարտ", "Ապրիլ", "Մայիս", "Հունիս", "Հուլիս", "Օգոստոս", "Սեպտեմբեր", "Հոկտեմբեր", "Նոյեմբեր", "Դեկտեմբեր"];
                        weekdaysShort = ["Կրկ", "Երկ", "Երք", "Չրք", "Հնգ", "ՈՒրբ", "Շբթ"];
                    }
                    $('#eventCalendar').eventCalendar({
                        jsonData: response.data,
                        jsonDateFormat: 'human',
                        locales: {
                            locale: "en",
                            moment: {
                                "months": months,
                                "weekdaysShort": weekdaysShort,

                            }
                        }
                    });

                    var d = new Date();
                    var curr_date = d.getDate();
                    var curr_month = d.getMonth();
                    var curr_year = d.getFullYear();
                    $("#eventCalendar li").each(function () {
                        if ($(this).attr("rel") > curr_date) {
                            $(this).addClass("future");
                        }
                    });

                    $('#eventCalendar .eventCalendar-arrow').on('click', function () {
                        if ($('#eventCalendar').attr("data-current-month") == curr_month && $('#eventCalendar').attr("data-current-year") == curr_year) {
                            $("#eventCalendar li").each(function () {
                                if ($(this).attr("rel") > curr_date) {
                                    $(this).addClass("future");
                                }
                            })
                        }
                    })

                }
            });
        });
    </script>
    <?php
}
