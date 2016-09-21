<?php
// The page-experimentation.php file controls the experimental experimentation page.

get_header(); // Load in the WP header.

// Setting the variables which we'll pull into the loop later on.
$parent = get_theme_mod( 'title_section1' ); // Pulling in the parent catgeory set in the WP appearance api.
$parentID = get_cat_ID( $parent ); // Getting the cat ID from the name we pulled in.
$creative_children = get_categories( // Setting the cat as a PARENT cat.
	array( 'parent' => $parentID )
); ?>

<div class="creative-head clearfix"><!-- Outputs the title of the parent cat before the masonry container (from WP app. api again). -->
	<div class="creative-title"><?php echo "<h2>" . get_category_by_slug($parent)->name . "</h2>"; ?></div>
	<div class="creative-subcats"><?php
		wp_list_categories( array( // Creating an li for each of the subcats in the parent.
			'orderby' => 'id',
			'show_count' => false,
			'title_li' => '',
			'use_dec_for_title' => false,
			'child_of' => $parentID
		) );
	?></div>
</div><!-- /creative-head -->

<div class="creative-wrapper"><!-- The masonry container. -->

	<?php $counter=1; // Creating a counter for the foreach loop.

	foreach ( $creative_children as $creative_child ) : // foreach loop pulling the latest post in each child cat.
	
	$args = array( // args for the WP_Query.
		'cat' => $creative_child->term_id,
		'post_type' => 'post',
		'posts_per_page' => 1,
		'no_found_rows' => true,
		'ignore_sticky_posts' => true,
	);
	
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
	
		while ( $query->have_posts() ) : $query->the_post(); ?>
	
			<div class="creative-article"><!-- Start of looped post content. -->
			
				<div class="creative-thumb"><!-- Thumbnails, including countpost logic. --><?php
					if($counter==1) { ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('left-creative'); ?></a><?php
					} else { ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
					} ?>
				</div><!-- /creative-thumb -->
				
				<div class="creative-info"><!-- Post titles and excerpts. -->
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php
					if($counter==5) { // Can we integrate this on to one line (ie. $counter==5&6&7)?
					
					} elseif($counter==6) {
					
					} elseif($counter==7) {
					
					} else {
						the_excerpt();
					}?>
				</div><!-- /creative-info -->
			
				<div class="creative-cat"><!-- Post categories. -->
					<span class="cat-cat">
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
				</div><!-- /creative-cat -->
			
			</div><!-- /creative-article --><?php
		
		endwhile;
	
		else :
			echo '<p>No content found!</p>';
	
	endif;

	$counter++;
	
	endforeach; ?>

</div><!-- /creative-wrapper -->

<?php wp_reset_postdata();

get_footer(); // Load in the WP footer.
?>