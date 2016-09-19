<!--
content-gallery.php defines what to do with posts (single or in list) of gallery type.
-->

<article class="post post-gallery">

	<h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
	<?php the_content(); ?>

</article>