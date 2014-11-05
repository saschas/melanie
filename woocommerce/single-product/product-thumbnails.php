<?php
/**
 * Single Product Thumbnails
 *
 * @package    Duesseldorf\WooCommerce\Single-Product
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( count( $attachment_ids ) < 1 ) {
	return;
}
?>
<div class="site-product-images-thumbnails">
	<?php
	$loop = 0;
	$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

	foreach ( $attachment_ids as $attachment_id ) {

		$classes = array( 'gallery-item' );

		if ( $loop == 0 || $loop % $columns == 0 )
			$classes[] = 'first';

		if ( ( $loop + 1 ) % $columns == 0 )
			$classes[] = 'last';

		$big_thumbnail_link = wp_get_attachment_image_src( $attachment_id, 'full','shop_single' );
		$big_thumbnail_link = $big_thumbnail_link[ 0 ];

		if ( ! $big_thumbnail_link )
			continue;

		$image_link = wp_get_attachment_image_src( $attachment_id, 'full' );
		$image_link = $image_link[ 0 ];

		$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), FALSE, array( 'class' => 'site-product-image' ) );
		$image_class = esc_attr( implode( ' ', $classes ) );
		$image_title = esc_attr( get_the_title( $attachment_id ) );

		$html_thumb = sprintf(
			'<a href="%s" class="%s" title="%s" data-zoom-img="%s">%s</a>',
		    $big_thumbnail_link,
		    $image_class,
		    $image_title,
		    $image_link,
		    $image
		);
		echo '<!--test-->';
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html_thumb, $attachment_id, $post->ID, $image_class );

		$loop++;
	}
	?>
</div>