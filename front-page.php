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

<div class="content clearfix">

	<div class="front-full clearfix">
	
		<div class="front-full-info clearfix">
			<span class="front-full-title"><h2><?php echo get_category_by_slug( get_theme_mod( 'front_full' ) )->name ?></h2></span>
			<span class="front-full-blurb"><h4><?php echo category_description( get_category_by_slug( get_theme_mod( 'front_full' ))->term_id ); ?></h4></span>
		</div>
		
		<ul id="editors-picks" class="front-full-content clearfix">
	
			<?php $args = array( // WP_Query args.
				'category_name' => get_theme_mod( 'front_full' ),
				'post_type' => 'post',
				'posts_per_page' => 5,
			);
		
			$query = new WP_Query( $args );
		
			if ( $query->have_posts() ) :
		
				while ( $query->have_posts() ) : $query->the_post(); ?>
					
					<li id="editors-pick" class="front-full-article">
						
						<div class="columnist-thumb">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('editors-picks-thumbnail'); ?></a>
						</div>
					
						<div class="columnist-info">
							<p class="columnist-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
						</div><!-- /columnist-info -->
					
						<div class="authauth">
							<h4 class="front-full-article-author">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></h4>
						</div>
					</li>
			
				<?php endwhile;
			
			else :
				echo '<p>No content found!</p>';
			endif;
		
			wp_reset_postdata(); ?>
		
		</ul><!-- /front-full-content -->
	
	</div><!-- /front-full -->
	
	<div id="front-latest">

		<div id="recent-front1" class="recent-section">
	
			<div id="front1-head" class="recent-head clearfix"><!-- Outputs the title of the parent cat before the masonry container (from WP app. api again). -->
				<?php $sec1_parent = get_theme_mod( 'title_section1' );
				$sec1_parentID = get_cat_ID( $sec1_parent ); ?>
				
				<div id="front1-title" class="recent-title"><?php echo "<h2>" . get_category_by_slug($sec1_parent)->name . "</h2>"; ?></div>
				<i class="fa fa-chevron-down fa-lg recent-chevron" aria-hidden="true"></i>
				<div id="front1-nav" class="recent-nav"><?php
					wp_list_categories( array( // Creating an li for each of the subcats in the parent.
						'orderby' => 'name',
						'show_count' => false,
						'title_li' => '',
						'use_dec_for_title' => false,
						'child_of' => $sec1_parentID
					) );?>			
				</div>
			</div><!-- /front1-head -->
		
			<div id="front1-content" class="recent-content">

				<?php 
				$noimg = array(4, 5, 8, 9, 10);
				$img = array(2, 3, 6, 7);
				$noex = array(6, 7);
				$sec1_counter=1; // Creating a counter for the foreach loop.

				foreach ( $GLOBALS['comment'] as $cat ) : // foreach loop pulling the latest post in each child cat.
	
				$args = array( // args for the WP_Query.
					'cat' => $cat['category']->term_id,
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
						?><div id="front1-article" class="recent-article <?php if ( $sec1_counter !== 1 ) echo 'small'; if(in_array($sec1_counter, $img)) echo ' bottom-buffer'; ?> editor-pick"><?php
					} elseif ( $sec1_counter == 1 ) {
						?><div id="front1-article" class="recent-article bottom-buffer"><?php
					} elseif ( in_array($sec1_counter, $img) ) {
						?><div id="front1-article" class="recent-article small bottom-buffer"><?php
					} else {
						?><div id="front1-article" class="recent-article <?php if ( $sec1_counter !== 1) echo 'small'; ?>"><?php
					} ?>
			
						<div id="front1-thumb" class="recent-thumb"><!-- Thumbnails, including countpost logic. --><?php
							if(in_array($sec1_counter, $noimg)) {
								// Display no thumbnail.
							} elseif(in_array($sec1_counter, $img)) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} elseif( $sec1_counter == 1 ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-latest'); ?></a><?php
							} else { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} ?>
						</div><!-- /front1-thumb -->
				
						<div id="front1-blurb" class="recent-blurb">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

							if(in_array($sec1_counter, $noimg)){
								// Display no post excerpt.
							} elseif(in_array($sec1_counter, $noex)) {
								// No excerpt.
							} else {
								the_excerpt();
							} ?>
					
						</div><!-- /front1-blurb -->
			
						<div id="front1-meta" class="recent-meta">
							<p id="front1-author" class="recent-author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in </p>
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
						</div><!-- /front1-meta -->
			
					</div><!-- /front1-article --><?php
		
					endwhile;
	
					else :
						echo '<p>No content found!</p>';
	
				endif;

				$sec1_counter++;
	
				endforeach;
	
				wp_reset_postdata(); ?>
		
			</div><!-- /front1-content -->

		</div><!-- /recent-front1 -->
	
		<div id="recent-front2" class="recent-section">
	
			<div id="front2-head" class="recent-head clearfix">
				<?php $sec2_parent = get_theme_mod( 'title_section2' );
				$sec2_parentID = get_cat_ID( $sec2_parent ); ?>
				
				<div id="front2-title" class="recent-title"><?php echo "<h2>" . get_category_by_slug($sec2_parent)->name . "</h2>"; ?></div>
				<div id="front2-nav" class="recent-nav"><?php
					wp_list_categories( array( // Creating an li for each of the subcats in the parent.
						'orderby' => 'name',
						'show_count' => false,
						'title_li' => '',
						'use_dec_for_title' => false,
						'child_of' => $sec2_parentID
					) );?>			
				</div>
			</div><!-- /front2-head -->
			
			<div id="front2-content" class="recent-content">

				<?php 
				$noimg = array(2, 3, 4, 7, 8, 9, 10);
				$img = array(5, 6, 11, 12);
				$noex = array(7, 8);
				$bottom_buffer = array(1, 4);
				$sec2_counter=1; // Creating a counter for the foreach loop.

				foreach ( $GLOBALS['lifestyle'] as $cat ) : // foreach loop pulling the latest post in each child cat.
	
				$args = array( // args for the WP_Query.
					'cat' => $cat['category']->term_id,
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
						?><div id="front2-article" class="recent-article <?php if (in_array($sec2_counter, $img) || (in_array($sec2_counter, $noex))) echo 'small'; ?> editor-pick"><!-- Start of looped post content. --><?php					
					} elseif ( in_array($sec2_counter, $bottom_buffer)) {
						?><div id="front2-article" class="recent-article bottom-buffer"><?php
					} else {
						?><div id="front2-article" class="recent-article <?php if (in_array($sec2_counter, $img) || (in_array($sec2_counter, $noex))) echo 'small'; ?>"><!-- Start of looped post content. --><?php
					} ?>
			
						<div id="front2-thumb" class="recent-thumb"><!-- Thumbnails, including countpost logic. --><?php
							if(in_array($sec2_counter, $noimg)) {
								// Display no thumbnail.
							} elseif(in_array($sec2_counter, $img)) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} elseif( $sec2_counter == 1 ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-latest'); ?></a><?php
							} else { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} ?>
						</div><!-- /front2-thumb -->
				
						<div id="front2-blurb" class="recent-blurb"><!-- Post titles and excerpts. -->
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

							if( $sec2_counter == 1 ){
								the_excerpt();
							} else {
								// Display no post excerpt.
							} ?>
					
						</div><!-- /front2-blurb -->
			
						<div id="front2-meta" class="recent-meta"><!-- Post categories. -->
							<p id="front2-author" class="recent-author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in </p>
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
						</div><!-- /front2-meta -->
			
					</div><!-- /front2-article --><?php
		
					endwhile;
	
					else :
						echo '<p>No content found!</p>';
	
				endif;

				$sec2_counter++;
	
				endforeach;
	
				wp_reset_postdata(); ?>
		
			</div><!-- /front2-content -->
	
		</div><!-- /recent-front2 -->
		
		<div id="recent-front3" class="recent-section">
	
			<div id="front3-head" class="recent-head clearfix">
				<?php $sec3_parent = get_theme_mod( 'title_section3' );
				$sec3_parentID = get_cat_ID( $sec3_parent ); ?>
				
				<div id="front3-title" class="recent-title"><?php echo "<h2>" . get_category_by_slug($sec3_parent)->name . "</h2>"; ?></div>
				<i class="fa fa-chevron-down fa-lg recent-chevron" aria-hidden="true"></i>
				<div class="clearer"></div>
				<div id="front3-nav" class="recent-nav"><?php
					wp_list_categories( array( // Creating an li for each of the subcats in the parent.
						'orderby' => 'name',
						'show_count' => false,
						'title_li' => '',
						'use_dec_for_title' => false,
						'child_of' => $sec3_parentID
					) );?>			
				</div>		
			</div><!-- /front3-head -->
		
			<div id="front3-content" class="recent-content">

				<?php 
				$noimg = array(4, 5, 8, 9, 10);
				$img = array(2, 3, 6, 7);
				$noex = array(6, 7);
				$sec3_counter=1; // Creating a counter for the foreach loop.

				foreach ( $GLOBALS['science'] as $cat ) : // foreach loop pulling the latest post in each child cat.
	
				$args = array( // args for the WP_Query.
					'cat' => $cat['category']->term_id,
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
						?><div id="front3-article" class="recent-article <?php if ( $sec3_counter !== 1 ) echo 'small'; if(in_array($sec3_counter, $img)) echo ' bottom-buffer'; ?> editor-pick"><!-- Start of looped post content. --><?php					
					} elseif ( $sec3_counter == 1 ) {
						?><div id="front3-article" class="recent-article bottom-buffer"><?php
					} elseif ( in_array($sec3_counter, $img) ) {
						?><div id="front3-article" class="recent-article small bottom-buffer"><?php
					} else {
						?><div id="front3-article" class="recent-article <?php if ( $sec3_counter !== 1 ) echo 'small'; ?>"><?php
					} ?>
								
						<div id="front3-thumb" class="recent-thumb"><!-- Thumbnails, including countpost logic. --><?php
							if(in_array($sec3_counter, $noimg)) {
								// Display no thumbnail.
							} elseif(in_array($sec3_counter, $img)) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} elseif( $sec3_counter == 1 ) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-latest'); ?></a><?php
							} else { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
							} ?>
						</div><!-- /front3-thumb -->
				
						<div id="front3-blurb" class="recent-blurb"><!-- Post titles and excerpts. -->
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

							if(in_array($sec3_counter, $noimg)){
								// Display no post excerpt.
							} elseif(in_array($sec3_counter, $noex)) {
								// No excerpt.
							} else {
								the_excerpt();
							} ?>
					
						</div><!-- /front3-blurb -->
			
						<div id="front3-meta" class="recent-meta"><!-- Post categories. -->
							<p id="front3-author" class="recent-author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in </p>							
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
						</div><!-- /front3-meta -->
			
					</div><!-- /front3-article --><?php
		
					endwhile;
	
					else :
						echo '<p>No content found!</p>';
	
				endif;

				$sec3_counter++;
	
				endforeach;
	
				wp_reset_postdata(); ?>
		
			</div><!-- /front3-content -->
	
		</div><!-- /recent-front3 -->
		
		<div class="clearer"></div>
	
	</div><!-- /front-latest -->
	
	<div id="front-popular" class="front-full clearfix">
	
		<div class="front-full-info clearfix">
			<span class="front-full-title"><h2>Most Popular</h2></span>
			<span class="front-full-blurb"><h4>The most read articles on The Bubble this week.</h4></span>
		</div>
		
		<?php $args = array(
			'limit' => 5,
			// 'range' => 'weekly',
			// 'freshness' => 1,
			'order_by' => 'views',
			'post_type' => 'post',
			'stats_views' => 0,
			'stats_author' => 1,
			'wpp_start' => '<ul class="front-full-content clearfix">',
			'wpp_end' => '</ul>',
			'post_html' => '<li class="front-full-article front-popular-article"><h4 id="front-popular-article-title" class="front-full-article-title">{title}</h4><h4 id="front-popular-article-author" class="front-full-article-author">{author}</h4></li>'
		);
		
		wpp_get_mostpopular( $args ); ?>
		
	</div><!-- /front-full -->
	
	<div class="front-columnists clearfix">
	
		<div class="front-full-info clearfix">
			<span class="front-full-title"><h2>Latest Columns</h2></span>
		</div>
		
		<?php $bottom_cat = get_theme_mod( 'bottom_section' );
		
		$args = array( // WP_Query args.
			'category_name' => $bottom_cat,
			'post_type' => 'post',
			'posts_per_page' => 4
		);
		
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) :
		
			while ( $query->have_posts() ) : $query->the_post(); ?>
			
				<div class="columnist-article">
				
					<div class="columnist-thumb">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a>
					</div>
					
					<div class="columnist-info">
						<p class="columnist-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					</div><!-- /columnist-info -->
					
				</div><!-- /columnist-article -->
			
			<?php endwhile;
			
		else :
			echo '<p>No content found!</p>';
		endif; ?>
	
	</div><!-- /front-columnists -->
	
	<div class="front-side">
	
		<?php get_sidebar('frontpage'); ?>
	
	</div><!-- /front-side -->
	
</div><!-- /site-content -->

<?php get_footer(); ?>