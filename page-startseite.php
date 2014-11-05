<?php
/*
Template Name: Startseite
*/

get_header();
?>

<main id="site-content">
	<div id="site-content-inner" class="exclude">
		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'parts/content', 'page-startseite' );

		endwhile;
		?>
	</div>
</main>

<?php
get_footer();