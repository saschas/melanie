<?php
/*
Template Name: Presse
*/

get_header();
?>

<main id="site-content">
	<div id="site-content-inner" class="exclude">
		<?php 

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 'post_type' => 'post', 'posts_per_page' => 99, 'paged' => $paged,'cat' => '13' );
			$wp_query = new WP_Query($args);
			while ( have_posts() ) : the_post();

				get_template_part( 'parts/content', 'presse' );

			 endwhile; ?>
			
			
	</div>
	<!-- then the pagination links -->
	<div class="pagination-link">
				<?php next_posts_link( '&larr; Ältere Presse', $wp_query ->max_num_pages); ?>
				<?php previous_posts_link( 'Neuere Presse &rarr;' ); ?>
			</div>
</main>
<?php get_sidebar( $name ); ?>
<?php
get_footer();