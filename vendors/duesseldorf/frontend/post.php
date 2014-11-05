<?php
/**
 * Feature Name:    Post Functions for Duesseldorf-Theme
 * Version:		    0.1
 * Author:		    Inpsyde GmbH for MarketPress.com
 * Author URI:	    http://inpsyde.com/
 */


/**
 *  Paginated posts navigation. Used instead of next_posts()/previous_posts(). Displays an unordered list.
 *
 * @since      0.1
 *
 * @param       Array $args
 * @global      $wp_query
 * @return      String
 */
function duesseldorf_get_posts_pagination( Array $args = array() ) {
	global $wp_query;

	$paginated = $wp_query->max_num_pages;

	if ( $paginated < 2 )
		return '';

	$default_args   = array(
		'base' 		=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 	=> '',
		'current' 	=> max( 1, get_query_var( 'paged' ) ),
		'total' 	=> $wp_query->max_num_pages,
		'mid_size' 	=> 2,
		'type' 		=> 'list',
		'prev_text'	=> sprintf(
			'<span title="%s">‹</span>',
			__( 'Previous', 'theme_duesseldorf' )
		),
		'next_text'	=> sprintf(
			'<span title="%s">›</span>',
			__( 'Next', 'theme_duesseldorf' )
		),
	);

	$rtn = apply_filters( 'pre_duesseldorf_get_posts_pagination', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 'duesseldorf_get_posts_pagination_args', $args );

	$output = paginate_links( $args );

	return apply_filters( 'duesseldorf_get_posts_pagination', $output, $args );

}


/**
 * Callback for the excerpt_more
 *
 * @since	0.1
 *
 * @wp-hook excerpt_more
 *
 * @param   Integer $length
 * @return  String
 */
function duesseldorf_filter_excerpt_more( $length ) {

	global $post;

	$markup     = '<p><a href="%s" title="%s" class="more-link">%s</a></p>';
	$link       = get_permalink();
	$title_attr = esc_attr( $post->title );
	$title      = _x( 'Continue&#160;reading&#160;&#8230;', 'More link text', 'theme_duesseldorf' ); // hard space + […]
	$output  = '&#160;[&#8230;] ';
	$output .= sprintf(
		$markup,
		$link,
		$title_attr,
		$title
	);

	return $output;
}


/**
 * Adding an Paragraph arround the more-text for the_content()
 *
 * @since    0.1
 *
 * @wp-hook the_more_link
 * @param   String $more_text
 * @return  String $more_text
 */
function duesseldorf_filter_the_content_more_link_add_paragraph( $more_text ){
	return '<p>' . $more_text . '</p>';
}

/**
 * Adding a helper class to the post-wrapper
 *
 * @since   0.1
 *
 * @wp-hook post_class
 *
 * @param   array $classes
 * @return  array $classes
 */
function duesseldorf_filter_post_class( Array $classes = array() ) {
	$classes[] = 'site-entry';
	return $classes;
}

/**
 * Building the Share Links for our Posts
 *
 * @param   Array $args
 * @return  String
 */
function duesseldorf_get_post_share_links( Array $args = array() ){

	$default_args = array(
		'before'        => '<aside class="social-share">',
		'after'         => '</aside>',
		'before_link'   => '',
		'after_link'    => '',
		'link'          => '<a href="%1$s" title="%2$s">%3$s</a>'
	);

	$rtn = apply_filters( 'pre_duesseldorf_get_post_share_links', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 'duesseldorf_get_post_share_links_args', $args );

	$the_permalink = get_permalink();
	$markup = '';

	$networks = duesseldorf_get_social_medias();

	foreach ( $networks as $network ) {

		if( !array_key_exists( 'share_link', $network ) || empty( $network[ 'share_link' ] ) ) {
			continue;
		}

		$link   = sprintf( $network[ 'share_link' ], $the_permalink );
		$title  = sprintf(
			_x( 'Share on %s', 'The Share-Link in duesseldorf_get_post_share_links', 'theme_duesseldorf' ),
			ucfirst( $network[ 'label' ] )
		);

		$markup .= $args[ 'before_link' ];
		$markup .= sprintf(
			$args[ 'link' ],
			esc_url( $link ),
			esc_attr( $title ),
			$network[ 'icon' ],
			'target="_blank"'
		);
		$markup .= $args[ 'after_link' ];
	}

	if( $markup !== '' ) {
		$markup = $args[ 'before' ] . $markup . $args[ 'after' ];
	}

	return apply_filters( 'duesseldorf_get_post_share_links', $markup, $args );
}

/**
 * adding support for our lightbox-script on wp gallery and some better markup.
 *
 * @since   0.1
 * @wp-hook post_gallery
 *
 * @param   String $output
 * @param   Array  $attr
 *
 * @return  String
 */
function duesseldorf_filter_post_gallery( $output = '', $attr ) {
	$post = get_post();
	$attr = shortcode_atts(
		array(
            'order'     => 'ASC',
            'orderby'   => 'menu_order ID',
            'id'        => $post->ID,
            'itemtag'   => 'div',
            'icontag'   => 'figure',
            'captiontag'=> 'figcaption',
            'columns'   => 4,
            'size'      => 'thumbnail',
            'include'   => '',
            'exclude'   => '',
		    'link'      => '',
        ),
		$attr
	);

	if ( $attr[ 'order' ] === 'RAND' ) {
		$attr [ 'orderby' ] = 'none';
	}

	// setting the post_args
	$post_args = array(
		'post_status'   => 'inherit',
		'post_type'     => 'attachment',
		'post_mime_type'=> 'image',
		'order'         => $attr[ 'order' ],
		'orderby'       => $attr[ 'orderby' ]
	);

	if ( !empty( $attr[ 'include' ] ) ) {
		// normal gallery-shortcode
		$post_args[ 'include' ] = $attr[ 'include' ];
	}
	elseif ( !empty( $attr[ 'exclude' ] ) ) {
		// with excludes and all children
		$post_args[ 'post_parent' ] = $attr[ 'id' ];
		$post_args[ 'exclude' ]     = $attr[ 'exclude' ];
	}
	else {
		// without excludes, all children
		$post_args[ 'post_parent' ] = $attr[ 'id' ];
	}

	$attachments   = get_posts( $post_args );
	// no attachments found or feed -> go back to normal shortcode-callback
	if ( empty( $attachments ) || is_feed() ){
		return '';
	}

	$output = '<div id="gallery-' . $attr[ 'id' ] . '" class="gallery columns-' . $attr[ 'columns' ] . ' clearfix">';

	foreach ( $attachments as $key => $attachment ) {

		$image_meta  = wp_get_attachment_metadata( $attachment->ID );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) )
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

		$output .= "<" . $attr[ 'itemtag' ] . " class='gallery-item-container column-item'>";
		$output .= "<" . $attr[ 'icontag' ] . " class='gallery-figure {$orientation}'>";

		if ( $attr[ 'link' ] === 'file' ) {

			// link to attachment-file
			$link   = wp_get_attachment_url( $attachment->ID );

			$img    = wp_get_attachment_image(
				$attachment->ID,
				$attr[ 'size' ]
			);

			// we've have to set the class "gallery-item" for our lightbox-like gallery.
			$output .= '<a class="gallery-item" href="' . $link . '">' . $img . '</a>';
		}
		elseif ( $attr[ 'link' ] === 'none' ) {
			$output .= wp_get_attachment_image(
				$attachment->ID,
				$attr[ 'size' ],
				false
			);
		}
		else {
			$output .= wp_get_attachment_link(
				$attachment->ID,
				$attr[ 'size' ],
				true // no permalink
			);
		}

		if ( $attr[ 'captiontag' ] && trim( $attachment->post_excerpt ) ) {
			$output .= "<" . $attr[ 'captiontag' ] . " class='wp-caption-text gallery-figcaption'>" . wptexturize($attachment->post_excerpt) . "</" . $attr[ 'captiontag' ] . ">";
		}

		$output .= "</" . $attr[ 'icontag' ] . ">";
		$output .= "</" . $attr[ 'itemtag' ] . " >";
	}

	$output .= "</div>";

	return $output;
}