<?php
// The file defines all index page behaviours.

// Grab the header.
get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<!-- main-column area -->
	<div class="main-column">
	
		<?php
		//  Begin *if* statement to decide what to do with/without posts.
		if (have_posts()) :
			while (have_posts()) : the_post();
	
			// Reference to the content.php file. Post layout is pulled from content.php. If there are any special post types, e.g. galleries, the second argument pushes requests to the correct content-*.php file.
			get_template_part('content', get_post_format());
	
			endwhile;
	
			// What to do when there's no content.
			else :
				echo '<p>No content found!</p>';
		
		endif; ?>
		
	</div><!-- /main-column -->

<?php get_sidebar(); ?>
	
</div><!-- /site-content -->

<?php get_footer(); ?>