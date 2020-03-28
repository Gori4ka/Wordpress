
jQuery(document).ready(function ($) {
  if($('#infograph_ajax_security').val()){
    $('.total-number span').hide()
      var informerCanSendAjax = true;
      var informerCanSendAjaxSearch = true;
      var data = {
          action: 'get_cases_infograph_ajax',
          security: $('#infograph_ajax_security').val(),
          date: $('#infograph_ajax_date').val(),
          type: $('#infograph_ajax_type').val(),
          lang: $('#infograph_ajax_lang').val(),
      };
      send_informer_ajax(data);

          jQuery("#informer_arrow .arrow-left").hover(function(){
            $(this).css("color", "#9e9e9e");
            }, function(){
            $(this).css("color", "#cecdce");
          });

      jQuery('#informer_arrow .arrow-left').on('click', function () {

        jQuery("#informer_arrow .arrow-right").hover(function(){
          $(this).css("color", "#9e9e9e");
          }, function(){
          $(this).css("color", "#cecdce");
        });

          if (parseInt($('#infograph_ajax_date').val()) != 1994) {
              if (parseInt($('#infograph_ajax_date').val())) {
                  var prev_arrow = parseInt($('#infograph_ajax_date').val()) - 1;
              } else {
                  var prev_arrow = 1994;
              }

              if(prev_arrow === 1994){
                jQuery("#informer_arrow .arrow-left").hover(function(){
                  $(this).css("color", "#cecdce");
                  }, function(){
                  $(this).css("color", "#cecdce");
                });
              }
              var params = {
                  action: 'get_cases_infograph_ajax',
                  security: $('#infograph_ajax_security').val(),
                  date: prev_arrow,
                  type: $('#infograph_ajax_type').val(),
                  lang: $('#infograph_ajax_lang').val(),
              };
              send_informer_ajax(params)
          }
      })
      jQuery('#total').on('click', function () {

        jQuery("#informer_arrow .arrow-right, #informer_arrow .arrow-left").hover(function(){
          $(this).css("color", "#9e9e9e");
          }, function(){
          $(this).css("color", "#cecdce");
        });

          jQuery('.infograph .year .count').text('1994 - 2016');
          var params = {
              action: 'get_cases_infograph_ajax',
              security: $('#infograph_ajax_security').val(),
              date: null,
              type: $('#infograph_ajax_type').val(),
              lang: $('#infograph_ajax_lang').val(),
          };
          send_informer_ajax(params)
      })
      jQuery('.infograph .year .count').on('click', function () {
          var options = '';
          options = '<select id="change-infograph-year" name="change_year" >';
          options += '<option value="" style="display:none;">1994</option>'
          for (var i = 1994; i <= new Date().getFullYear(); i++) {
              options += '<option value="' + i + '">' + i + '</option>'
          }
          options += '</select>';
          jQuery('.infograph .year .count').hide();
          jQuery('.infograph .year').append(options);
      });

      jQuery('#change-infograph-year').live('change', function () {
        if($(this).val() == new Date().getFullYear()){
            jQuery("#informer_arrow .arrow-right").hover(function(){
              $(this).css("color", "#cecdce");
              }, function(){
              $(this).css("color", "#cecdce");
            });
          }else{
            jQuery("#informer_arrow .arrow-right").hover(function(){
              $(this).css("color", "#9e9e9e");
              }, function(){
              $(this).css("color", "#cecdce");
            });
          }

          if($(this).val() == 1994){
            jQuery("#informer_arrow .arrow-left").hover(function(){
              $(this).css("color", "#cecdce");
              }, function(){
              $(this).css("color", "#cecdce");
            });
          }else{
            jQuery("#informer_arrow .arrow-right").hover(function(){
              $(this).css("color", "#9e9e9e");
              }, function(){
              $(this).css("color", "#cecdce");
            });
          }


          jQuery('#change-infograph-year').remove();
          jQuery('.infograph .year .count').show().text($(this).val());
          var params = {
              action: 'get_cases_infograph_ajax',
              security: $('#infograph_ajax_security').val(),
              date: $(this).val(),
              type: $('#infograph_ajax_type').val(),
              lang: $('#infograph_ajax_lang').val(),
          };
          send_informer_ajax(params)
      });

      jQuery('#informer_arrow .arrow-right').on('click', function () {

        jQuery("#informer_arrow .arrow-left").hover(function(){
          $(this).css("color", "#9e9e9e");
          }, function(){
          $(this).css("color", "#cecdce");
        });

          if (parseInt($('#infograph_ajax_date').val()) != new Date().getFullYear()) {
              if (parseInt($('#infograph_ajax_date').val())) {
                  var next_arrow = parseInt($('#infograph_ajax_date').val()) + 1;
              } else {
                  var next_arrow = new Date().getFullYear();
              }

              if(next_arrow === new Date().getFullYear()){
                jQuery("#informer_arrow .arrow-right").hover(function(){
                  $(this).css("color", "#cecdce");
                  }, function(){
                  $(this).css("color", "#cecdce");
                });
              }

              var params = {
                  action: 'get_cases_infograph_ajax',
                  security: $('#infograph_ajax_security').val(),
                  date: next_arrow,
                  type: $('#infograph_ajax_type').val(),
                  lang: $('#infograph_ajax_lang').val(),
              };
              send_informer_ajax(params)
          }

      })

      jQuery('.cases .country-location').on('click', function () {
          if (informerCanSendAjaxSearch) {
              var data = {
                  action: 'frontend_cases_search',
                  date: parseInt($('#infograph_ajax_date').val()),
                  lang: $('#infograph_ajax_lang').val(),
                  country: parseInt($(this).attr('data-country-id')),
              };
              informerCanSendAjaxSearch = false;
              searche_carucell(data)
          }
      })

      jQuery('.reason .circle').on('click', function () {
          if (informerCanSendAjaxSearch) {
              var data = {
                  action: 'frontend_cases_search',
                  date: parseInt($('#infograph_ajax_date').val()),
                  lang: $('#infograph_ajax_lang').val(),
                  reason: parseInt(jQuery(this).attr('data-reason-id')),
              };
              informerCanSendAjaxSearch = false;
              searche_carucell(data)
          }
      })

      function send_informer_ajax(data) {
        $('.total-number span').hide()
        $('.total-number div').show()
          if (informerCanSendAjax) {
              informerCanSendAjax = false;
              $.post(ajaxurl, data, function (response) {
                  informerCanSendAjax = true;
                  var casesTotalCount = 0;
                  $('.cases .count').text(0)
                  if (Array.isArray(response.country)) {
                      response.country.map(function (item) {
                          $('.country_id_' + item.country_id + ' .count').text(item.count)
                          casesTotalCount += parseInt(item.count)
                      });
                  }
                  $('.reason .circle').text(0)
                  $('.percents span').text('0%')
                  if (Array.isArray(response.reasons)) {
                      response.reasons.map(function (item) {
                          $('.reason_id_' + item.reason_id + ' .circle').text(item.count)
                          $('.reason_prcent_' + item.reason_id).text(Math.round((parseInt(item.count) / casesTotalCount) * 100) + '%')
                      });
                  }
                  $('.total-number .count').text(casesTotalCount);
                  $('.total-number div').hide()
                  $('.total-number span').show()
                  $('#infograph_ajax_date').val(data.date);
                  if (data.date != null) {
                      $('.infograph .year .count').text(data.date);
                      $('#infograph_date').text(data.date);
                  }

              });
          }
      }
    }
///////////////////////////////interactiv/////////////////////////////
if(!$('#interactive_ajax_security').val()){
  return ;
}
function interactiv_ajax(data){
  $.post(ajaxurl, data, function (response) {
    var casesTotalCount = 0;
    var maxItemCount = [];
    $('.map_container .regionCount').text(0)
    $('.region_name tspan').text(0)
    $('.progress .progresWidth').attr("width", "0")
    $('#allText').text(0)
    $('#cUnknownText').text(0)
    if (Array.isArray(response.region)) {
        response.region.map(function (item) {
          maxItemCount.push(item.count);
        });
    }

    if (Array.isArray(response.region)) {
        response.region.map(function (item) {
            $('.region-id-' + item.region_id ).text(item.count)
            casesTotalCount += parseInt(item.count)
            $('#allText').text(casesTotalCount)
            if(150/Math.max(...maxItemCount) > 1){
              var percent = (item.count)*150/Math.max(...maxItemCount);
            }else{
               percent = (item.count)*1.4;
            }
            $('.progress .region-id-' + item.region_id).attr("width", percent)
        });
    }
  });
}

    var data = {
        action: 'get_interactive_ajax',
        security: $('#interactive_ajax_security').val(),
        date: $('#interactive_ajax_date').val(),
        type: $('#interactive_ajax_type').val(),
        lang: $('#interactive_ajax_lang').val(),
    };
      interactiv_ajax(data);

        var year = [];
      jQuery('.date_label .date').on('change', function () {
        $('.search-results').hide();
        $('#interactive_ajax_date').val($(this).val())
        var index = year.indexOf($(this).val());
        if (index > -1) {
            year.splice(index, 1);
        }else{
          year.push($('#interactive_ajax_date').val());
        }
        var data = {
          action: 'get_interactive_ajax',
          security: $('#interactive_ajax_security').val(),
          date: year,
          type: $('#interactive_ajax_type').val(),
          lang: $('#interactive_ajax_lang').val(),
        };
        $('#interactive_ajax_date').val(year);
          interactiv_ajax(data);
        });

      jQuery('.map_container .region').on('click', function () {
        var data = {
            action: 'frontend_cases_search',
            security: $('#interactive_ajax_security').val(),
            region: parseInt($(this).attr('data-region-id')),
            date: $('#interactive_ajax_date').val(),
            type: $('#interactive_ajax_type').val(),
            lang: $('#interactive_ajax_lang').val(),
        };
        searche_carucell(data)

      });

      jQuery('#unknownG').on('click', function () {
        var data = {
            action: 'frontend_cases_search',
            security: $('#interactive_ajax_security').val(),
            date: $('#interactive_ajax_date').val(),
            region: parseInt($('#cUnknown').attr('data-region-id')),
            type: $('#interactive_ajax_type').val(),
            lang: $('#interactive_ajax_lang').val(),
        };
        searche_carucell(data)

      });

      jQuery('#allG').on('click', function () {
        var data = {
            action: 'frontend_cases_search',
            security: $('#interactive_ajax_security').val(),
            date: $('#interactive_ajax_date').val(),
            type: $('#interactive_ajax_type').val(),
            lang: $('#interactive_ajax_lang').val(),
        };
        searche_carucell(data)

      });

      jQuery('.region_name').on('click', function () {
        var data = {
          action: 'frontend_cases_search',
          security: $('#interactive_ajax_security').val(),
          date: $('#interactive_ajax_date').val(),
          region: parseInt($(this).attr('data-parent-region-id')),
          type: $('#interactive_ajax_type').val(),
          lang: $('#interactive_ajax_lang').val(),
        };
        searche_carucell(data)
      });
//////////////////////////////////// highcharts_ajax ////////////////////////////////
  var data = {
    action: 'get_interactive_highcharts_ajax',
    security: $('#interactive_ajax_security').val(),
    date: $('#interactive_yare').val(),
    country:$('#country_list').val(),
    region:$('#region_list').val(),
    type: $('#interactive_ajax_type').val(),
    lang: $('#interactive_ajax_lang').val(),
  };
  highcharts_ajax(data)

      jQuery('#interactive_yare, #country_list, #region_list').live('change', function () {
        var data = {
          action: 'get_interactive_highcharts_ajax',
          security: $('#interactive_ajax_security').val(),
          date: $('#interactive_yare').val(),
          country:$('#country_list').val(),
          region:$('#region_list').val(),
          type: $('#interactive_ajax_type').val(),
          lang: $('#interactive_ajax_lang').val(),
        };
        highcharts_ajax(data)
      });

function highcharts_ajax(data){
  $('#all_records tspan').text(0)
  $.post(ajaxurl, data, function (response) {
    var casesTotalCount = 0;
    $('#all_records tspan').text(0)
    var arr = [];
    if (Array.isArray(response.reason)) {
        response.reason.map(function (item) {
          var parms = {name: item.name, y: parseInt(item.count), class: parseInt(item.reason_id)};
          arr.push(parms);
          get_highcharts (arr);
            casesTotalCount += parseInt(item.count)
            $('#all_records tspan').text(casesTotalCount)

        });
    }
  });
}

      function get_highcharts (parms) {
          $('#container').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie',
              },
              tooltip: {
                  pointFormat: '{point.percentage:.1f}%'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      point: {
                        events: {
                           click: function() {
                             var data = {
                               action: 'frontend_cases_search',
                               security: $('#interactive_ajax_security').val(),
                               date: $('#interactive_yare').val(),
                               country:$('#country_list').val(),
                               region:$('#region_list').val(),
                               reason: parseInt(this.class),
                               type: $('#interactive_ajax_type').val(),
                               lang: $('#interactive_ajax_lang').val(),
                             };
                             searche_carucell(data)
                           }
                         }
                      },
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>',
                          style: {
                            fontSize: '13px',
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                          }
                      }
                  }
              },
              series: [{
                  name: 'reason',
                  colorByPoint: true,
                  data:parms
              }]
          });
      }

function searche_carucell(data){
  $('#search_results_count').text(0);
  $('.search-results').show();
  $('#search-result-content').html('');
  $('#search-result-content').append('<div class="loader loader_slider">Loading...</div>')
  scrollToSearchResult();
  $.post(ajaxurl, data, function (response) {
    informerCanSendAjaxSearch = true;
      $('#search-result-content').html('');
      if (response.status == 'ok') {
          $("#search-result-content").data('owlCarousel').destroy();
          if (response.data) {
              append_data_to_seach_slider(response.data);
          }
          load_owl_carucell();
          owl_nav_hide_show(response.data);
      } else {
          $('#search-result-content').append('<div class="search-item-no-result">No results</div>')
      }
  });
}

});
