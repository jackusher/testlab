<!-- sidebar-column area -->
<div class="sidebar-column">
	
	<nav class="sidebar-navi">
		<?php // Defining <section1> variables.
		$sec1_parent = get_theme_mod( 'title_section1' ); // Pulling in the parent catgeory set in the WP appearance api.
		$sec1_parentID = get_cat_ID( $sec1_parent ); // Getting the cat ID from the name we pulled in.
		$sec1_children = get_categories( // Setting the cat as a PARENT cat.
			array( // There's something we can use from Misha Reyzlin to order cats by recency of their updates (left in bookmarks).
				'parent' => $sec1_parentID,
			)
		); ?>

		<div id="sidebar-menuitem1" class="front-head sidebar-menuitem clearfix"><!-- Outputs the title of the parent cat before the masonry container (from WP app. api again). -->
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
		
		<?php // Defining the <section2> variables.
		$sec2_parent = get_theme_mod( 'title_section2' );
		$sec2_parentID = get_cat_ID( $sec2_parent );
		$sec2_children = get_categories(
			array( 'parent' => $sec2_parentID )
		); ?>
	
		<div id="sidebar-menuitem2" class="front-head sidebar-menuitem clearfix">
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
		
		<?php // Defining <section3> variables.
		$sec3_parent = get_theme_mod( 'title_section3' ); // Pulling in the parent catgeory set in the WP appearance api.
		$sec3_parentID = get_cat_ID( $sec3_parent ); // Getting the cat ID from the name we pulled in.
		$sec3_children = get_categories( // Setting the cat as a PARENT cat.
			array( // There's something we can use from Misha Reyzlin to order cats by recency of their updates (left in bookmarks).
				'parent' => $sec3_parentID,
			)
		); ?>
	
		<div id="sidebar-menuitem3" class="front-head sidebar-menuitem clearfix">
			<div id="section3-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec3_parent)->name . "</h2>"; ?></div>
			<div id="section1-subcats" class="front-subcats"><?php
				wp_list_categories( array( // Creating an li for each of the subcats in the parent.
					'orderby' => 'name',
					'show_count' => false,
					'title_li' => '',
					'use_dec_for_title' => false,
					'child_of' => $sec3_parentID
				) );?>			
			</div>		
		</div><!-- /section3-head -->
		
	</nav><!-- /sidebar-navi -->
		
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