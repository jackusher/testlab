<?php
/**
 * The template for displaying the blog page.
 *
 * The page of the site that lists all of the published posts.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header(); ?>

<div class="content clearfix">

	<div class="left">
	
		<?php

		if (have_posts()) :
			while (have_posts()) : the_post();
	
			get_template_part('content', get_post_format());
	
			endwhile;
	
			else :
				echo '<p>No content found!</p>';
		
		endif; ?>
		
	</div><!-- /left -->

<?php get_sidebar(); ?>
	
</div><!-- /content -->

<?php get_footer(); ?>