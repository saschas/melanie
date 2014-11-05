<?php
/**
 * Tempalte for pages with Sidebars but no Pagination
 *
 * @package    Duesseldorf\Parts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>

	<?php if( has_post_thumbnail() ): ?>
		<div class="site-entry-thumbnail">
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
		</div>
	<?php endif; ?>

	<div class="site-entry-content-box">
	
		<header class="site-entry-header">
			<h1><?php the_title(); ?></h1>
		</header>

		<div class="site-entry-content clearfix">
			<?php the_content(); ?>
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

		<?php comments_template(); ?>

	</div>

</article>