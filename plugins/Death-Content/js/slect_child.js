

jQuery(".delete_item").click(function(e) {
     e.preventDefault();
      var hrefAttribute = jQuery(this).attr("href");
    jQuery( "#dialog-confirm" ).dialog({
      resizable: false,
      height:140,
      modal: true,
      buttons: {
        "Delete": function() {          
           
           window.location.href = hrefAttribute; 
        
        },
        Cancel: function() {
     e.preventDefault();
         jQuery( this ).dialog( "close" );
       
        }
      }
    }); 
});

 
function checkMe() {  
    
}

(function($) {
    "use strict";

    $.fn.chained = function(parent_selector, options) {

        return this.each(function() {

            /* Save this to self because this changes when scope changes. */
            var self = this;
            var backup = $(self).clone();

            /* Handles maximum two parents now. */
            $(parent_selector).each(function() {

                $(this).bind("change", function() {
                    $(self).html(backup.html());

                    /* If multiple parents build classname like foo\bar. */
                    var selected = "";
                    $(parent_selector).each(function() {
                        selected += "\\" + $(":selected", this).val();
                    });
                    selected = selected.substr(1);

                    /* Also check for first parent without subclassing. */
                    /* TODO: This should be dynamic and check for each parent */
                    /*       without subclassing. */
                    var first = $(parent_selector).first();
                    var selected_first = $(":selected", first).val();

                    $("option", self).each(function() {
                        /* Remove unneeded items but save the default value. */
                        if (!$(this).hasClass(selected) &&
                                !$(this).hasClass(selected_first) && $(this).val() !== "") {
                            $(this).remove();
                        }
                    });

                    /* If we have only the default value disable select. */
                    if (1 === $("option", self).size() && $(self).val() === "") {
                        jQuery(self).attr("disabled", "disabled");
                    } else {
                        jQuery(self).removeAttr("disabled");
                    }
                    jQuery(self).trigger("change");
                });

                /* Force IE to see something selected on first page load, */
                /* unless something is already selected */
                if (!jQuery("option:selected", this).length) {
                    jQuery("option", this).first().attr("selected", "selected");
                }

                /* Force updating the children. */
                jQuery(this).trigger("change");

            });
        });
    };

    /* Alias for those who like to use more English like syntax. */
    $.fn.chainedTo = $.fn.chained;

})(jQuery);

jQuery(function() {
    jQuery("#usrform").change(function() {
        if (jQuery("#death_reason").is(":selected")) {
            jQuery("#death_reason_text").show();
        } else {
            jQuery("#death_reason_text").hide();
        }
    }).trigger('change');
});
jQuery(function() {
    jQuery("#usrform").change(function() {
        if (jQuery("#death_item_filter").is(":selected")) {
            jQuery("#death_res").show();
        } else {
            jQuery("#death_res").hide();
        }
    }).trigger('change');
});
jQuery(function() {
    jQuery("#usrform").change(function() {
        if (jQuery("#new_unit_region18").is(":selected") || jQuery("#new_unit_region1").is(":selected") || jQuery("#new_unit_region2").is(":selected") || jQuery("#new_unit_region3").is(":selected") || jQuery("#new_unit_region4").is(":selected") || jQuery("#new_unit_region5").is(":selected") || jQuery("#new_unit_region6").is(":selected") || jQuery("#new_unit_region7").is(":selected") || jQuery("#new_unit_region8").is(":selected") || jQuery("#new_unit_region9").is(":selected") || jQuery("#new_unit_region10").is(":selected") || jQuery("#new_unit_region11").is(":selected") || jQuery("#new_unit_region12").is(":selected") || jQuery("#new_unit_region13").is(":selected") || jQuery("#new_unit_region14").is(":selected") || jQuery("#new_unit_region15").is(":selected") || jQuery("#new_unit_region16").is(":selected") || jQuery("#new_unit_region17").is(":selected") || jQuery("#new_unit_region19").is(":selected")) {
            jQuery("#new_unit").show();
        } else {
            jQuery("#new_unit").hide();
        }
    }).trigger('change');
});

jQuery(function() {
    jQuery("#usrform").change(function() {
        if (jQuery("#set_unit").is(":selected")) {
            jQuery("#unit_del").hide();
        } else {
            jQuery("#unit_del").show();
        }
    }).trigger('change');
});



jQuery(function() {
    var result;
    jQuery('#unit').change(function() {
        result = jQuery("#unit option:selected").val();
        jQuery("a.delete_link").attr("href", function(i, href) {
            return href + result;
        });

    });


});


jQuery(function() {

    /* For jquery.chained.js */
    jQuery("#region").chained("#country");
    jQuery("#unit").chained("#region");
    /* Show button after each pulldown has a value. */

});



