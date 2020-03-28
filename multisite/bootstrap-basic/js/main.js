$('.ajax-load-more').on('click', function () {
    ajaxloading = false;

    var paneapi = null;
    var pane = $(this).parent().parent().parent();
    if (pane.hasClass('scroll-pane')) {
        paneapi = pane.data('jsp');
    }
    var btn = $(this);
    var category = btn.data("category");
    var style = btn.data("style");
    var offset = btn.data("offset");
    var destination = btn.data("destination");
    if (!ajaxloading) {
        ajaxloading = true;
        btn.addClass('ajaxloading');
        $.get('/ajax-video.php?action=loadstories&offset=' + offset + '&category=' + category + '&style=' + style,
                {},
                function (data) {
                    btn.removeClass('ajaxloading');

                    var fadeBg = paneapi == null ? 'rgba(0, 0, 0, 0.31)' : '#FFFDE2';

                    var new_items = $(data)
                            .hide()
                            .appendTo('#' + destination)
                            .slideDown()
                            .animate({backgroundColor: 'rgba(255,255,255,0)'},
                                    800,
                                    'swing',
                                    function () {
                                    }
                            );
                    //reinitialize and scroll down in case we are in scroll-pane
                    if (paneapi != null) {
                        paneapi.reinitialise();
                        paneapi.scrollToBottom();
                    } else {
                        if (destination !== 'latest-videos') {
                            $('html, body').animate({scrollTop: $(document).height()}, 'slow');
                        }
                    }

                    btn.data("offset", ($('#' + destination).find('.news-item').length) * 6 + 3);

                    if (data != '') {
                        ajaxloading = false;
                    }
                });
    }
});

