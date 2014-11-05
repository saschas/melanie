<?php
/**
 * Default content renderer
 *
 * @package    Duesseldorf\Parts
 */
?>

<div class="grid half" id="post-<?php the_ID(); ?>">


	<?php if ( has_post_thumbnail() ) : ?>
		<?php 
			echo get_first_image();
		?>
	<?php endif; ?>
	<a href="<?php the_permalink(); ?>" class="post-link">
	<div class="inner_table">
		<div class="inner">

			<h1><?php the_title(); ?></h1>
			
			<?php get_template_part( 'parts/entry', 'meta' ); ?>

			<!--?php echo duesseldorf_get_post_share_links(); ?-->
		</div>
	</div>
	</a>
</div>