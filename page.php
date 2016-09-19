<?php
// page.php defines what to do with pages if they don't have their own page-*.php file.

// Grab the header.
get_header(); ?>

<!-- site-content -->
<div class="site-content clearfix">

	<!-- main-column area -->
	<div class="main-column">

		<?php
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
	
			<!-- Definte the article class for page layout and content. -->
			<article class="post page">
				<?php
		
				// Conditions for child menu behaviour, if the selected page is a child/has children.
				if ( has_children() OR $post->post_parent > 0 ) { ?>
		
					<!-- The new child menu nav element, using *if* logic. -->
					<nav class="site-nav children-links clearfix">
						<span class="parent-link"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a></span>
						<ul>
							<?php
							$args = array(
								'child_of' => get_top_ancestor_id(),
								'title_li' => ''
							);
							?>
							<?php wp_list_pages($args); ?>
						</ul>
					</nav>
			
				<?php } ?>
		
				<!-- Bringing in the basic content blocks (title and content). -->
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</article>
	
			<?php endwhile;
	
			// What to do if there's no content.
			else :
				echo '<p>No content found!</p>';
		
			endif; ?>

	</div><!-- /main-column -->

	<?php get_sidebar(); ?>
	
</div><!-- /site-content -->

<?php
// Grab the footer.
get_footer();
?>