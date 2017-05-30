<?php
/**
 * The template for search output pages.
 *
 * The site page that lists the posts matched to user search queries.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header(); ?>

<div class="site-content clearfix">

	<div class="main-column">

		<?php if (have_posts()) : ?>
	
			<h2>Search results for: <?php the_search_query(); ?></h2>

			<?php while (have_posts()) : the_post();
	
			get_template_part('content', get_post_format());
	
			endwhile;
	
			else :
				echo '<p>No content found!</p>';
		
			endif;?>
			
	</div><!-- /main-column -->

	<?php get_sidebar('singlepage'); ?>
	
</div><!-- /site-content -->

<?php get_footer(); ?>