<?php
/**
 * Single Product Image
 *
 * @package    Duesseldorf\WooCommerce\Single-Product
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>

<div class="site-product-images-featured">
	<?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			
			$big_image_link = wp_get_attachment_image_src( get_post_thumbnail_id(),'full', 'big-zoom-image' );
			$big_image_link = $big_image_link[ 0 ];
			
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, 'medium', array(
				'title'         => $image_title,
				'class'         => 'site-product-image-featured',
				'data-zoom-img' => $big_image_link
			) );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 
				'woocommerce_single_product_image_html', 
				$image, $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>
</div>

<?php do_action( 'woocommerce_product_thumbnails' ); ?>

