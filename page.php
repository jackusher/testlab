<?php
/**
 * The template for displaying single pages.
 *
 * The pages that are created in Wordpress.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header(); ?>

<div class="site-content clearfix">

	<div class="main-column">

		<?php
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
	
			<article class="post page">
		
				<h2 class="page-title"><?php the_title(); ?></h2>
				<div class="page-body">
					<?php the_content(); ?>
				</div><!-- /page-body -->
				
			</article>
	
			<?php endwhile;
	
			else :
				echo '<p>No content found!</p>';
		
			endif; ?>

	</div><!-- /main-column -->

	<?php get_sidebar(); ?>
	
</div><!-- /site-content -->

<?php get_footer(); ?>