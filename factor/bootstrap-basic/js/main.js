/**
 * Main Javascript.
 * This file is for who want to make this theme as a new parent theme and you are ready to code your js here.
 */
(function ($) {
    $(document).ready(function () {

        $('#myCarousel .left').on('click', function () {

        })
        $('#myCarousel .fill iframe').on('click', function () {
            $(this).closest("item").find('.carousel-caption').hide();

        })

        $('#myCarousel').on('slide.bs.carousel', function () {
            $('div.active .fill').html($('div.active .fill').html())
        });



        $(window).scroll(function () {
            $('.animation-element').each(function () {
                if (($(this).offset().top - $(window).scrollTop()) > $(window).height()) {
                    $(this).stop().fadeTo('fast', 0.01)
                } else {
                    $(this).stop().fadeTo('fast', 1)
                }
            })
        })

        $( ".archive-calendar" ).click(function() {

          if($( this).hasClass("displayNone")){
            $(".calendar").css("display", "none");
            $( this).removeClass("displayNone");
          }else {
            $( this).addClass("displayNone");
            $(".calendar").css("display", "block");
          }

        })

        $(window).scroll(function () {
          if(window.innerWidth >766){
            if ($(window).scrollTop() > 70) {
                $('.main-navigation').addClass('container-fluid navbar-fixed-top');
                //$('.serche-block').addClass('fixed-serche');
            } else {
                $('.main-navigation').removeClass('container-fluid navbar-fixed-top');
                //$('.serche-block').removeClass('fixed-serche');
            }
          }
        })

        $("a").removeAttr("data-toggle");

        if (window.innerWidth <= 767) {
          $(".menu-item.dropdown").append('<i class="fa fa-angle-down" aria-hidden="true"></i>');

          $( ".dropdown .fa" ).click(function() {
            if($( this).closest("li").hasClass("open")){
              $( this).closest("li").removeClass("open");
            }else {
              $("li").removeClass("open");
              $( this).closest("li").addClass("open");
            }
          })

        }


// Instantiate the Bootstrap carousel footer
        // $('.carousel[data-type="multi"] .item').each(function () {
        //     var next = $(this).next();
        //     if (!next.length) {
        //         next = $(this).siblings(':first');
        //     }
        //     next.children(':first-child').clone().appendTo($(this));

        //     for (var i = 0; i < 2; i++) {
        //         next = next.next();
        //         if (!next.length) {
        //             next = $(this).siblings(':first');
        //         }
        //         next.children(':first-child').clone().appendTo($(this));
        //     }
        // })

    })
})(jQuery)
