<?php
/**
 * The template for the body content on search result pages.
 *
 * The content file referenced from search.php.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
?>
	<div class="result">
	
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php
	
		the_excerpt(); ?>
		
	</div>