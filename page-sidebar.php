<?php
/**
 * Page Template File for Pages with Sidebar.
 *
 * Template Name: Page Sidebar
 *
 * @package    DUESSELDORF
 */

get_header();
?>

<!--test-->
<main id="site-content">
	<div id="site-content-inner" class="exclude">
		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'parts/content', 'page-sidebar' );

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