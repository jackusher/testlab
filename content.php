<?php 
$noimg = array(2, 3, 4, 9, 10);
$img = array(5, 6, 7, 8, 11, 12);
$noex = array(7, 8);
$arch_counter=1; // Creating a counter for the foreach loop.
	
	if ( in_category( 36 ) ) {
		?><div id="archive-article" class="front-article <?php if (in_array($arch_counter, $img)) echo 'small'; ?> editor-pick"><!-- Start of looped post content. --><?php					
	} else {
		?><div id="archive-article" class="front-article <?php if (in_array($arch_counter, $img)) echo 'small'; ?>"><!-- Start of looped post content. --><?php
	} ?>

		<div id="archive-thumb" class="front-thumb"><!-- Thumbnails, including countpost logic. --><?php
			if(in_array($arch_counter, $noimg)) {
				// Display no thumbnail.
			} elseif(in_array($arch_counter, $img)) { ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
			} elseif( $arch_counter == 1 ) { ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-top'); ?></a><?php
			} else { ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a><?php
			} ?>
		</div><!-- /archive-thumb -->

		<div id="archive-info" class="front-info"><!-- Post titles and excerpts. -->
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php

			if(in_array($arch_counter, $noimg)){
				// Display no post excerpt.
			} elseif(in_array($arch_counter, $noex)){
				// Display no post excerpt.
			} else {
				the_excerpt();
			} ?>
	
		</div><!-- /archive-info -->

		<div id="archive-cat" class="front-artcat"><!-- Post categories. -->
			<p id="archive-auth" class="front-auth"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in </p>
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
		</div><!-- /archive-cat -->

	</div><!-- /archive-article --><?php

$arch_counter++;