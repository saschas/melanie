<?php
/**
 * entry description template with author, date, category-list
 *
 * @package    Duesseldorf\Parts
 */
?>


<p class="site-entry-meta">

	<?php
	/*// the edit post_link
	$edit_post_link_text = sprintf(
		_x( '[%s Edit]', 'The Edit Post-Link with Placeholder for Edit Icon', 'theme_duesseldorf' ),
		duesseldorf_get_icon( 'edit' )
	);
	edit_post_link( $edit_post_link_text, '<span><strong>', '</strong> | </span>');
*/
	// the time
	printf(
		'<span class="site-entry-time"> <time itemprop="datePublished" datetime="%s">%s</time></span>',
		esc_attr( get_the_date( 'YY' ) ),
		get_the_date()
	);


	

	/*// the author
	printf(
		'<span itemprop="author">' . duesseldorf_get_icon( 'user' ) . ' %s</span> | ',
		get_the_author()
	);*/
	/*
	if ( comments_open() ) : ?>
		<span class="site-entry-comments-link">
			<a href="<?php echo get_comments_link(); ?>" title="<?php echo esc_attr( __( 'Comments', 'theme_duesseldorf' ) );?>">
				<?php echo duesseldorf_get_icon( 'comments' ) . ' ' . get_comments_number(); ?>
			</a>
		</span> |
	<?php

	endif;

	// the categories
	$category_list = get_the_category_list( ' / ' );
	if( $category_list !== '' ) {
		printf(
			'<span class="site-entry-categories">' . duesseldorf_get_icon( 'tags' ) . ' %s</span>',
			$category_list
		);
	}
*/
	?>
</p>
