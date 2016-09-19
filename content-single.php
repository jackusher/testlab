<!--
content-single.php defines what to do with single post pages. Referred from single.php.
-->

<article class="post">
	<!-- Including post title as a link. -->
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
	<!-- Including post metadata. -->	
	<p class="post-info"><?php the_time('F j, Y g:i a'); ?> | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> | Posted in		
		<?php		
		$categories = get_the_category();
		$separator = ", ";
		$output = '';
		if ($categories) {			
			foreach ($categories as $category) {			
				$output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>'  . $separator;				
			}			
			echo trim($output, $separator);			
		}			
		?>			
		</p>
	
	<!-- Including the featured image at a pre-defined size. -->	
	<?php the_post_thumbnail('banner-image'); ?>
	
	<!-- Finally, call up the content. -->	
	<?php the_content(); ?>
	
</article>