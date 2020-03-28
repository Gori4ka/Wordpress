<?php
////////////////function.php ////////////////////////

add_action('woocommerce_before_calculate_totals', 'set_custom_price');

function set_custom_price($cart_obj) {
    foreach ($cart_obj->get_cart() as $key => $cart_item) {
      $delivery_price = get_post_meta($cart_item['variation_id'], $key, true);
      $price = get_post_meta($cart_item['product_id'] , '_price', true);
        if ($delivery_price && $delivery_price != 'free') {
            $new_price = $price + $delivery_price;
            $cart_item['data']->set_price($new_price);
            $new_price = $cart_item['data']->get_price();
        }
    }
}


add_action( 'wp_ajax_woocommerce_add_to_cart_variable_rc','woocommerce_add_to_cart_variable_rc_callback' );
function woocommerce_add_to_cart_variable_rc_callback() {
    $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $delivery_price = $_POST['delivery_price'] ? $_POST['delivery_price'] : '';
    $quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
    $variation_id = $_POST['variation_id'];
    $variation  = $_POST['variation'];
    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
    if ( $passed_validation && $cart_hash = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation  ) ) {

        if($delivery_price && $delivery_price != 'free'){
            update_post_meta($variation_id, $cart_hash, $delivery_price);
        }
        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
            wc_add_to_cart_message( $product_id );
        }

        WC_AJAX::get_refreshed_fragments();


    } else {
        //$this->json_headers();
        header('Content-Type: application/json');

    $data = array(
        'error' => true,
        'product_url' => apply_filters(  'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
        );
        echo json_encode( $data );
     }

        die();
}
?>

	<!--    ajax code         -->

<script type="text/javascript">
	(function($) {
		$( document ).on( 'click', '.single_add_to_cart_button', function(e) {
			e.preventDefault();
			var variation = {};
	        var var_id = $('.variation_id').attr('value')
	        var product_id = $('.product_id').attr('value')
					var quantity = $('#total_qty.qty').html()
					$('select.var_sels').each(function(e, val) {
						variation[$(this).attr('name')] = $(this).val();
					})

	        var data = {
	            action: 'woocommerce_add_to_cart_variable_rc',
	            product_id: product_id,
	            quantity: quantity,
	            variation_id: var_id,
	            variation: variation
	        };

	        jQuery.post( openwatch_ajax_url, data, function( response ) {
							//$('.variations_form.cart').submit();
							location.href = "/cart";
	            var fragments = response.fragments;
	            if ( fragments ) {
	                $.each(fragments, function(key, value) {
	                    $(key).replaceWith(value);
	                });
	            }
	        });

		})
	} )( jQuery );
</script>
