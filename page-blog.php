<?php
/*
Template Name: Blog
*/

get_header();
?>

<main id="site-content">
	<div id="site-content-inner">
		<?php 

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 'post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged,'cat' => '-13' );
			$wp_query = new WP_Query($args);
			while ( have_posts() ) : the_post();

				get_template_part( 'parts/content', 'page-blog' );



			 endwhile; ?>
			<!-- then the pagination links -->
			<div class="pagination-link">
				<?php next_posts_link( '&larr; Ältere Posts', $wp_query ->max_num_pages); ?>
				<?php previous_posts_link( 'Neuere Posts &rarr;' ); ?>
			</div>
	</div>
</main>
<?php get_sidebar( $name ); ?>
<?php
get_footer();