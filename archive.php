<?php

get_header();

if (have_posts()) :
	
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
		}
	
	?>

<?php
	while (have_posts()) : the_post(); ?>
	
	<article class="post">
		<h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
		
		<p class="post-info"><?php the_time('F j, Y'); ?> | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> | Posted in
		
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
		
		</p>
		
		<?php the_excerpt(); ?>
	</article>
	
	<?php endwhile;
	
	else :
		echo '<p>No content found!</p>';
		
	endif;

get_footer();

?>