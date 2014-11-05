<?php
/**
 * Default Template for Thank you
 */
?>



<!--// ACF //-->
<?php if( have_rows('start_repeater') ): ?>

	<?php while( have_rows('start_repeater') ): the_row(); 

		// vars
		$type = get_sub_field('art','option');


		$image = get_sub_field('bild');

		// vars
		$url = $image['url'];
		$title = $image['title'];
		$alt = $image['alt'];
		$caption = $image['caption'];


		$link = get_sub_field('link');
		$link_extern = get_sub_field('link_extern');
		$content = get_sub_field('text');

		$blogHelper = get_sub_field('blog');
		$blog = $blogHelper[0];

		$productHelper = get_sub_field('produkt');
		$product = $productHelper[0];
		$große = get_sub_field('große', 'option'); 

		?>

		<!--Grid Row-->
		<div class="grid <?php echo $große.' '.$type;?>">
<?php
		//echo 'Type: '.$type.' '.'Große: '.$große;

		if($type == 'Bild'){
			if(!empty($link)){
				echo '<a href="'.$link.'">';
			}
			else if(!empty($link_extern)){
				echo '<a href="'.$link_extern.'" target="_blank">';
			}
			else{
				
			}

			echo '<img class="lazy" data-original="'.$url.'" alt="'.$alt.'" title="'.$title.'">';
			
			if(!empty($link) || !empty($link_extern)){
				echo '</a>';
			}
				
		}

		if($type == 'Text'){
			if(!empty($link)){
				echo '<a href="'.$link.'">';
			}
			else{
				echo '<a href="'.$link_extern.'" target="_blank">';
			}
				$hintergrundfarbe = get_sub_field('color');
				?>
				<div class="inner" style="background:<?php echo $hintergrundfarbe; ?>">
					<?php echo $content; ?>
				</div>
			</a>

	<?php	
		}
		if($type == 'Blog'){
			
			$post_id = $blog->ID;

			$post_tags = wp_get_post_tags($post_id);
			$post_title = $blog->post_title;
			$post_excerpt = $blog->post_excerpt;
			$post_link = get_permalink( $post_id);

			
			echo get_the_post_thumbnail( $post_id); ?>
			<a href="<?php echo $post_link; ?>" class="post-link">
			<div class="inner_table">
				<div class="inner">
					<h2><? echo $post_title; ?></h2>
					<p><? echo $post_excerpt; ?></p>
				</div>
			</div>
			</a>

<?php } ?>

<?php if($type == 'Produkt'){
	$product_id = $product->ID;
	$product_title = $product->post_title;
	$product_link = $product->guid;
	$product_p = get_post_meta( $product_id, '_price');
	$product_price = get_post_meta( $product_id, '_regular_price');
	$product_sale_price = get_post_meta( $product_id, '_sale_price');
	$product_permalink = get_permalink( $product_id);

	if($große == 'full'){
		echo get_the_post_thumbnail( $product_id,'full');
	}
	else{
		echo get_the_post_thumbnail( $product_id,'large');
	}
	
	
	
	?>

	<a href="<?php echo $product_permalink; ?>" class="post-link">
		<div class="inner_table">
			<div class="inner">
		
				<h2><?php echo $product_title; ?></h2>

				<div class="codeHidden">
					<?php 

					$metaInformation = get_post_meta( $product_id);

					


					?>
				</div>
				<span ><?php 

				if( empty($product_sale_price[0]) ){
					echo $product_price[0];
					}
				if(empty($product_sale_price[0]) && empty($product_price[0])){
				echo $product_p[0];
				}
				else{
					echo $product_sale_price[0];
				}
				 ?>€</span><br/>
				<span class="mwst">inkl. Mwst.</span>
			</div>
		</div>

	</a>
<?php
}
?>
</div>




	<?php endwhile; ?>
<?php endif; ?>
