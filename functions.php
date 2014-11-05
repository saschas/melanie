<?php
/**
 * Functions and definitions for Düsseldorf Child.
 *
 * @package    WordPress
 * @subpackage Düsseldorf_Child
 * @version    1.0
 * @author     marketpress.com
 */

add_action( 'after_setup_theme', 'duesseldorf_child_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features
 * of Düsseldorf Child Theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support for post thumbnails.
 *
 * @since   05/21/2014
 * @return  void
 */
function duesseldorf_child_setup() {

	// Loads the child theme's translated strings
	load_child_theme_textdomain(
		'duesseldorf-child-starter',
		get_stylesheet_directory() . '/languages'
		);

	if( !is_admin() ){

		// styles
		add_filter( 'duesseldorf_get_styles', 'duesseldorf_child_filter_duesseldorf_get_styles_add_stylesheets' );

		// general
		add_filter( 'duesseldorf_get_theme_info', 'duesseldorf_child_filter_duesseldorf_get_theme_info' );

	}
}


/**
 * Adding our own Styles for our Child-Theme
 *
 * @wp-hook duesseldorf_get_styles
 * @param   Array $styles
 * @return  Array $styles
 */
function duesseldorf_child_filter_duesseldorf_get_styles_add_stylesheets( array $styles = array() ) {

	// getting the ".min"-suffix for styles
	$suffix = duesseldorf_get_script_suffix();

	// getting the theme-data
	$theme_data = wp_get_theme();

	// adding our own styles to
	$styles[ 'duesseldorf_child' ] = array(
		'src'       => get_stylesheet_directory_uri() . '/assets/css/style' . $suffix . '.css',
		'deps'      => NULL,
		'version'   => $theme_data->Version,
		'media'     => NULL
		);

	return $styles;

}


//Load custom script

add_action('wp_enqueue_scripts','add_script_function');

function add_script_function() {
	wp_enqueue_script('imagesloaded', get_stylesheet_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js');
	wp_enqueue_script('masonry', get_stylesheet_directory_uri() . '/assets/js/masonry.pkgd.min.js');
	wp_enqueue_script('lazyload', get_stylesheet_directory_uri() . '/assets/js/jquery.lazyload.min.js');
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/assets/js/modernizr.min.js');
	wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/assets/js/custom.js');
}



// Remove Style attributes Images
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	return $html;
}



//Remove Reviews

add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {

	unset($tabs['reviews']);

	return $tabs;
}


//First Image
function get_first_image($id) {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  $attached_image = get_the_post_thumbnail($id, 'post-thumbnail' );
  $image_alt = get_the_title();
  if(empty($attached_image)){
  	if(empty($first_img)){ //Defines a default image
    	$first_img = "/images/default.jpg";
  	}
  	echo '<img  alt="'.$image_alt.'" data-original="'.$first_img.'">';

  }
  else{
  	$imgUrl = wp_get_attachment_url( get_post_thumbnail_id($id) );
  	the_post_thumbnail($id, array( 'data-original' => $imgUrl ) );
  }
  
}

//Exclude Category from CategoryWidget
function exclude_widget_categories($args){
	$exclude = "13"; // The ID of Press
	$args["exclude"] = $exclude;
	return $args;
}
add_filter("widget_categories_args","exclude_widget_categories");



set_post_thumbnail_size( 580, 580 ); // 50 pixels wide by 50 pixels tall, resize mode



add_filter( 'loop_shop_per_page', create_function( '$productCount', 'return 999;' ), 20 );


//Footer Menu

function register_my_menu() {
	register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_my_menu' );


//Show Category Images on Category Archive Page

add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img src="' . $image . '" alt="'. $alt .'" class="categoryImage"/>';
		}
	}
}

/**
 * Adding our own Theme-Info
 *
 * @wp-hook duesseldorf_get_theme_info
 * @param   String $text
 * @return  String $text
 *	 
 *	function duesseldorf_child_filter_duesseldorf_get_theme_info( $text ) {
 *	
 *		$home_url = home_url( '/' );
 *		$home_url = esc_url( $home_url );
 *	
 *		$text = sprintf(
 *			'<p id="site-info">Copyright Melanie Petersen 2014, <a href="%s" rel="nofollow">link</a>.</p>',
 *			$home_url
 *		);
 *	
 *		return $text;
 *	
 *	}
 *	
*/