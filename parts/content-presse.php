<?php
/**
 * Default content renderer
 *
 * @package    Duesseldorf\Parts
 */
?>
<!--pressetest-->

<div class="grid half presse" id="post-<?php the_ID(); ?>">


	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>">
		<?php 
			echo get_first_image();
		?>
	</a>
	<?php endif; ?>
	<a href="<?php the_permalink(); ?>" class="post-link">
	<div class="inner_table">
		<div class="inner">
			<?php get_template_part( 'parts/entry', 'meta' ); ?>
			<h2><?php the_title(); ?></h2>
			
			<p><?php the_excerpt(); ?></p>
			

			<!--?php echo duesseldorf_get_post_share_links(); ?-->
		</div>
	</div>
	</a>
</div>