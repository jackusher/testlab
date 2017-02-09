<?php
// The archive.php file. This file dictates the behaviour of all Wordpress archive files.

get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<!-- main-column area -->
	<div class="main-column"><?php

		// Begin the PHP *if* statement, defining behaviour with/without posts. 
		if (have_posts()) :

			// Defining what to do (ie. the title) with each type of category archive.	
			if ( is_category() ) {
				?><section class="cat-archive-title"><h2><?php single_cat_title(); ?></h2></section><?php
			} elseif ( is_tag () ) {
				?><section class="tag-archive-title"><h2><?php single_tag_title(); ?></h2></section><?php
			} elseif ( is_author() ) {
				the_post();
				?><section class="author-archive-title"><h2><?php echo 'Author Archives: ' . get_the_author(); ?></h2></section><?php
				rewind_posts();
			} elseif ( is_day() ) {
				?><section class="day-archive-title"><h2><?php echo 'Daily Archives: ' . get_the_date(); ?></h2></section><?php
			} elseif ( is_month() ) {
				?><section class="month-archive-title"><h2><?php echo 'Monthly Archives: ' . get_the_date('F Y'); ?></h2></section><?php
			} elseif ( is_year() ) {
				?><section class="year-archive-title"><h2><?php echo 'Yearly Archives: ' . get_the_date('Y'); ?></h2></section><?php
			} else {
				echo 'Archives:';
			}

		// Pagination code here. ?>
	
		<div id="archive-content" class="front-content"><?php

			while (have_posts()) : the_post();

			// Reference to the content.php file. Post layout is pulled from content.php. If there are any special post types, e.g. galleries, the second argument pushes requests to the correct content-*.php file.
			get_template_part('content', get_post_format());

			endwhile;

			// What to do if no posts exist in the archive.
			else :
				echo '<p>No content found!</p>';

			endif; 

			wp_reset_postdata(); ?>

		</div><!-- /front-content -->
		
	</div><!-- /main-column -->
	
	<?php get_sidebar(); ?>

</div><!-- /site-content -->

<?php
get_footer();
?>