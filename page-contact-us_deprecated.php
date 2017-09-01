<?php
/**
 * The template for the Contact Us page.
 *
 * This file is a template for a single page.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header();

if (have_posts()) :
	while (have_posts()) : the_post(); ?>
	
	<article class="post page">
		
		<div class="column-container clearfix">
		
			<div class="title-column">
				<h2><?php the_title(); ?></h2>
			</div><!-- /title-column -->
			
			<div class="text-column">
				<?php the_content(); ?>
			</div><!-- text-column -->
		
		</div><!-- /column-container -->
		
	</article>
	
	<?php endwhile;
	
	else :
		echo '<p>No content found!</p>';
		
	endif;

get_footer(); ?>