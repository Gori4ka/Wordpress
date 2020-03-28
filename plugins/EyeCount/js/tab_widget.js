jQuery(document).ready(function($) {
    jQuery('.tab-switcher').each(function(index) {
        var $onetab = jQuery('.tab-switcher').eq(index);
        $onetab.children('.tab-button').click(function() {           
            if (jQuery(this).hasClass('active_btn') == false) {
                $onetab.children('.tab-button').removeClass('active-btn');
                jQuery(this).addClass('active-btn');

                $onetab.children('.widget-tab').removeClass('active-tab');
                var show_tab = jQuery(this).attr('rel');
                jQuery('#' + show_tab).addClass('active-tab');
            }
        });
    });
});