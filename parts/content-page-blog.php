<?php
/**
 * Default Template for Blogposts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>

	<div class="site-entry-content-box">

		<header class="site-entry-header">
		
			<time><?php the_date(); ?></time>
			<h1><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
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


	</div>

</article>