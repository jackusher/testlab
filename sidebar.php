<!-- secondary-column area -->
	<div class="sidebar-column"><?php
	
		$category = get_the_category(); 
		$category_parent_id = $category[0]->category_parent;
		if ( $category_parent_id != 0 ) {
   			$category_parent = get_term( $category_parent_id, 'category' );
			$css_slug = $category_parent->name;
		} else {
    		$css_slug = $category[0]->name;
		}

		if ( is_category() ) {
			if ( is_category() ) {
				$this_category = get_category($cat);
				} 
			if($this_category->category_parent)
				$this_category = wp_list_categories('orderby=name&show_count=0&title_li=&use_desc_for_title=1&show_option_none=&child_of='.$this_category->category_parent."&echo=0");
			else
				$this_category = wp_list_categories('orderby=name&depth=1&show_count=0&title_li=&use_desc_for_title=1&show_option_none=&child_of='.$this_category->cat_ID."&echo=0");
			if ($this_category) { ?>
				<nav id="site-sidenav" class="site-nav"><!-- The container element for the submenu. -->
					<h2><?php echo $css_slug; ?></h2>
					<ul>
						<?php echo $this_category; ?>
					</ul>
				</nav><!-- /site-subnav --><?php
			} }

		dynamic_sidebar('sidebar1'); ?>

	</div><!-- /secondary-column -->