<?php
/**
 * The template for all archive pages.
 *
 * Includes category, tag, author and date archives.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header(); ?>

<div class="site-content clearfix">

	<div class="main-column"><?php
	
		$ex = array(1, 2);
		$arch_counter=1;

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
			} ?>
	
		<div id="archive-content" class="front-content"><?php

			while (have_posts()) : the_post();
			
				if ( in_category( 36 ) ) {
					?><div id="archive-article" class="front-article editor-pick"><?php					
				} else {
					?><div id="archive-article" class="front-article"><?php
				} ?>

					<div id="archive-thumb" class="front-thumb">
						<?php if( $arch_counter == 1 ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-top'); ?></a><?php
						} elseif( $arch_counter == 2 ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-second'); ?></a><?php
						} else { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-article'); ?></a><?php
						} ?>
					</div><!-- /archive-thumb -->

					<div id="archive-info" class="front-info">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php
					
						if(in_array($arch_counter, $ex)) {
							the_excerpt();
						} else {
							// Display no excerpt.
						} ?>
					
					</div><!-- /archive-info -->

					<div id="archive-cat" class="front-artcat">
						<p id="archive-auth" class="front-auth">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p>
					</div><!-- /archive-cat -->

				</div><!-- /archive-article --><?php
	
			$arch_counter++;

			endwhile;

			else :
				echo '<p>No content found!</p>';

			endif; ?>

		</div><!-- /archive-content -->
		
		<div class="archive-pagination"><?php
		
			global $wp_query;
		
			$big = 999999999;
		
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text' => __('« Previous Page', 'bubble3'),
				'next_text' => __('Next Page »', 'bubble3')
			) ); ?>
		
		</div><!-- /archive-pagination -->
		
	</div><!-- /main-column -->
	
	<?php get_sidebar('singlepage'); ?>

</div><!-- /site-content -->

<?php get_footer(); ?>