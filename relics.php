<?php
/* This file contains all of the self-contained elements that were built for testlab
   during development. PLease refer to the table of contents below for reference.
*/

/* TABLE OF CONTENTS

*/

// 1.a. HTML: Featured image opacity rollover effect grid, capturing all recent posts.?>

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

</div><!-- /ms-wrapper --><?php

// 1.b. CSS: Featured image opacity rollover effect grid, capturing all recent posts.?>

<style> /* Grid CSS for front-page.php latest post grid. */

#ms-wrapper {
	max-width: 100%;
	padding: 5px 0 30px 0;
	border-bottom: 2px solid #DDD;
	margin: 0 0 25px 0;
}

#ms-wrapper:after {
	content: '';
	display: block;
	clear: both;
}

#ms-item {
	float: left;
	display: flex; /* Using flexbox to allow vertical centring of .ms-info content. */
	flex-direction: column;
	justify-content: center;
	resize: vertical;
	margin: 0 5px 5px 0;
	width: 245px;
	height: 184px;
}

#ms-item .ms-thumbnail {
	background-color: black;
}

#ms-item .ms-thumbnail {
	-webkit-transition: all 0.2s ease; /* Safari and Chrome */
  	-moz-transition: all 0.2s ease; /* Firefox */
	-o-transition: all 0.2s ease; /* IE 9 */
	-ms-transition: all 0.2s ease; /* Opera */
	transition: all 0.2s ease;
	position: absolute;
	z-index: 20;
}

#ms-item:hover > .ms-thumbnail {
    -webkit-transform:scale(1.02); /* Safari and Chrome */
	-moz-transform:scale(1.02); /* Firefox */
	-ms-transform:scale(1.02); /* IE 9 */
	-o-transform:scale(1.02); /* Opera */
	transform:scale(1.02);
}

#ms-item .ms-thumbnail img {
	-webkit-transition: all 0.2s linear; /* Safari and Chrome */
  	-moz-transition: all 0.2s linear; /* Firefox */
	-o-transition: all 0.2s linear; /* IE 9 */
	-ms-transition: all 0.2s linear; /* Opera */
	transition: all 0.2s linear;
}

#ms-item:hover img {
	opacity: 0.3;
}

#ms-item .ms-info {
	resize: vertical;
	padding: 0 3px 0 3px;
	z-index: 25;
	visibility: hidden;
	text-align: center;
}

#ms-item .ms-title a {
	text-decoration: none;
	color: #DDD;
	font-size: 1.5em;
}

#ms-item .subtle-category {
	font-size: 0.9em;
}

#ms-item:hover > .ms-info {
	visibility: visible;
} </style><?php



/* 2.a. HTML: Homepage full-width section for latest posts, with magnified first post
        (content-column-1.php). Note that parent div is artifical to keep file neat. */?>

<div><?php
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
wp_reset_postdata();?>

</div><?php

// 2.b. HTML: Inline content call to content-column-1.php, from front-page.php.?>

<div class="front-section1"><!-- front-section1; full-width custom category area. -->
	<?php // Reference to content-column-1.php to pull in the front page section 1 content.
	get_template_part('content', 'column-1'); ?>
</div><!-- /front-section1 --><?php

// 2.c. CSS: Homepage full-width section for latest posts, with magnified first post.?>

<style>

.front-section1 {
	width: 100%;
}

</style><?php

// 2.d. PHP: The WP appearance API integration, from functions.php, for front-section-1.

$wp_customize->add_setting('front_cat_section1', array(
	'default' => 'uncategorized',
	'capability' => 'edit_theme_options'
));

$wp_customize->add_section('tl_front_cats', array( // NB. COPY of section that's in place.
	'title' => __('Front Page Categories', 'testlab'),
	'priority' => 120
));

$wp_customize->add_control( 'front_cat_section1', array(
	'settings' => 'front_cat_section1',
	'label' => 'Section 1',
	'section' => 'tl_front_cats',
	'type' => 'select',
	'choices' => get_categories_select()
));



/* 3.a. PHP: Loop to bring in the dashboard text content of front-page.php. Placement:
   1st element of <div> main-column. */

//  The Loop to pull in the page text content, defined in the wp admin page properties.
if (have_posts()) :
	while (have_posts()) : the_post();
			
	the_content();
	
	endwhile;
	// What to do when there's no content.
	else :
		echo '<p>No content found!</p>';
endif;

?>