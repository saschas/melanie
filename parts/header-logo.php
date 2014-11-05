<?php
/**
 * The Header Logo
 *
 * @package    Duesseldorf\Parts
 */


$blog_name          = get_bloginfo( 'name', 'display' );
$blog_description   = get_bloginfo( 'description', 'display' );
$header_image       = get_header_image();
$custom_header      = get_custom_header();
$home_url           = home_url( '/' );

if( $header_image ){
	$css_class = 'site-logo-with-image';
}
else {
	$css_class = 'site-logo-with-text';
}
?>

<div id="site-logo" class="<?php echo $css_class; ?> clearfix" role="banner">
	<a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( $blog_description ); ?>" rel="home" class="header-logo">
		<?php if ( $header_image ) : ?>
			<img src="<?php echo esc_url( $custom_header->url );?>" alt="<?php echo esc_attr( $blog_name ); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo (int)$custom_header->height; ?>" class="header-logo" />
		<?php else :
			echo $blog_name;
		endif; ?>
	</a>
</div>