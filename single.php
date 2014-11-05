<?php
/**
 * Single Page Template with Sidebar
 *
 * @package    DUESSELDORF
 */

get_header();
?>

<main id="site-content">
	<div id="site-content-inner">

		<?php
		while ( have_posts() ) : the_post();
			/**
			 * Include a template part specific to the Post Format.
			 *
			 * @link http://codex.wordpress.org/Post_Formats
			 */
			$post_format = get_post_format();
			if ( ! $post_format ) {
				$post_format = 'single';
			}
			get_template_part( 'parts/content', $post_format );

		endwhile;
		?>
	</div>
</main>

<?php
/**
 * Includes the right sidebar with widget areas
 */
get_sidebar();
?>

<?php
get_footer();