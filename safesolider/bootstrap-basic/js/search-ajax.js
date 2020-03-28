function load_owl_carucell() {
    jQuery("#search-result-content").owlCarousel({
        nav: true,
        navText: [
            "<span class='fa fa-angle-left'></span>",
            "<span class='fa fa-angle-right'></span>"
        ],
        dots: true,
        responsive: {
            0: {items: 3,
                margin: 15,
                slideBy: 3
            },
            480: {items: 5,
                margin: 30,
                slideBy: 5
            },
            1200: {items: 10,
                margin: 30,
                slideBy: 10
            }
        },
        responsiveRefreshRate: 100
    });
}

function append_data_to_seach_slider(data) {
  var item_count = 0
    jQuery.map(data, function (single_cases, i) {
        jQuery('#search-result-content').append('<div class="item"><a title="' + single_cases.first_name + ' ' + single_cases.last_name + '" href="' + single_cases.url + '"><img src="' + single_cases.image_url + '"><span>' + single_cases.first_name + ' ' + single_cases.last_name + '</span></a></div>')
        item_count++;
    });
    jQuery('#search_results_count').text(item_count);

}
function scrollToSearchResult() {
    jQuery('html, body').animate({
        scrollTop: jQuery('#search-results').offset().top-20
    }, 500);
}

function owl_nav_hide_show(data) {
  var a = 0;
    jQuery.map(data, function (single_cases, i) {
        a++;
        if(jQuery( window ).width() > 1182){
          if(a<11){
            jQuery('.owl-nav .owl-next').hide()
            jQuery('.owl-nav .owl-prev').hide()
          }else{
            jQuery('.owl-nav .owl-next').show()
            jQuery('.owl-nav .owl-prev').show()
          }
        }
    });
    jQuery(".owl-nav .owl-prev, .owl-nav .owl-next").hover(function(){
      jQuery(this).css("color", "#9e9e9e");
      }, function(){
      jQuery(this).css("color", "#fff");
    });
}
