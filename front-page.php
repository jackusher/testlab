<?php
// The file defines the static home page behaviours.

// Grab the header.
get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<div id="ms-wrapper"><!-- The container masonry element. All mason blocks go in here. -->
	
		<?php // Arguments for the WP query to pull in the latest post from each category.
		$categories = get_categories();
	
		foreach ( $categories as $category ) {
			$args = array( // Running the query arguments through each category on the site.
				'cat' => $category->term_id,
				'post_type' => 'post',
				'posts_per_page' => '1'
			);
	
		$query = new WP_Query( $args ); // Running the new WP_Query using the arguments defined above.
	
		if ( $query->have_posts() ) { ?>
		
			<div id="ms-item">
				<?php while ( $query->have_posts() ) {
		
					$query->the_post();
					?>
			
				<!-- post-thumbnail behaviour. Creating a div for the image, and calling a pre-defined image size. Putting a link in. -->
				<div class="ms-thumbnail">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('masonry-thumbnail'); ?></a>
				</div><!-- /ms-thumbnail -->
			
				<div class="ms-info">
					<p class="ms-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					<span class="subtle-category">Posted in
						<?php
						$categories = get_the_category();
						$separator = ", ";
						$output = '';
						if ($categories) {
							foreach ($categories as $category) {
								$output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;
							}
							echo trim($output, $separator);
						}
						?>
					</span>
				</div>

				<?php } // endwhile ?>
	
			</div><!-- /ms-item --><?php
	
		} // endif
	
		} // end foreach category script.
	
		// Use reset to restore original query.
		wp_reset_postdata(); ?>

	</div><!-- /ms-wrapper -->

	<!-- main-column area -->
	<div class="main-column">

		<?php
		//  The Loop to pull in the page text content, defined in the wp admin page properties.
		if (have_posts()) :
			while (have_posts()) : the_post();
			
			the_content();
			
			endwhile;
			// What to do when there's no content.
			else :
				echo '<p>No content found!</p>';
		endif; ?>
		
		<!-- home-columns -->
		<div class="home-columns clearfix">
		
			<!-- front-section1; full-width custom category area. -->
			<div class="front-section1">
				<?php // Reference to content-column-1.php to pull in the front page section 1 content.
				get_template_part('content', 'column-1'); ?>
			</div><!-- /front-section1 -->
			
			<!-- front-section2 -->
			<div class="front-section2">
				<?php // Reference to content-column-2.php to pull in the front page section 2 content.
				get_template_part('content', 'column-2'); ?>
			</div><!-- /front-section2 -->
			
			<!-- front-section3 -->
			<div class="front-section3">
				<?php // Reference to content-column-3.php to pull in the front page section 3 content.
				get_template_part('content', 'column-3'); ?>
			</div><!-- /front-section3 -->
		
		</div><!-- /home-columns clearfix -->

	</div><!-- /main-column -->

	<!-- Getting the secondary column. -->
	<?php get_sidebar(); ?>
	
</div><!-- /site-content -->

<?php
// Grab the footer.
get_footer();
?>