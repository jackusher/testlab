<?php
//search.php defines the content and layout of a search results page. Essentially the output part of seachform.php.

get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<!-- main-column area -->
	<div class="main-column">

		<?php
		if (have_posts()) : ?>
	
			<!-- Include an h2 title of the search terms. -->
			<h2>Search results for: <?php the_search_query(); ?></h2>

			<?php
			while (have_posts()) : the_post();
	
			// Reference to the content.php file. Post layout is pulled from content.php. If there are any special post types, e.g. galleries, the second argument pushes requests to the correct content-*.php file.
			get_template_part('content', get_post_format());
	
			endwhile;
	
			// What to do if there's no content.
			else :
				echo '<p>No content found!</p>';
		
			endif;?>
			
	</div><!-- /main-column -->

	<?php get_sidebar(); ?>
	
</div><!-- /site-content -->

<?php get_footer(); ?>