<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package    Duesseldorf\WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
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
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="site-product-header clearfix">
		<div class="site-product-images clearfix">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10			// removed by theme!
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>
		<div class="site-product-summary">
			<div class="site-product-summary-inner clearfix">
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_show_product_sale_flash - 10 	// added by theme
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40		// removed by theme
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

		<a target="_blank" class="social_fb_share" href="http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=<?php the_permalink();?>&amp;p[images][0]=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post'); echo $thumb[0]; ?>&amp;p[title]=<?php the_title();?>&amp;p[summary]=XXX"><i class="fa fa-facebook " aria-hidden="true"></i></a>
			</div>
		</div>
	</header>

	
	<div class="site-product-content">
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>