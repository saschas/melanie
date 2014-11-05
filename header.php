<?php
/**
 * Header Template file
 *
 * @package    Duesseldorf
 */
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="no-js ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="http://hellopetersen.com/wp-content/themes/duesseldorf-child/favicon.ico">
	<title><?php wp_title( '|', TRUE, 'right' ); ?></title>
	<meta name="application-name" content="<?php bloginfo( 'blogname' ); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta property="og:image" content="<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post'); echo $thumb[0]; ?>"/>
<meta property="og:image:secure_url" content="https://secure.example.com/ogp.jpg" />
	<?php if ( is_singular() && comments_open() ) :
		wp_enqueue_script( 'comment-reply' );
	endif; ?>
	<?php echo duesseldorf_get_favicon(); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30996892-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<div class="mobile-logo"><a href="<?php  echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/petersen-logo.png' ;?>" alt="<?php echo esc_attr( $blog_name ); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo (int)$custom_header->height; ?>" /></a></div>
<div id="site" class="clearfix">

	<?php
	/**
	 * include the left sidebar with logo and navigation
	 */
	get_sidebar( 'left' );
	?>
	
	<div id="site-meta" class="clearfix">
		<div id="site-meta-inner" class="clearfix">
			<?php
			/**
			 * Includes the meta header template.
			 */
			get_template_part( 'parts/header', 'meta' );


			/**
			 * includes the header navigation
			 */
			get_template_part( 'parts/navigation', 'header' );
			?>
		</div>
	</div>

	<?php if( class_exists( 'Woocommerce' ) ): ?>
		<?php woocommerce_demo_store(); ?>
	<?php endif; ?>

	<div id="site-main" class="clearfix">
	
		<?php echo duesseldorf_get_breadcrumbs(); ?>