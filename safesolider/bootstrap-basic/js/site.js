

jQuery(document).ready(function () {


    load_owl_carucell();


    jQuery(function () {
        jQuery('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'

        });
        jQuery('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        jQuery('#datetimepicker3').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });

    jQuery('#frontend-add-incident').ajaxForm({
        success: function (response) {
            console.log(response.status);
            if (response.status == 'ok') {
                bootbox.dialog({
                    message: response.message,
                    title: "",
                    closeButton: false,
                    buttons: {
                        success: {
                            label: "Ok",
                            className: "btn-success",
                            callback: function () {
                                location.reload()
                            }
                        }
                    }
                });
            }
        }
    });

    jQuery('#save_and_submit').on('click', function () {
        return confirm('Are you sure?');
    });

    // jQuery('.input-group-btn .btn-default').on('click', function () {
    //   jQuery('.search-results').show();
    //   jQuery('#search-result-content').html('');
    //   jQuery('#search-result-content').append('<div class="loader loader_slider">Loading...</div>')
    //   scrollToSearchResult();
    // });

    // jQuery('#frontend-database').ajaxForm({
    //     success: function (response) {
    //       jQuery('#search-result-content').html('');
    //         if (response.status == 'ok') {
    //             console.log(response.data);
    //         } else {
    //             jQuery('#search-result-content').append('<div class="search-item-no-result">No result</div>')
    //         }
    //     }
    // });

    jQuery('#countryList').on('change', function (e)
    {
        jQuery('#regionList').val([]);
        jQuery('#regionList option').hide();
        jQuery('#regionList .country_' + this.value).show();
        jQuery('.selectpicker').selectpicker('refresh');

    });

    jQuery('#country_list').on('change', function (e)
    {
        jQuery('#region_list').val([]);
        jQuery('#region_list option').hide();
        jQuery('#region_list .country_' + this.value).show();
        jQuery('.selectpicker').selectpicker('refresh');

    });

    jQuery('#result-close').on('click', function () {
        jQuery(".search-results").hide();
    });

    var windowsize = jQuery(window).width();
    if (windowsize > 767) {
      jQuery('.menu-item-has-children').click(function (e) {
          e.stopPropagation();
      });
    }

    jQuery(".featured-post-list .news-item a").hover(function(){
      var data_title = jQuery(this).attr("data-title");
      var data_img = jQuery(this).attr("data-img");
      var data_url = jQuery(this).attr("data-url");
      jQuery('.featured-item-title a').text(data_title)
      jQuery('.featured-item-image img').attr("src", data_img)
      jQuery('.featured-item-title a').attr("href", data_url)
      });

});
