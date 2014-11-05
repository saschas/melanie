<?php
/**
 * Feature Name:    Attachment Helper Functions for WooCommerce-Theme
 * Version:		    0.1
 * Author:		    Inpsyde GmbH for MarketPress.com
 * Author URI:	    http://inpsyde.com/
 */

/**
 * Manipulates the size of the image to the  defaults
 *
 * @param   Array $size
 * @return  Array
 */
function duesseldorf_woocommerce_get_image_size_shop_single( Array $size = array() ) {
	
	$size = array(
		'width'  => '600',
		'height' => '800',
		'crop'   => 1
	);
	
	return $size;
}

/**
 * Manipulates the size of the image to the  defaults
 * This size is used on the archive pages
 *
 * @param   Array $size
 * @return  Array
 */
function duesseldorf_woocommerce_get_image_size_shop_catalog( Array $size = array() ) {
	
	$size = array(
		'width'  => '600',
		'height' => '800',
		'crop'   => 1
	);
	
	return $size;
}

/**
 * Manipulates the size of the image to the theme defaults
 * This size is used on the gallery previews and widgets
 *
 * @param   Array $size
 * @return  Array
 */
function duesseldorf_woocommerce_get_image_size_shop_thumbnail( Array $size = array() ) {
	
	$size = array(
		'width'  => '80',
		'height' => '95',
		'crop'   => 1
	);
	
	return $size;
}

/**
 * Register some more image sizes for woocommerce
 *
 * @return  void
 */
function duesseldorf_woocommerce_register_image_sizes() {

	$default_sizes = array(
		'featured-image' => array( 'width' => 600, 'height' => 800, 'crop' => TRUE ),
		'big-zoom-image' => array( 'width' => 1024, 'height' => 800, 'crop' => TRUE ),
		'small-gallery-image' => array( 'width' => 150, 'height' => 230, 'crop' => TRUE ),
	);
	$default_sizes = apply_filters( 'duesseldorf_woocommerce_image_sizes', $default_sizes );

	foreach ( $default_sizes as $id => $args )
		add_image_size( $id, $args[ 'width' ], $args[ 'height' ], $args[ 'crop' ] );
}