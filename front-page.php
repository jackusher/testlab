<?php
// The file defines the static home page behaviours.

// Grab the header.
get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<div id="front-latest">

		<?php // Defining <section1> variables.
		$sec1_parent = get_theme_mod( 'title_section1' ); // Pulling in the parent catgeory set in the WP appearance api.
		$sec1_parentID = get_cat_ID( $sec1_parent ); // Getting the cat ID from the name we pulled in.
		$sec1_children = get_categories( // Setting the cat as a PARENT cat.
			array( // There's something we can use from Misha Reyzlin to order cats by recency of their updates (left in bookmarks).
				'parent' => $sec1_parentID,
			)
		); ?>

		<div id="section1-wrap" class="front-wrapper"><!-- The masonry container. -->
	
			<div id="section1-head" class="front-head clearfix"><!-- Outputs the title of the parent cat before the masonry container (from WP app. api again). -->
				<div id="section1-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec1_parent)->name . "</h2>"; ?></div>
			</div><!-- /section1-head -->
		
			<div id="section1-content" class="front-content">

				<?php 
				$noimg = array(2, 3, 4, 9, 10);
				$img = array(5, 6, 7, 8, 11, 12);
				$sec1_counter=1; // Creating a counter for the foreach loop.

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
	
					while ( $query->have_posts() ) : $query->the_post();
					
					if ( $sec1_counter == 9 ) { ?>
						<div class="clearer"></div><?php
					} else {
						// Do nothing.
					} ?>
	
					<div id="section1-article" class="front-article <?php if (in_array($sec1_counter, $img)) echo 'small'; ?>"><!-- Start of looped post content. -->
			
						<div id="section1-thumb" class="front-thumb"><!-- Thumbnails, including countpost logic. --><?php
							if(in_array($sec1_counter, $noimg)) {
								// Display no thumbnail.
							} elseif(in_array($sec1_counter, $img)) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} elseif( $sec1_counter == 1 ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-latest'); ?></a><?php
							} else { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} ?>
						</div><!-- /section1-thumb -->
				
						<div id="section1-info" class="front-info"><!-- Post titles and excerpts. -->
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

							if(in_array($sec1_counter, $noimg)){
								// Display no post excerpt.
							} else {
								the_excerpt(); ?>
								<p id="section1-auth" class="front-auth">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p> <?php
							} ?>
					
						</div><!-- /section1-info -->
			
						<div id="section1-cat" class="front-artcat"><!-- Post categories. -->
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
						</div><!-- /section1-cat -->
			
					</div><!-- /section1-article --><?php
		
					endwhile;
	
					else :
						echo '<p>No content found!</p>';
	
				endif;

				$sec1_counter++;
	
				endforeach;
	
				wp_reset_postdata(); ?>
		
			</div><!-- /section1-content -->

		</div><!-- /section1-wrapper -->
	
		<?php // Defining the <section2> variables.
		$sec2_parent = get_theme_mod( 'title_section2' );
		$sec2_parentID = get_cat_ID( $sec2_parent );
		$sec2_children = get_categories(
			array( 'parent' => $sec2_parentID )
		); ?>
	
		<div id="section2-wrap" class="front-wrapper">
	
			<div id="section2-head" class="front-head clearfix">
				<div id="section2-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec2_parent)->name . "</h2>"; ?></div>
			</div><!-- /section2-head -->
			
			<div id="section2-content" class="front-content">

				<?php 
				$noimg = array(2, 3, 4, 9, 10);
				$img = array(5, 6, 7, 8, 11, 12);
				$sec2_counter=1; // Creating a counter for the foreach loop.

				foreach ( $sec2_children as $sec2_child ) : // foreach loop pulling the latest post in each child cat.
	
				$args = array( // args for the WP_Query.
					'cat' => $sec2_child->term_id,
					'post_type' => 'post',
					'posts_per_page' => 1,
					'no_found_rows' => true,
					'ignore_sticky_posts' => true,
				);
	
				$query = new WP_Query( $args );

				if ( $query->have_posts() ) :
	
					while ( $query->have_posts() ) : $query->the_post();
					
					if ( $sec2_counter == 9 ) { ?>
						<div class="clearer"></div><?php
					} else {
						// Do nothing.
					} ?>
	
					<div id="section2-article" class="front-article <?php if (in_array($sec2_counter, $img)) echo 'small'; ?>"><!-- Start of looped post content. -->
			
						<div id="section2-thumb" class="front-thumb"><!-- Thumbnails, including countpost logic. --><?php
							if(in_array($sec2_counter, $noimg)) {
								// Display no thumbnail.
							} elseif(in_array($sec2_counter, $img)) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} elseif( $sec2_counter == 1 ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-latest'); ?></a><?php
							} else { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} ?>
						</div><!-- /section2-thumb -->
				
						<div id="section2-info" class="front-info"><!-- Post titles and excerpts. -->
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

							if(in_array($sec2_counter, $noimg)){
								// Display no post excerpt.
							} else {
								the_excerpt(); ?>
								<p id="section2-auth" class="front-auth">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p> <?php
							} ?>
					
						</div><!-- /section2-info -->
			
						<div id="section2-cat" class="front-artcat"><!-- Post categories. -->
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
						</div><!-- /section2-cat -->
			
					</div><!-- /section2-article --><?php
		
					endwhile;
	
					else :
						echo '<p>No content found!</p>';
	
				endif;

				$sec2_counter++;
	
				endforeach;
	
				wp_reset_postdata(); ?>
		
			</div><!-- /section1-content -->
	
		</div><!-- /section2-wrapper -->
	
		<?php // Defining <section3> variables.
		$sec3_parent = get_theme_mod( 'title_section3' ); // Pulling in the parent catgeory set in the WP appearance api.
		$sec3_parentID = get_cat_ID( $sec3_parent ); // Getting the cat ID from the name we pulled in.
		$sec3_children = get_categories( // Setting the cat as a PARENT cat.
			array( // There's something we can use from Misha Reyzlin to order cats by recency of their updates (left in bookmarks).
				'parent' => $sec3_parentID,
			)
		); ?>	

		<div id="section3-wrap" class="front-wrapper">
	
			<div id="section3-head" class="front-head clearfix">
				<div id="section3-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec3_parent)->name . "</h2>"; ?></div>		
			</div><!-- /section3-head -->
		
			<div id="section3-content" class="front-content">

				<?php 
				$noimg = array(2, 3, 4, 9, 10);
				$img = array(5, 6, 7, 8, 11, 12);
				$sec3_counter=1; // Creating a counter for the foreach loop.

				foreach ( $sec3_children as $sec3_child ) : // foreach loop pulling the latest post in each child cat.
	
				$args = array( // args for the WP_Query.
					'cat' => $sec3_child->term_id,
					'post_type' => 'post',
					'posts_per_page' => 1,
					'no_found_rows' => true,
					'ignore_sticky_posts' => true,
				);
	
				$query = new WP_Query( $args );

				if ( $query->have_posts() ) :
	
					while ( $query->have_posts() ) : $query->the_post();
					
					if ( $sec3_counter == 9 ) { ?>
						<div class="clearer"></div><?php
					} else {
						// Do nothing.
					} ?>
	
					<div id="section3-article" class="front-article <?php if (in_array($sec3_counter, $img)) echo 'small'; ?>"><!-- Start of looped post content. -->
			
						<div id="section3-thumb" class="front-thumb"><!-- Thumbnails, including countpost logic. --><?php
							if(in_array($sec3_counter, $noimg)) {
								// Display no thumbnail.
							} elseif(in_array($sec3_counter, $img)) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} elseif( $sec3_counter == 1 ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-latest'); ?></a><?php
							} else { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} ?>
						</div><!-- /section3-thumb -->
				
						<div id="section3-info" class="front-info"><!-- Post titles and excerpts. -->
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

							if(in_array($sec3_counter, $noimg)){
								// Display no post excerpt.
							} else {
								the_excerpt(); ?>
								<p id="section3-auth" class="front-auth">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p> <?php
							} ?>
					
						</div><!-- /section3-info -->
			
						<div id="section3-cat" class="front-artcat"><!-- Post categories. -->
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
						</div><!-- /section3-cat -->
			
					</div><!-- /section3-article --><?php
		
					endwhile;
	
					else :
						echo '<p>No content found!</p>';
	
				endif;

				$sec3_counter++;
	
				endforeach;
	
				wp_reset_postdata(); ?>
		
			</div><!-- /section1-content -->
	
		</div><!-- /section3-wrap -->
		
		<div class="clearer"></div>
	
	</div><!-- /front-latest -->
	
	<div id="popular-wrapper" class="clearfix">

		<div id="popular-head" class="clearfix"><!-- Header for popular section including title and description. -->
			<span id="popular-headtit"><h2>Most Popular</h2></span><span id="popular-blurb"><h4>The most read posts on the site.</h4></span>
		</div><!-- /popular-head -->

		<ul class="popular-list"><!-- The <ul> tied to visit-monitoring function in functions.php. --><?php
	
			$args = array( // The arguments for the popular WP_Query.
				'posts_per_page'=>5,
				'meta_key'=>'popular_posts',
				'orderby'=>'meta_value_num',
				'order'=>'DESC'
			);
	
			$popular = new WP_Query( $args );
		
			if ( $popular->have_posts() ):
		
				$pop_counter=0; while ( $popular->have_posts() ) : $popular->the_post(); $pop_counter++;
			
					$checkcounter = array(1, 2, 3, 4, 5); // countpost mechanism to put the ranking number next to the post title.
					if(in_array($pop_counter, $checkcounter)){ ?>
						<li id="popular-item">
							<p id="popular-rank"><?php echo $pop_counter ?></p>
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
		
			$pop_counter++;		
			
			wp_reset_postdata(); ?>
	
		</ul><!-- /popular-list -->

	</div><!-- /popular-wrapper -->
	
</div><!-- /site-content -->

<?php
// Grab the footer.
get_footer();
?>