<?php
/**
 * The template for single post pages.
 *
 * The site pages that display articles (although article content is scaffolded out to content-single.php).
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */

get_header(); ?>

<div class="site-content clearfix">

	<div class="main-column">

		<?php if (have_posts()) :
			while (have_posts()) : the_post();
	
			if (get_post_format() == false) {
				get_template_part('content', 'single');
			} else {
				get_template_part('content', get_post_format());
			}
	
			endwhile;
	
			else :
				echo '<p>No content found</p>';
	
			endif; ?>
			
		<div id="popular-single" class="popular-wrapper clearfix">

			<div id="popular-head-single" class="popular-head clearfix">
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
	
					$pop_counter=0; while ( $popular->have_posts() ) : $popular->the_post(); $pop_counter++;
		
						$checkcounter = array(1, 2, 3, 4, 5); // Countpost mechanism to put the ranking number next to the post title.
						if(in_array($pop_counter, $checkcounter)){ ?>
							<li class="popular-item clearfix">
								<p class="popular-rank"><?php echo "$pop_counter." ?></p>
								<p class="popular-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							</li><?php
						} else { ?>
							<li class="popular-item clearfix">
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
		
		<div id="comments-single" class="comments">
		
			<?php if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>
		
		</div><!-- /comments -->
			
	</div><!-- /main-column -->

	<?php get_sidebar('singlepage'); ?>
	
</div><!-- /site-content -->

<?php get_footer(); ?>