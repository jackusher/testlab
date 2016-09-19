<!--
content.php contains the main post article elements for post lists (index, article etc.), and single posts. Further types are marked by content-*.php.
-->

<article class="post <?php if ( has_post_thumbnail() ) { ?> has-thumbnail clearfix<?php } ?>">
		
		<!-- post-thumbnail behaviour. Creating a div for the image, and calling a pre-defined image size. Putting a link in. -->
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('standard-blog-thumbnail'); ?></a>
		</div><!-- /post-thumbnail -->
		
		<!-- Using the title of the post as a link to its single.php -->
		<h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
		
		<!-- Post meta inclusion. -->
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
		
		<!-- Conditional element inclusion based on what THE PAGE is. NOT post-type. -->
		<!-- If search or archive page, manadtory excerpt display. -->
		<?php if ( is_search() OR is_archive() ) { ?>
			<p>
			<?php echo get_the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>">Read more&raquo;</a>
			</p>
		<!-- Else, if the post has an excerpt, use it. If it doesn't, display the content. -->
		<?php } else {
			if ($post->post_excerpt) { ?>
				<p>
				<?php echo get_the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>">Read more&raquo;</a>
				</p>
			
			<?php } else {
				the_content();
			}
			
		} ?>
		
</article>