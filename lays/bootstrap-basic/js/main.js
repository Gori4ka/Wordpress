var bar = jQuery('#upload_file_progress .progress-bar');
jQuery('#competition_file_form').ajaxForm({
    beforeSend: function () {
        jQuery('#upload_file_progress').show();
        var percentVal = '0%';
        bar.width(percentVal);
        bar.html(percentVal);
    },
    uploadProgress: function (event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        bar.html(percentVal);
    },
    success: function () {
        var percentVal = '100%';
        bar.width(percentVal)
        bar.html(percentVal);
    },
    complete: function (xhr) {
        var data = JSON.parse(xhr.responseText);
        jQuery('#upload_result .modal-body').html('<div class="alert alert-' + data.style + '">'
                + '<strong>' + data.message + '</strong> '
                + '</div>');
        jQuery('#upload_result').modal('show')
        jQuery('#competition_file_form').clearForm();
        jQuery('#upload_file_progress').hide();
        bar.width('0%')
        bar.html('0%');
    }
});
jQuery('#peyotto_login_form').ajaxForm({
    complete: function (xhr) {
        var data = JSON.parse(xhr.responseText);
        if (data.status == 'ok') {
            window.location.replace("/");
        } else {
            jQuery('#peyotto_login_form .login-error').html('<div class="alert alert-danger">'
                    + '<strong>' + data.message + '</strong> '
                    + '</div>');
        }
    }
});
jQuery('#peyotto_register_form').ajaxForm({
    complete: function (xhr) {
        var data = JSON.parse(xhr.responseText);
        if (data.status == 'ok') {
            window.location.replace("/");
        } else {
            jQuery('#register-layer .register-error').html('<div class="alert alert-danger">'
                    + '<strong>' + data.message + '</strong> '
                    + '</div>');
        }
    }
});
jQuery('#peyotto_change_user_pass_form').ajaxForm({
    complete: function (xhr) {
        var data = JSON.parse(xhr.responseText);
        if (data.status == 'ok') {
            jQuery('#peyotto-user-info .pass-change-message').html('<div class="alert alert-success">'
                    + '<strong>' + data.message + '</strong> '
                    + '</div>');
        } else {
            jQuery('#peyotto-user-info .pass-change-message').html('<div class="alert alert-danger">'
                    + '<strong>' + data.message + '</strong> '
                    + '</div>');
        }
    }
});
jQuery('#upload-file-selector').change(function () {
    jQuery("#competition_file_form").submit();
});
jQuery(".peyotto-login").on('click', function () {
    jQuery('#login-layer').show();
})
jQuery(".close-login-layer").on('click', function () {
    jQuery('#login-layer').hide();
})


jQuery(".peyotto-register ").on('click', function () {
    jQuery('#register-layer').show();
})
jQuery(".close-register-layer").on('click', function () {
    jQuery('#register-layer').hide();
})


jQuery(".peyotto-user-info").on('click', function () {
    jQuery('#peyotto-user-info').show();
})
jQuery(".close-peyotto-user-info").on('click', function () {
    jQuery('#peyotto-user-info').hide();
})

jQuery(".change-user-password").on('click', function () {
    jQuery('.change-user-password-form').show();
})
jQuery(".close-change-user-password").on('click', function () {
    jQuery('.change-user-password-form').hide();
})

var content_height = jQuery( window ).height() - jQuery( ".header" ).height() - jQuery( ".footer-height" ).height() - 5
if(jQuery('.content_height').height() < content_height){
  jQuery('.content_height').css('min-height', content_height);
}
jQuery(window).resize(function(){
    jQuery('.content_height').css('min-height', jQuery( window ).height() - jQuery( ".header" ).height() - jQuery( ".footer-height" ).height() - 5);
})

function markVotedItems(data) {
    var voted_items = []
    data.data.map(function (item) {
        voted_items.push(parseInt(item.object_id, 0))
    })
    var items_class = 'send_like'
    if (data.disable_vote == 'true') {
        items_class = 'disabled_vote_user_not_logged_in'
    }
    jQuery('.vote-item-wrapper').each(function (index) {
        var dataId = jQuery(this).data('id')

        if (voted_items.indexOf(dataId) != '-1') {
            jQuery(this).html('<div class="item-button item-disabled">'
                    + '<a>Քվեարկել</a>'
                    + '</div>')
        } else {
            jQuery(this).html('<div class="item-button item_id_' + dataId + '">'
                    + '<a class="' + items_class + '" data-id="' + dataId + '">Քվեարկել</a>'
                    + '</div>')
        }
    });
}



function success_get_user_vote_data(data) {
    if (data.status == 'ok') {
        markVotedItems(data)
    }
}


jQuery('.fancybox').fancybox();