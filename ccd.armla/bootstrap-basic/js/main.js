/**
 * Main Javascript.
 * This file is for who want to make this theme as a new parent theme and you are ready to code your js here.
 */
(function ($) {
    $(document).ready(function () {
        $('.dropdown').on('click', function () {
            if ($(window).width() > 767) {
                $(this).removeClass('open').addClass('open')
            }
        })
        if ($(window).width() <= 767) {
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                if ($(this).parent().hasClass('open'))
                    $(this).parent().removeClass('open');
                else {
                    $(this).parent().addClass('open');
                }
                // $(this).parent().addClass('open');
                // $(this).parent().find("ul").parent().find("li.dropdown").addClass('open');
            })
        }
    })
})(jQuery)
