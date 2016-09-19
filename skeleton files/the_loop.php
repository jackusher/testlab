<?php

// If we have posts...
if (have_posts()) :

	while (have_posts()) : the_post();
		// Output content however we please here.
	endwhile;
	
	else :
		// Fallback no content message here.
endif;

?>