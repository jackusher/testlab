<?php
/**
 * The template for the body content on single post pages.
 *
 * The content file referenced from single.php.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
?>	
	<article class="post-single">
		
		<h2><?php the_title(); ?></h2>

		<p class="post-info" id="single-post-info"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> in
			<?php
			$categories = get_the_category();
			$separator = ", ";
			$output = '';

			if ($categories) {
				foreach ($categories as $category) {
					$output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>'  . $separator;
				}
				echo trim($output, $separator);
			} ?> on <?php the_time('j F, Y'); ?>.
		</p>

		<section class="post-single-content">
			<?php the_content(); ?>
		</section>
		
	</article><!-- /post-single -->