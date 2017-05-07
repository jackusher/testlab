<?php
/**
 * The template for the Experimentation page, used to test new features.
 *
 * This file is a template for a single page.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
 
get_header();

    foreach( $GLOBALS['catsArray'] as $cat ) {
      echo '<section class="category">';
      echo '<h1>' . $cat['category']->name.'</h1>';
      global $post;
      $post = $cat['post'];
      setup_postdata($post);
      // retrieve code
      get_template_part( 'post-in-category' );
      wp_reset_postdata();
      echo '</section>';
    } //foreach categories

foreach ( $GLOBALS['catsArray'] as $cat ) : // foreach loop pulling the latest post in each child cat.
	
				$args = array( // args for the WP_Query.
					'cat' => $cat['category']->term_id,
					'post_type' => 'post',
					'posts_per_page' => 1,
					'no_found_rows' => true,
					'ignore_sticky_posts' => true,
				);
	
				$query = new WP_Query( $args );

				if ( $query->have_posts() ) :
	
					while ( $query->have_posts() ) : $query->the_post(); ?>
					
						<div id="section1-article" class="front-article <?php if ( $sec1_counter !== 1) echo 'small'; ?>">
			
						<div id="section1-thumb" class="front-thumb"><!-- Thumbnails, including countpost logic. -->
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a>
						</div><!-- /section1-thumb -->
				
						<div id="section1-info" class="front-info"><!-- Post titles and excerpts. -->
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php
							the_excerpt(); ?>
						</div><!-- /section1-info -->
			
					</div><!-- /section1-article --><?php
		
					endwhile;
	
					else :
						echo '<p>No content found!</p>';
	
				endif;
	
				endforeach;
	
				wp_reset_postdata(); ?>
				
		</div>

<?php get_footer(); ?>