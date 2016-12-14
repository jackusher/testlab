<!-- secondary-column area -->
	<div class="sidebar-column">
			
			<!-- Putting the main menu in place, and defining a WP admin menu location. -->
			<nav id="sidenav-primary">
				<?php
				$args = array(
					'theme_location' => 'sidebar',
					'walker' => new CSS_Menu_Walker()
				);
				wp_nav_menu( $args ); ?>
			</nav>
			
			<div class="clearer"></div><?php
			
			// Implementing submenu to show subcategories on post and category pages.
			/* if ( is_category() ) {
				if ( is_category() ) {
    				$this_category = get_category($cat);
    				} 
    			if($this_category->category_parent)
    				$this_category = wp_list_categories('orderby=name&show_count=0&title_li=&use_desc_for_title=1&show_option_none=&child_of='.$this_category->category_parent."&echo=0");
    			else
    				$this_category = wp_list_categories('orderby=name&depth=1&show_count=0&title_li=&use_desc_for_title=1&show_option_none=&child_of='.$this_category->cat_ID."&echo=0");
    			if ($this_category) { ?>
					<nav id="sidenav-secondary" class=""><!-- The container element for the submenu. -->
						<ul>
							<?php echo $this_category; ?>
						</ul>
					</nav><!-- /site-subnav --><?php
				}
			
			} else { // If page is NOT a category archive, container <nav> is hidden.
			
				echo '<style type="text/css">
					nav#sidenav-secondary {
						display: none;
					}
					</style>';
			} */

		dynamic_sidebar('sidebar1'); ?>

	</div><!-- /secondary-column -->