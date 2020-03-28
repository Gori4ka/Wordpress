(function($) {
    $(document).ready(function() {
      $(window).scroll(function () {
          if(window.innerWidth >767){
            if ($(window).scrollTop() > 70) {
                $('#fixed_top').addClass('navbar-fixed-top');
                $('.nav-logo-container').hide();
                $('.marginTop').css('margin-top', '190px')
                $('.social_fixed').show();
                $('.social-hidden-scroll').hide();
            } else {
                $('#fixed_top').removeClass('navbar-fixed-top');
                $('.nav-logo-container').show();
                $('.marginTop').css('margin-top', '0');
                $('.social_fixed').hide();
                $('.social-hidden-scroll').show();
            }
          }
      })

      var content_height = $( window ).height() - $( "#fixed_top" ).height() - $( "#site_footer" ).height() - 1
      if($('.marginTop').height() < content_height){
        $('.marginTop').css('min-height', content_height);
      }
      $(window).resize(function(){
          $('.marginTop').css('min-height', $( window ).height() - $( "#fixed_top" ).height() - $( "#site_footer" ).height() - 1);
      })

      $('.dropdown').on('click', function() {
          if ($(window).width() > 767) {
              $(this).removeClass('open').addClass('open')
              $('.dropdown a').removeAttr( "data-toggle" );
          }
      })

      $('.search-icon').on('click', function() {
        if(jQuery('#font_icon').hasClass('fa-search')){
          jQuery('.search-icon .fa').removeClass('fa-search').addClass('fa-times');
          jQuery('.search_form').show();
        }else {
          jQuery('.search-icon .fa').removeClass('fa-times').addClass('fa-search');
          jQuery('.search_form').hide();
        }
      })

    });
})(jQuery);
