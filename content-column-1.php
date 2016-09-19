<?php
// Scaffolding out the front-section-1 of front-page.php.
			
$args = array( // Setting up the arguments for the WP query, inherting the category from the $wp_customize setting.
	'category_name' => get_theme_mod('front_cat_section1'),
	'posts_per_page' => 2,
);
				
$the_query = new WP_Query( $args );

if ($the_query->have_posts()) :
				
echo "<h2> Latest " . get_category_by_slug($args['category_name'])->name . "</h2>"; // Outputting the title of the active category, as per the $wp_customize setting, as <h2>.
					
	$countposts=0; while ($the_query->have_posts()) : $the_query->the_post(); $countposts++; ?> <!-- Using countposts to allow identification of first posts. -->

		<article class="column-post <?php if ( has_post_thumbnail() ) { ?> has-thumbnail clearfix<?php } ?>">
		
			<!-- column-thumbnail behaviour. Creating a div for the image, and calling a pre-defined image size as hyperlink. -->
			<div class="column-thumbnail">
				<?php if($countposts == 1) { // Using countposts to output different image sizes for the first post in the column.
					?> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-level1-column-thumbnail'); ?></a> <?php
				} else { 
					?> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('column-thumbnail'); ?></a> <?php
				} ?>
			</div><!-- /column-thumbnail -->
							
			<!-- Including the basic content of each post. -->
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php the_excerpt(); ?>
			<span class="subtle-date"><?php the_time('F j, Y'); ?></span> <span class="subtle-author">Written by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
	
		</article>
	<?php endwhile;
					
	else :
		echo '<p>No content found!</p>';

endif;

// Run after all custom loops.
wp_reset_postdata();
				
?>