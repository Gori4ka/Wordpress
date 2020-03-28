<?php
/**
 * The theme footer
 *
 * @package lays
 */
?>
</div> <!-- COntainer END-->
<div class="container-fluid footer-height">
    <div class="footer-background row">
        <div class="container">
            <div class="footer">
                <div class="">
                    <div class="col-sm-12 col-xs-12">
                        <div class="ordrable-footer">
                            <div class="footer-left main-section-text col-md-3 col-sm-6 col-xs-12">
                                <p class="text-1">&copy; <?php echo date('Y'); ?> Pepsico inc.</p>
                                <p class="text-2">All rights reserved</p>
                                <p class="text-3 ">Designed by <a href="http://ipmarketing.am/" target="_blank" style="    color: #333333;">ip marketing</a></p>
                            </div>
                            <div class="footer-right col-md-offset-6 col-md-3 col-sm-6 col-xs-12">
                                <div class="social-icon">
                                    <a  class="more">ավելին</a>
                                    <a href="https://www.facebook.com/Laysarmenia/?ref=br_rs" target="_blank"  class="facebook zoom-block">
                                        <img src="<?php echo get_bloginfo('template_url') ?>/img/facebook1600.jpg">
                                    </a>
                                    <a href="https://www.instagram.com/laysarmenia/" target="_blank" class="instagram zoom-block">
                                        <img src="<?php echo get_bloginfo('template_url') ?>/img/instagram1600.jpg">
                                    </a>
                                    <!-- <a href="#" target="_blank" class="youtube zoom-block">
                                        <img src="<?php echo get_bloginfo('template_url') ?>/img/youtube1600.jpg">
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--wordpress footer-->
<?php wp_footer(); ?>


<?php
$ajax_nonce = wp_create_nonce("get_user_vote_data");
$set_ajax_nonce = wp_create_nonce("set_user_vote_data");
?>
<script>
    jQuery(document).ready(function () {

        var disable_vote = false;
        function showhideVoteLoadin(item_Id) {
            if (disable_vote) {
                jQuery('.item_id_' + item_Id + ' .send_like').addClass('loading-animation');
                jQuery('.item_id_' + item_Id + ' .send_like').append('<i class="fa fa-spinner fa-spin"></i>');
            } else {
                jQuery('.item_id_' + item_Id + ' .send_like').removeClass('loading-animation');
                jQuery('.item_id_' + item_Id + ' .send_like .fa').remove();
            }
        }
        function get_user_data_by_api(data) {
            jQuery.ajax({
                url: "<?php echo admin_url('admin-ajax.php') ?>",
                type: "POST",
                data: data,
                success: success_get_user_vote_data,
            });
        }
        window.fbAsyncInit = function () {
            FB.init({
                appId: '1843587089295558',
                autoLogAppEvents: true,
                xfbml: true,
                version: 'v2.9'
            });
            FB.AppEvents.logPageView();
            function notloggedinfbuser() {
                FB.login(function (response) {
                    if (response.authResponse) {
                        console.log('Welcome!  Fetching your information.... ');
                        FB.api('/me', function (response) {
                            window.location.replace("/vote");
                        });
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                });
            }
            FB.getLoginStatus(function (response) {
                console.log(response)
                if (response.status === 'connected') {
                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;
                    var data = {
                        action: 'get_user_vote_data',
                        security: '<?php echo $ajax_nonce; ?>',
                        user_id: uid,
                        logged_in: true
                    }
                    get_user_data_by_api(data)
                    jQuery(".peyotto-vote").on("click", ".send_like", function () {
                        if (disable_vote) {
                            return
                        }
                        disable_vote = true
                        var item_id = jQuery(this).data('id')
                        showhideVoteLoadin(item_id)
                        jQuery.ajax({
                            url: "<?php echo admin_url('admin-ajax.php') ?>",
                            type: "POST",
                            data: {
                                action: 'set_user_vote_data',
                                security: '<?php echo $set_ajax_nonce; ?>',
                                user_token: accessToken,
                                item_id: item_id,
                                user_id: uid
                            },
                            success: function (data) {
                                disable_vote = false;
                                showhideVoteLoadin(item_id)
                                if (data.status == 'ok') {
                                    var params = {
                                        action: 'get_user_vote_data',
                                        security: '<?php echo $ajax_nonce; ?>',
                                        user_id: uid
                                    }
                                    get_user_data_by_api(params)

                                    var tmpcnt = jQuery('.vote_item_id_' + item_id + ' .item-count').data('count')
                                    jQuery('.vote_item_id_' + item_id + ' .item-count').html(tmpcnt + 1)
                                }
                            },
                        });
                    });
//
                } else {
                    var data = {
                        action: 'get_user_vote_data',
                        security: '<?php echo $ajax_nonce; ?>',
                        user_id: null,
                        logged_in: false
                    }
                    get_user_data_by_api(data)
                }
            });


        };
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    });
    jQuery('body').on('click', '.disabled_vote_user_not_logged_in', function () {
        FB.login(function (response) {
            if (response.authResponse) {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function (response) {
                    window.location.replace("/vote");
                });
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        });
    })
</script>
</body>
</html>
