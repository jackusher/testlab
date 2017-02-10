<?php if ( in_category( 36 ) ) {
	?><div id="archive-article" class="front-article <?php if (in_array($arch_counter, $img)) echo 'small'; ?> editor-pick"><!-- Start of looped post content. --><?php					
} else {
	?><div id="archive-article" class="front-article <?php if (in_array($arch_counter, $img)) echo 'small'; ?>"><!-- Start of looped post content. --><?php
} ?>

	<div id="archive-thumb" class="front-thumb"><!-- Thumbnails, including countpost logic. -->
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-top'); ?></a>
	</div><!-- /archive-thumb -->

	<div id="archive-info" class="front-info"><!-- Post titles and excerpts. -->
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php
		the_excerpt(); ?>
	</div><!-- /archive-info -->

	<div id="archive-cat" class="front-artcat"><!-- Post categories. -->
		<p id="archive-auth" class="front-auth">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></p>
	</div><!-- /archive-cat -->

</div><!-- /archive-article -->