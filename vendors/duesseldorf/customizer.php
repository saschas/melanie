<?php
/**
 * Feature Name:    
 * Version:		    0.1
 * Author:		    Inpsyde GmbH for MarketPress.com
 * Author URI:	    http://inpsyde.com/
 */

/**
 * callback-function to register our social-icon-settings to the customizer
 *
 * @since    0.1
 * @wp-hook customize_register
 *
 * @param   WP_Customize_Manager $wp_customize
 * @return  Void
 */
function dueseldorf_customize_register_add_social_icons( WP_Customize_Manager $wp_customize ){

	$section = 'social_icons_section';

	// adding a new section to the customizer
	$wp_customize->add_section(
		$section,
		array (
			'title'         => __( 'Social Media Icons', 'theme_duesseldorf' ),
			'description'   => __( 'In this Section you can enter your Social-Media-Channels to show them in your Theme.', 'theme_duesseldorf' ),
			'priority'      => 5,
		)
	);

	$settings = duesseldorf_get_social_medias();

	if( !is_array( $settings ) || count( $settings ) < 1 ){
		return;
	}

	foreach( $settings as $id => $setting ) {

		$option_key = $section . '[' . $id . ']';

		// adding a new setting to the database
		$wp_customize->add_setting(
			$id,
			array (
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$control_args = array (
			'label'    => $setting[ 'label' ],
			'section'  => $section,
			'settings' => $id
		);

		$control = new WP_Customize_Control(
			$wp_customize,
			$option_key,
			$control_args
		);

		$wp_customize->add_control( $control );

	}

}




/**
 * Helper function to display the Social Icons from customizer
 *
 * @since    0.1
 * @param   Array $args
 * @return String
 */
function duesseldorf_customizer_get_social_channel_icons( array $args = array() ){

	$default_args   = array(
		'before'        => '<aside class="social-share" id="site-social-icons">',
		'after'         => '</aside>',
		'link'       	=> '<a href="%1$s" title="%2$s" class="social-share-link social-share-link-%3$s" target="_blank">%4$s</a>',
		'link_before'   => '',
		'link_after' 	=> '',
	);

	$rtn = apply_filters( 'pre_duesseldorf_customizer_get_social_channel_icons', FALSE, $args, $default_args );
	if ( $rtn !== FALSE )
		return $rtn;

	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 'duesseldorf_customizer_get_social_channel_icons_args', $args );

	$markup = '';
	$links = array();

	$social_icons = duesseldorf_get_social_medias();
	foreach( $social_icons as $theme_mod => $icon ) {

		$link = get_theme_mod( $theme_mod, '' );

		if( $link !== '' ){

			$markup .=  $args[ 'link_before' ];
			$markup .= sprintf(
				$args[ 'link' ],
				esc_url( $link ),
				esc_attr( $icon[ 'label' ] ),
				$theme_mod,
				$icon[ 'icon' ]
			);
			$markup .= $args[ 'link_after' ];

			$links[ $theme_mod ] = $link;
		}

	}

	if( $markup !== '' ){
		$markup = $args[ 'before' ] . $markup . $args[ 'after' ];
	}

	return apply_filters( 'duesseldorf_customizer_get_social_channel_icons', $markup, $social_icons, $links );
}
