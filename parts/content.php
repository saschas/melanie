<?php
/**
 * Default content renderer
 *
 * @package    Duesseldorf\Parts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>

	<header class="site-entry-header">
		
		<h1><?php the_title(); ?></h1>
		<?php get_template_part( 'parts/entry', 'meta' ); ?>
	</header>

	<div class="site-entry-content">
		<?php		 the_content(); ?>
		<?php
		/**
		* This is where post content can optionally be sliced
		* into pages with the <!--nextpage--> tag.
		*/
		wp_link_pages(
			array(
				'before' => '<nav class="site-page-link">' . _x( '<span>Pages:</span>', 'Prefix for content pagination', 'theme_duesseldorf' ),
				'after'  => '</nav>'
			)
		);
		?>
	</div>

    <?php
	/**
	 * including the pagination for prev / and Page
	*/
	get_template_part( 'parts/pagination', 'single' );
	?>

</article>