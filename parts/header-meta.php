<?php
/**
 * The Header Meta witch search, menu-toggle, cart
 *
 * @package    Duesseldorf\Parts
 */
?>

<a id="site-sidebar-toggle" href="#site-sidebar-left">
	<?php echo duesseldorf_get_icon( 'bars', array( 'fa-inverse' ) ); ?>
	<?php _e( 'Menu', 'theme_duesseldorf' ); ?>
</a>

<?php if ( class_exists( 'Woocommerce' ) && function_exists( 'duesseldorf_woocommerce_get_mini_cart' ) ) : ?>
<div id="site-woocommerce-mini-cart" aria-live="polite">
	<?php echo duesseldorf_woocommerce_get_mini_cart(); ?>
</div>
<?php endif;