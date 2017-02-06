<!-- sidebar-column area -->
<div class="sidebar-column">
		
	<div id="popular-wrapper" class="clearfix">

		<div id="popular-head" class="clearfix"><!-- Header for popular section including title and description. -->
			<span id="popular-headtit"><h2>Most Popular</h2></span>
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

	</div><!-- /popular-wrapper --><?php

	dynamic_sidebar('sidebar1'); ?>

</div><!-- /sidebar-column -->