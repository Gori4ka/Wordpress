jQuery('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    weekStart: 2,
    startDate: "01/01/1990",
    //endDate: "01/12/2016"
});

//jQuery('#regionList').prop('disabled', true);
regionVisibility()
unitVisibility()
reasontextVisibility()


function regionVisibility() {
    if (jQuery('#countryList').val()) {
        jQuery('#regionList').prop('disabled', false);
    } else {
        jQuery('#regionList').prop('disabled', true);
    }
}

function unitVisibility() {
    if (jQuery('#regionList').val()) {
        jQuery('#unitList').prop('disabled', false);
    } else {
        jQuery('#unitList').prop('disabled', true);
    }
}

function reasontextVisibility() {
    if (jQuery('#reasonList').val() == 8 || jQuery('#reasonList').val() == 16) {
        jQuery('#reasontext').show();
    } else {
        jQuery('#reasontext').hide();
    }
}

jQuery('#countryList').on('change', function (e)
{
    regionVisibility()
    jQuery('#regionList').val([]);
    jQuery("#unitList").val([]);
    jQuery('#regionList option').removeAttr("selected")
    jQuery('#regionList option').hide();
    jQuery('#regionList .country_' + this.value).show();

});

jQuery('#regionList').on('change', function (e)
{
    unitVisibility()
    jQuery("#unitList").val([]);
    jQuery('#unitList option').removeAttr("selected")
    jQuery('#unitList option').hide();
    jQuery('#unitList .region_' + this.value).show();

});

if (jQuery('#countryList').val() !== 0) {
    jQuery('#regionList option').hide();
    jQuery('#regionList .country_' + jQuery('#countryList').val()).show();
}

if (jQuery('#regionList').val() !== 0) {
    jQuery('#unitList option').hide();
    jQuery('#unitList .region_' + jQuery('#regionList').val()).show();
}

jQuery('#reasonList').on('change', function (e)
{
    reasontextVisibility()
});

jQuery('.delete').on('click', function () {
    return confirm('Delete this post?');
});

jQuery('.filterdisabled').prop('disabled', false);
jQuery('.filterdisabled option').show();

jQuery(function ($) {

    // Set all variables to be used in scope
    var frame,
            metaBox = $('#meta-box-id.postbox'), // Your meta box id here
            addImgLink = metaBox.find('.upload-custom-img'),
            delImgLink = metaBox.find('.delete-custom-img'),
            imgContainer = metaBox.find('.custom-img-container'),
            imgListContainer = $('.image-lists'),
            imgIdInput = metaBox.find('.custom-img-id'),
            imgIdList = metaBox.find('.media_id_lists');

    // ADD IMAGE LINK
    addImgLink.on('click', function (event) {

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on('select', function () {
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            imgContainer.find('img').remove();
            // Send the attachment URL to our custom image input field.

            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.id);
            var old_val = imgIdList.val();
            if (old_val != 'undefined' && old_val != '') {
                old_val += ','
            }
            imgIdList.val(old_val + attachment.id)
            imgListContainer.append(' <div class="single-image"> \
            <div class="image-area clearfix"><img src="' + attachment.url + '" alt="" style="max-width:100%;"/> \
            </div><div class="image-btn"> \
            <span class="dashicons dashicons-trash delete_image" data-image-id="' + attachment.id + '"></span> \
            <span class="dashicons dashicons-visibility set_featured_image "  data-image-url="' + attachment.url + '" data-image-id="' + attachment.id + '"></span> \
            </div></div>');
        });

        // Finally, open the modal on click
        frame.open();
    });


    // DELETE IMAGE LINK
    delImgLink.on('click', function (event) {

        event.preventDefault();

        // Clear out the preview image
        imgContainer.html('');

        // Un-hide the add image link
        addImgLink.removeClass('hidden');

        // Hide the delete image link
        delImgLink.addClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('');

    });


    $('.set_featured_image').live('click', function () {
        var featured_media_id = $(this).attr('data-image-id')
        var featured_media_url = $(this).attr('data-image-url')
        $('.featured_id').val(featured_media_id)
        $('.set_featured_image').removeClass('current-featured')
        $('.featured-img').html('<img src="' + featured_media_url + '">')
        $(this).addClass('current-featured')
    })

    $('.delete_image').live('click', function () {
        var removable_media_id = $(this).attr('data-image-id')
        var featured_media_id = $('.featured_id').val()
        $(this).closest("div.single-image").remove()
        var media_ids = $('.media_id_lists_val').val()
        media_ids = media_ids.split(',')
        var index = media_ids.indexOf(removable_media_id);
        if (index > -1) {
            media_ids.splice(index, 1);
        }
        if (featured_media_id == removable_media_id) {
            $('.featured_id').val('')
            $('.featured-img').html('');
        }
        $('.media_id_lists_val').val(media_ids.join())

    })
});
