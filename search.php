<?php
/**
 * The template for search output pages.
 *
 * The site page that lists the posts matched to user search queries.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header(); ?>

<div class="content clearfix">

	<div id="archive-left" class="left">

		<?php $ex = array(1, 2);
		$arch_counter=1;
		
		if (have_posts()) : ?>
	
			<section class="archive-title"><h2>Search results for: <?php the_search_query(); ?></h2></section>
			
			<div id="archive-content" class="recent-content"><?php

			while (have_posts()) : the_post();
			
				if ( in_category( 36 ) ) {
					?><div id="archive-article" class="recent-article editor-pick"><?php					
				} else {
					?><div id="archive-article" class="recent-article"><?php
				} ?>

					<div id="archive-thumb" class="recent-thumb">
						<?php if( $arch_counter == 1 ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-top'); ?></a><?php
						} elseif( $arch_counter == 2 ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-second'); ?></a><?php
						} else { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-article'); ?></a><?php
						} ?>
					</div><!-- /archive-thumb -->

					<div id="archive-blurb" class="recent-blurb">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php
					
						if(in_array($arch_counter, $ex)) {
							the_excerpt();
						} else {
							// Display no excerpt.
						} ?>
					
					</div><!-- /archive-info -->

					<div id="archive-meta" class="recent-meta">
						<p id="archive-author" class="recent-author">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p>
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
			
	</div><!-- /left -->

	<?php get_sidebar('singlepage'); ?>
	
</div><!-- /content -->

<?php get_footer(); ?>