<?php 
/**
 * The template for the front page.
 *
 * The static homepage of the website.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header(); ?>

<div class="site-content clearfix">

	<div id="front-latest">

		<?php
		$sec1_parent = get_theme_mod( 'title_section1' );
		$sec1_parentID = get_cat_ID( $sec1_parent );
		$sec1_children = get_categories(
			array(
				'parent' => $sec1_parentID,
			)
		); ?>

		<div id="section1-wrap" class="front-wrapper">
	
			<div id="section1-head" class="front-head clearfix"><!-- Outputs the title of the parent cat before the masonry container (from WP app. api again). -->
				<div id="section1-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec1_parent)->name . "</h2>"; ?></div>
				<div id="section1-subcats" class="front-subcats"><?php
					wp_list_categories( array( // Creating an li for each of the subcats in the parent.
						'orderby' => 'name',
						'show_count' => false,
						'title_li' => '',
						'use_dec_for_title' => false,
						'child_of' => $sec1_parentID
					) );?>			
				</div>
			</div><!-- /section1-head -->
		
			<div id="section1-content" class="front-content">

				<?php 
				$noimg = array(4, 5, 8, 9, 10);
				$img = array(2, 3, 6, 7);
				$noex = array(6, 7);
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
					}
					
					if ( in_category( 36 ) ) {
						?><div id="section1-article" class="front-article <?php if ( $sec1_counter !== 1 ) echo 'small'; if(in_array($sec1_counter, $img)) echo ' bottom-buffer'; ?> editor-pick"><?php
					} elseif ( $sec1_counter == 1 ) {
						?><div id="section1-article" class="front-article bottom-buffer"><?php
					} elseif ( in_array($sec1_counter, $img) ) {
						?><div id="section1-article" class="front-article small bottom-buffer"><?php
					} else {
						?><div id="section1-article" class="front-article <?php if ( $sec1_counter !== 1) echo 'small'; ?>"><?php
					} ?>
			
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
				
						<div id="section1-info" class="front-info">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

							if(in_array($sec1_counter, $noimg)){
								// Display no post excerpt.
							} elseif(in_array($sec1_counter, $noex)) {
								// No excerpt.
							} else {
								the_excerpt();
							} ?>
					
						</div><!-- /section1-info -->
			
						<div id="section1-cat" class="front-artcat">
							<p id="section1-auth" class="front-auth"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in </p>
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
			
		<?php
		$sec2_parent = get_theme_mod( 'title_section2' );
		$sec2_parentID = get_cat_ID( $sec2_parent );
		$sec2_children = get_categories(
			array( 'parent' => $sec2_parentID )
		); ?>
	
		<div id="section2-wrap" class="front-wrapper">
	
			<div id="section2-head" class="front-head clearfix">
				<div id="section2-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec2_parent)->name . "</h2>"; ?></div>
				<div id="section1-subcats" class="front-subcats"><?php
					wp_list_categories( array( // Creating an li for each of the subcats in the parent.
						'orderby' => 'name',
						'show_count' => false,
						'title_li' => '',
						'use_dec_for_title' => false,
						'child_of' => $sec2_parentID
					) );?>			
				</div>
			</div><!-- /section2-head -->
			
			<div id="section2-content" class="front-content">

				<?php 
				$noimg = array(2, 3, 4, 7, 8, 9, 10);
				$img = array(5, 6, 11, 12);
				$noex = array(7, 8);
				$bottom_buffer = array(1, 4);
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
					}
	
					if ( in_category( 36 ) ) {
						?><div id="section2-article" class="front-article <?php if (in_array($sec2_counter, $img) || (in_array($sec2_counter, $noex))) echo 'small'; ?> editor-pick"><!-- Start of looped post content. --><?php					
					} elseif ( in_array($sec2_counter, $bottom_buffer)) {
						?><div id="section2-article" class="front-article bottom-buffer"><?php
					} else {
						?><div id="section2-article" class="front-article <?php if (in_array($sec2_counter, $img) || (in_array($sec2_counter, $noex))) echo 'small'; ?>"><!-- Start of looped post content. --><?php
					} ?>
			
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

							if( $sec2_counter == 1 ){
								the_excerpt();
							} else {
								// Display no post excerpt.
							} ?>
					
						</div><!-- /section2-info -->
			
						<div id="section2-cat" class="front-artcat"><!-- Post categories. -->
							<p id="section2-auth" class="front-auth"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in </p>
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
		
			</div><!-- /section2-content -->
	
		</div><!-- /section2-wrapper -->
	
		<?php
		$sec3_parent = get_theme_mod( 'title_section3' );
		$sec3_parentID = get_cat_ID( $sec3_parent );
		$sec3_children = get_categories(
			array(
				'parent' => $sec3_parentID,
			)
		); ?>

		<div id="section3-wrap" class="front-wrapper">
	
			<div id="section3-head" class="front-head clearfix">
				<div id="section3-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec3_parent)->name . "</h2>"; ?></div>
				<div id="section3-subcats" class="front-subcats"><?php
					wp_list_categories( array( // Creating an li for each of the subcats in the parent.
						'orderby' => 'name',
						'show_count' => false,
						'title_li' => '',
						'use_dec_for_title' => false,
						'child_of' => $sec3_parentID
					) );?>			
				</div>		
			</div><!-- /section3-head -->
		
			<div id="section3-content" class="front-content">

				<?php 
				$noimg = array(4, 5, 8, 9, 10);
				$img = array(2, 3, 6, 7);
				$noex = array(6, 7);
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
					
					if ( $sec3_counter == 9 ) { // OR whatever happens to be the number of subsections, ie. the last article element. ?>
						<div class="clearer"></div><?php
					} else {
						// Do nothing.
					}

					if ( in_category( 36 ) ) {
						?><div id="section3-article" class="front-article <?php if ( $sec3_counter !== 1 ) echo 'small'; if(in_array($sec3_counter, $img)) echo ' bottom-buffer'; ?> editor-pick"><!-- Start of looped post content. --><?php					
					} elseif ( $sec3_counter == 1 ) {
						?><div id="section3-article" class="front-article bottom-buffer"><?php
					} elseif ( in_array($sec3_counter, $img) ) {
						?><div id="section3-article" class="front-article small bottom-buffer"><?php
					} else {
						?><div id="section3-article" class="front-article <?php if ( $sec3_counter !== 1 ) echo 'small'; ?>"><?php
					} ?>
								
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
							} elseif(in_array($sec3_counter, $noex)) {
								// No excerpt.
							} else {
								the_excerpt();
							} ?>
					
						</div><!-- /section3-info -->
			
						<div id="section3-cat" class="front-artcat"><!-- Post categories. -->
							<p id="section3-auth" class="front-auth"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in </p>							
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
		
			</div><!-- /section3-content -->
	
		</div><!-- /section3-wrap -->
		
		<div class="clearer"></div>
	
	</div><!-- /front-latest -->
	
	<div id="front-full1" class="front-full clearfix">
	
		<div id="front-full-info" class="clearfix">
			<span id="front-full-title"><h2><?php echo get_category_by_slug( get_theme_mod( 'front_full' ) )->name ?></h2></span>
			<span id="front-full-blurb"><h4>Static: The editors' weekly pick of articles.</h4></span>
		</div>
	
		<?php $args = array( // WP_Query args.
			'category_name' => get_theme_mod( 'front_full' ),
			'post_type' => 'post',
			'posts_per_page' => 5,
		);
		
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) :
		
			while ( $query->have_posts() ) : $query->the_post(); ?>
			
				<div id="front-full-article">
					<div id="front-full-article-title">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<h4 id="front-full-article-auth">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></h4>
					</div>
				</div>
			
			<?php endwhile;
			
		else :
			echo '<p>No content found!</p>';
		endif; ?>
	
	</div><!-- /front-full1 -->
	
	<div id="front-full2" class="front-full clearfix">
	
		<div id="popular-front" class="popular-wrapper clearfix">

			<div id="popular-head-front" class="popular-head clearfix">
				<span class="popular-headtit"><h2>Most Read</h2></span>
			</div><!-- /popular-head -->

			<ul class="popular-list"><?php

				$args = array( // The arguments for the popular WP_Query.
					'posts_per_page'=>5,
					'meta_key'=>'popular_posts',
					'orderby'=>'meta_value_num',
					'order'=>'DESC'
				);

				$popular = new WP_Query( $args );

				if ( $popular->have_posts() ):

					while ( $popular->have_posts() ) : $popular->the_post(); ?>
	
						<li class="popular-item">
							<p class="popular-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							<h4 id="popular-article-auth">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></h4>
						</li><?php

					endwhile;
	
					else :
						echo '<p>Sorry, just loner posts here.</p>';

				endif;	
	
				wp_reset_postdata(); ?>

			</ul><!-- /popular-list -->

		</div><!-- /popular-wrapper -->
		
	</div><!-- /front-full2 -->
	
	<div class="front-columnists clearfix">
	
		<div id="front-full-info" class="clearfix">
			<span id="front-full-title"><h2>Latest Columns</h2></span>
		</div>
		
		<?php $args = array( // WP_Query args.
			'category_name' => 'columns',
			'post_type' => 'post',
			'posts_per_page' => 4
		);
		
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) :
		
			while ( $query->have_posts() ) : $query->the_post(); ?>
			
				<div id="columnist-article">
					<div id="columnist-thumb">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a>
					</div>
					
					<div id="columnist-info">
						<p id="columnist-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					</div><!-- /columnist-info -->
					
				</div>
			
			<?php endwhile;
			
		else :
			echo '<p>No content found!</p>';
		endif; ?>
	
	</div><!-- /front-columnists -->
	
	<div class="front-side">
	
		<nav id="home-sidebar-menu" class="site-nav">
			<?php	
			$args = array(
				'theme_location' => 'home-sidebar'
			);	
			wp_nav_menu( $args ); ?>
		</nav>
	
	</div><!-- /front-side -->
	
</div><!-- /site-content -->

<?php get_footer(); ?>