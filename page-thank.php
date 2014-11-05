<?php
/*
Template Name: Thank you
*/

get_header();
?>

<main id="site-content">
	<div id="site-content-inner" class="exclude">
		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'parts/content', 'page-thank' );

		endwhile;
		?>
	</div>
	<?php echo do_shortcode('[instagram-feed]'); ?>
</main>

<?php
get_footer();