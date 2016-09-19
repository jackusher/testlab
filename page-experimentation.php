<?php
// The page-experimentation.php file controls the experimental experimentation page.

get_header(); // Load in the WP header.

// Setting the variables which we'll pull into the loop later on.
$parent = get_theme_mod( 'title_section1' ); // Pulling in the parent catgeory set in the WP appearance api.
$parentID = get_cat_ID( $parent ); // Getting the cat ID from the name we pulled in.
$creative_children = get_categories( // Setting the cat as a PARENT cat.
	array( 'parent' => $parentID )
); ?>

<div class="creative-title"><!-- Outputs the title of the parent cat before the masonry container (from WP app. api again). -->
	<?php echo "<h2> Latest in parent " . get_category_by_slug($parent)->name . "</h2>"; ?>
</div><!-- /creative-title -->

<div class="creative-wrapper"><!-- The masonry container. -->

<?php foreach ( $creative_children as $creative_child ) { // foreach loop pulling the latest post in each child cat.
	$args = array(
		'cat' => $creative_child->term_id,
		'post_type' => 'post',
		'posts_per_page' => 1,
		'no_found_rows' => true,
		'ignore_sticky_posts' => true,
	);
	
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	
	while ( $query->have_posts() ) {
	
		$query->the_post(); // This line conjoined to the while statement? ?>
	
		<div class="creative-article"><!-- Start of looped post content. -->
			<div class="creative-thumb">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a>
			</div>
			<div class="creative-info">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<?php the_excerpt(); ?>
			</div>
		</div><!-- /creative-article -->
	
	<?php } // endwhile
	
	} // endif
	
} // endforeach ?>

</div><!-- /creative-wrapper -->

<?php
get_footer(); // Load in the WP footer.
?>