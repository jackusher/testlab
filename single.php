<?php
// single.php defines what to do with single post pages.

get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<!-- main-column area -->
	<div class="main-column">

		<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
	
			// Reference to the content.php file. Post layout is pulled from content-single.php. If there are any special post types, e.g. galleries, the second argument pushes requests to the correct content-*.php file.
			// *if* logic: If the post is non-formatted, go to content-single.php. If the post is formatted, then go to respective content-*.php.
			if (get_post_format() == false) {
				get_template_part('content', 'single');
			} else {
				get_template_part('content', get_post_format());
			}
	
			endwhile;
	
			// What to do if there are no posts.
			else :
				echo '<p>No content found</p>';
	
			endif; ?>
			
		<div id="popular-single" class="popular-wrapper clearfix">

		<div id="popular-head-single" class="popular-head clearfix"><!-- Header for popular section including title and description. -->
			<span class="popular-headtit"><h2>Most Read</h2></span>
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
							<li class="popular-item">
								<p class="popular-rank"><?php echo $pop_counter ?></p>
								<p class="popular-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							</li><?php
						} else { ?>
							<li class="popular-item">
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
			
	</div><!-- /main-column -->

	<?php get_sidebar(); ?>
	
</div><!-- /site-content -->

<?php get_footer(); ?>