<?php
// The file defines the static home page behaviours.

// Grab the header.
get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<?php // Setting the variables which we'll pull into the loop later on.
	$parent = get_theme_mod( 'title_section1' ); // Pulling in the parent catgeory set in the WP appearance api.
	$parentID = get_cat_ID( $parent ); // Getting the cat ID from the name we pulled in.
	$sec1_children = get_categories( // Setting the cat as a PARENT cat.
		array( 'parent' => $parentID )
	); ?>

	<div id="section1-head" class="clearfix"><!-- Outputs the title of the parent cat before the masonry container (from WP app. api again). -->
		<div id="section1-title"><?php echo "<h2>" . get_category_by_slug($parent)->name . "</h2>"; ?></div>
		<div id="section1-subcats"><?php
			wp_list_categories( array( // Creating an li for each of the subcats in the parent.
				'orderby' => 'id',
				'show_count' => false,
				'title_li' => '',
				'use_dec_for_title' => false,
				'child_of' => $parentID
			) );
		?></div>
	</div><!-- /creative-head -->

	<div id="section1-wrapper" class="masonry-wrapper"><!-- The masonry container. -->

		<?php $counter=1; // Creating a counter for the foreach loop.

		foreach ( $sec1_children as $sec1_child ) : // foreach loop pulling the latest post in each child cat.
	
		$args = array( // args for the WP_Query.
			'cat' => $sec1_child->term_id,
			'post_type' => 'post',
			'posts_per_page' => 1,
			'no_found_rows' => true,
			'ignore_sticky_posts' => true,
		);
	
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
	
			while ( $query->have_posts() ) : $query->the_post(); ?>
	
			<div id="section1-article" class="masonry-block"><!-- Start of looped post content. -->
			
				<div id="section1-thumb"><!-- Thumbnails, including countpost logic. --><?php
					if($counter==1) { ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('left-creative'); ?></a><?php
					} else { ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
					} ?>
				</div><!-- /creative-thumb -->
				
				<div id="section1-info"><!-- Post titles and excerpts. -->
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php
				
					$checkcount = array(5, 6, 7);
					if(in_array($counter, $checkcount)){
						// Display no post excerpt.
					} else {
						the_excerpt(); ?>
						<p id="section1-auth">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p> <?php
					} ?>
					
				</div><!-- /creative-info -->
			
				<div id="section1-cat"><!-- Post categories. -->
					<span>
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
	
		endforeach;
	
		wp_reset_postdata(); ?>

	</div><!-- /creative-wrapper -->

	<div id="popular-wrapper" class="clearfix">

		<div id="popular-head" class="clearfix"><!-- Header for popular section including title and description. -->
			<span id="popular-headtit"><h2>Most Popular</h2></span><span id="popular-blurb"><h4>The most read posts on the site.</h4></span>
		</div><!-- /popular-head -->

		<ul class="popular-list"><!-- The <ul> tied to visit-monitoring function in functions.php. --><?php
	
			$argz = array( // The arguments for the popular WP_Query.
				'posts_per_page'=>5,
				'meta_key'=>'popular_posts',
				'orderby'=>'meta_value_num',
				'order'=>'DESC'
			);
	
			$popular = new WP_Query( $argz );
		
			if ( $popular->have_posts() ):
		
				$countah=0; while ( $popular->have_posts() ) : $popular->the_post(); $countah++;
			
					$checkcountah = array(1, 2, 3, 4, 5); // countpost mechanism to put the ranking number next to the post title.
					if(in_array($countah, $checkcountah)){ ?>
						<li id="popular-item">
							<p id="popular-rank"><?php echo $countah ?></p>
							<p id="popular-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
						</li><?php
					} else { ?>
						<li id="popular-item">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li><?php
					}
		
				endwhile;
			
				else :
					echo '<p>Sorry, just loner posts here.</p>';
		
			endif;
		
			$counter++;		
			
			wp_reset_postdata(); ?>
	
		</ul><!-- /popular-list -->

	</div><!-- /popular-wrapper -->

	<!-- main-column area -->
	<div class="main-column">
		
		<!-- home-columns -->
		<div class="home-columns clearfix">
			
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