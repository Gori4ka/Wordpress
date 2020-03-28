<?php
/**
 * Plugin Name: 	WooCommerce Custom Product Type
 * Plugin URI:		''
 * Description:		A demo plugin on how to add a custom product type.
 */
/**
 * Register the custom product type after init
 */
function register_custom_product_type_product_type() {
	/**
	 * This should be in its own separate file.
	 */
	class WC_Product_custom_product_type extends WC_Product {
		public function __construct( $product ) {
			$this->product_type = 'custom_product_type';
			parent::__construct( $product );
		}
	}
}
add_action( 'plugins_loaded', 'register_custom_product_type_product_type' );
/**
 * Add to product type drop down.
 */
function add_custom_product_type_product( $types ){
	// Key should be exactly the same as in the class
	$types[ 'custom_product_type' ] = __( 'Custom Product Type' );
	return $types;
}
add_filter( 'product_type_selector', 'add_custom_product_type_product' );
/**
 * Show pricing fields for custom_product_type product.
 */
function custom_product_type_custom_js() {
	if ( 'product' != get_post_type() ) :
		return;
	endif;
	?><script type='text/javascript'>
		jQuery( document ).ready( function() {
			jQuery( '.options_group.pricing' ).addClass( 'show_if_custom_product_type' ).show();
		});
	</script><?php
}
add_action( 'admin_footer', 'custom_product_type_custom_js' );
/**
 * Add a custom product tab.
 */
function custom_product_tabs( $tabs) {
	$tabs['custom_product_type'] = array(
		'label'		=> __( 'Custom Product Type', 'woocommerce' ),
		'target'	=> 'custom_product_type_options',
		'class'		=> array( 'show_if_custom_product_type', 'show_if_variable_custom_product_type'  ),
	);
	return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'custom_product_tabs' );
/**
 * Contents of the custom_product_type options product tab.
 */
function custom_product_type_options_product_tab_content() {
	global $post;
	?><div id='custom_product_type_options' class='panel woocommerce_options_panel'><?php
		?><div class='options_group'><?php
			woocommerce_wp_checkbox( array(
				'id' 		=> '_enable_renta_option',
				'label' 	=> __( 'Enable custom_product_type option X', 'woocommerce' ),
			) );
			woocommerce_wp_text_input( array(
				'id'			=> '_text_input_y',
				'label'			=> __( 'What is the value of Y', 'woocommerce' ),
				'desc_tip'		=> 'true',
				'description'	=> __( 'A handy description field', 'woocommerce' ),
				'type' 			=> 'text',
			) );
		?></div>

	</div><?php
}
add_action( 'woocommerce_product_data_panels', 'custom_product_type_options_product_tab_content' );
/**
 * Save the custom fields.
 */
function save_custom_product_type_option_field( $post_id ) {
	$custom_product_type_option = isset( $_POST['_enable_renta_option'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_enable_renta_option', $custom_product_type_option );
	if ( isset( $_POST['_text_input_y'] ) ) :
		update_post_meta( $post_id, '_text_input_y', sanitize_text_field( $_POST['_text_input_y'] ) );
	endif;
}
add_action( 'woocommerce_process_product_meta_custom_product_type', 'save_custom_product_type_option_field'  );
add_action( 'woocommerce_process_product_meta_variable_custom_product_type', 'save_custom_product_type_option_field'  );
/**
 * Hide Attributes data panel.
 */
function hide_attributes_data_panel( $tabs) {
	$tabs['attribute']['class'][] = 'hide_if_custom_product_type hide_if_variable_custom_product_type';
	return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'hide_attributes_data_panel' );


add_action( 'woocommerce_single_product_summary', 'custom_product_type_template', 60 );
function custom_product_type_template () {
	global $product;
	if ( 'custom_product_type' == $product->get_type() ) {
		$template_path = plugin_dir_path( __FILE__ ) . 'templates/';
		// Load the template
		wc_get_template( 'single-product/add-to-cart/custom_product_type.php',
			'',
			'',
			trailingslashit( $template_path ) );
	}
}
