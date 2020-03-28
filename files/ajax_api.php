<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
            add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
	
	<?php if ( is_active_sidebar( 'product-footer' ) ) : ?>
			<?php dynamic_sidebar( 'product-footer' ); ?>
	<?php endif; ?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

<script type="text/javascript">
(function($) {
	var headers = {
		Authorization: 'CBX-SIMPLE-TOKEN Token=b1a8fae657aff19c4be1a04116b167c9004156c1',
		'Content-Type': 'application/json'
	};

	window.cb_images = [];

	window.cb_ajax = function(url, body, successCB) {
		if(arguments.length == 3) {
			console.log(JSON.stringify(body))
			$.ajax({
				url: 'https://api.colourbox.com' + url,
				type: 'POST',
				dataType: 'json',
				headers: headers,
				data: JSON.stringify(body),
				success: successCB
			})
		}
		else if(arguments.length == 2) {
			$.ajax({
				url: 'https://api.colourbox.com' + url,
				dataType: 'json',
				headers: headers,
				type: 'GET',
				success: body
			})
		}
	}

	window.colorbox = function(e) {

		var search_name = $(e).find('input').val();
		cb_ajax('/search/colourbox/media?q=' + encodeURIComponent(search_name) + '&order=relevance&return_values=filename+unique_media_id+thumbnail_url', function(data) {
			if(data.response.media.length) {
				var html = '<div class="row"><div class="col-sm-12"><button class="button pull-left add_colorbox_image">Add image</buton></div></div><div class="items">';
				for(var i in data.response.media) {
					var line = data.response.media[i];
					html += '<div class="item"><img class="img-check" src="' + line.thumbnail_url + '" /><input class="colorbox-images" type="checkbox" data-value="' + line.unique_media_id + '" ></div>';
				}
				html += '</div>';
				$('#cb_images').html(html)
			}
		})

		return false;
	};
	jQuery( document ).ready(function() {

		$.ajax({
			url: 'https://api.colourbox.com/media/23070797/download',
			headers: {
				Authorization: 'CBX-SIMPLE-TOKEN Token=b1a8fae657aff19c4be1a04116b167c9004156c1',
				'Content-type': 'image/jpeg'
			},
			success: function(response, status, request) {
				console.log(arguments)
				// $('.choose-from-gallery-section').html('<img src="' + response + '" />')
			}
		})

		// cb_ajax("/media/3198182/download",function(data, status, request){
	 //        var disp = request.getResponseHeader('Content-Disposition');
	 //        console.log(disp);
	 //        // if (disp && disp.search('attachment') != -1) {
	 //            var form = $('.choose-from-gallery-section');
	 //            $.each(params, function(k, v) {
	 //                form.html($('<img src="' + v + '" />'));
	 //            });
	 //            // $('body').append(form);
	 //            // form.submit();
	 //        // }
		// })

		$(document).on("change", ".colorbox-images", function(){
			var id = $(this).data("value"),
				cb_img = window.cb_images;
			(cb_img.indexOf(id) > -1) ? cb_img.splice(cb_img.indexOf(id), 1) : cb_img.push(id);
			
		});

		$(document).on("click", ".add_colorbox_image", function(){
			cb_ajax("/media/purchase", {
				unique_media_ids: window.cb_images,
				colourbox_id: 304743
			}, function(data){
				console.log(data)
			})
		});

		// var hmac = '<?=hash_hmac('sha1','beEVhMCruAedMmWiVzXts4fu5cWG2AAMtlXpaKGNG3Z0gm0UYYM8WXyD0Z5dJ3fd:' . time(),'2cmLnxZvaHbueHcpLzFEAEnHBbF5cNPEn53n8VWWGMtQPCNOiqnl2vBeMw1EiaXJ')?>';
		var selectedVal = jQuery("#pa_quantity").find(":selected").val();
		var valuesNedded = {};
		var timer = setInterval(function() {
			var block = $('.wcuf_already_uplaoded_data_container');
			if(block.is(':visible') && block.length) {
				var key = jQuery("#pa_quantity").find(":selected").val();
				var val = $('.wcuf_file_preview_list_item').length
				valuesNedded[key] = val;
				clearInterval(timer);
				checkAndDisabledAddToCardButton();
			}
			else if(!block.is(':visible')) {
				checkAndDisabledAddToCardButton();
				clearInterval(timer);
			}
		}, 500)


		function checkAndDisabledAddToCardButton() {
			var selectedVal = jQuery("#pa_quantity").find(":selected").val();
			if(valuesNedded[selectedVal] && selectedVal[0] == valuesNedded[selectedVal]) {
				jQuery("button.single_add_to_cart_button").removeClass('disabled').attr('disabled', false);
				jQuery("button.wcuf_upload_field_button").addClass('disabled').attr('disabled', true);
				jQuery("input.wcuf_file_input_multiple").addClass('disabled').attr('disabled', true);
			} else {
				jQuery("button.single_add_to_cart_button").addClass('disabled').attr('disabled', true);
				jQuery("button.wcuf_upload_field_button").removeClass('disabled').attr('disabled', false);
				jQuery("input.wcuf_file_input_multiple").removeClass('disabled').attr('disabled', false);
			}
			// if($('.wcuf_upload_button_container .choose-from-gallery').length === 0) {
			// 	$('.wcuf_upload_button_container').prepend('<button class="button wcuf_upload_field_button pull-right choose-from-gallery" data-toggle="modal" data-target="#frame">CHOOSE FROM GALLERY</button>')
			// }
		}

		jQuery(document).on("change", "input.wcuf_file_input", function (){
			var timer = setInterval(function() {
				var block = $('.wcuf_already_uplaoded_data_container .wcuf_file_preview_list_item');
				if(block.is(':visible') && block.length == valuesNedded[selectedVal]) {
					checkAndDisabledAddToCardButton();
					clearInterval(timer);
				}
				else if(!$('.wcuf_already_uplaoded_data_container').is(':visible')) {
					checkAndDisabledAddToCardButton();
					clearInterval(timer);
				}

			}, 500)
			var files = jQuery("input.wcuf_file_input")[0].files;
			var count = jQuery(".wcuf_file_preview_list li").length + files.length;
			var selectedVal = jQuery("#pa_quantity").find(":selected").val();
			valuesNedded[selectedVal] = count;
			checkAndDisabledAddToCardButton();
		});
		jQuery(document).on('click', '.wcuf_delete_file_icon', function() {
			var selectedVal = jQuery("#pa_quantity").find(":selected").val();
			valuesNedded[selectedVal] = valuesNedded[selectedVal] - 1;
			var timer = setInterval(function() {
				var block = $('.wcuf_already_uplaoded_data_container li');
				if(valuesNedded[selectedVal] == block.length) {
					checkAndDisabledAddToCardButton();
					clearInterval(timer);
				}
			}, 500)
		});

		jQuery(document).on('change', "#pa_quantity", function() {
			var timer = setInterval(function() {
				var block = $('.wcuf_already_uplaoded_data_container li');
				if($('#wcuf_product_ajax_container').css('opacity') == 1) {
					checkAndDisabledAddToCardButton();
					clearInterval(timer);
				}

			}, 500)
		});

		var modal = '<div id="frame" class="modal fade" role="dialog">'+
  				'<div class="modal-dialog">'+
					'<div class="modal-content">'+
						'<div class="modal-header">'+
							'<div class="modal-body">'+
								'<form class="row" action="#" onsubmit="return colorbox(this)">' +
									'<div class="form-group col-sm-10">' +
										'<input type="text" class="form-control" placeholder="Type image name" /> '+
									'</div>' +
									'<div class="form-group col-sm-2">' +
										'<button class="button search__image">Search</buton>'+
									'</div>' +
								'</form>' +
								'<div id="cb_images"></div>' +
							'</div>'+
							'<div class="modal-footer">'+
								'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>';

		$('body').append(modal);

		// var ts = new Date();
		// var cred = {
		// 	'hmac': hmac,
		// 	'username': 'jh@onprint.dk',
		// 	'password': 'uthceag7',
		// 	'key': 'beEVhMCruAedMmWiVzXts4fu5cWG2AAMtlXpaKGNG3Z0gm0UYYM8WXyD0Z5dJ3fd',
		// 	'ts': <?=time()?>,
		// 	// 'secret': '2cmLnxZvaHbueHcpLzFEAEnHBbF5cNPEn53n8VWWGMtQPCNOiqnl2vBeMw1EiaXJ',
		// }

		// console.log()

		// $.ajax({
		// 	dataType: 'json',
		// 	type: 'POST',
		// 	url: 'https://api.colourbox.com/authenticate/userpasshmac',
		// 	data: JSON.stringify(cred),
		// 	success: function(data) {
		// 		console.log(data)
		// 	}
		// })


	});


})(jQuery)
</script>