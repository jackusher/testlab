<?php
/**
 * The template for the sidebar.
 *
 * The area of the page that contains the category navigation, and user-defined content.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
?>
 
<div class="sidebar-column">
	
	<nav class="sidebar-navi">
		<?php // Defining <section1> variables.
		$sec1_parent = get_theme_mod( 'title_section1' ); // Pulling in the parent catgeory set in the WP appearance api.
		$sec1_parentID = get_cat_ID( $sec1_parent ); // Getting the cat ID from the name we pulled in.
		$sec1_children = get_categories( // Setting the cat as a PARENT cat.
			array( // There's something we can use from Misha Reyzlin to order cats by recency of their updates (left in bookmarks).
				'parent' => $sec1_parentID,
			)
		); ?>

		<div id="sidebar-menuitem1" class="sidebar-menuitem clearfix">
			<div id="section1-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec1_parent)->name . "</h2>"; ?></div>
			<div id="section1-subcats" class="front-subcats"><?php
				wp_list_categories( array(
					'orderby' => 'name',
					'show_count' => false,
					'title_li' => '',
					'use_dec_for_title' => false,
					'child_of' => $sec1_parentID
				) );?>			
			</div>
		</div><!-- /section1-head -->
		
		<?php // Defining the <section2> variables.
		$sec2_parent = get_theme_mod( 'title_section2' );
		$sec2_parentID = get_cat_ID( $sec2_parent );
		$sec2_children = get_categories(
			array( 'parent' => $sec2_parentID )
		); ?>
	
		<div id="sidebar-menuitem2" class="sidebar-menuitem clearfix">
			<div id="section2-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec2_parent)->name . "</h2>"; ?></div>
			<div id="section1-subcats" class="front-subcats"><?php
				wp_list_categories( array(
					'orderby' => 'name',
					'show_count' => false,
					'title_li' => '',
					'use_dec_for_title' => false,
					'child_of' => $sec2_parentID
				) );?>			
			</div>
		</div><!-- /section2-head -->
		
		<?php // Defining <section3> variables.
		$sec3_parent = get_theme_mod( 'title_section3' ); // Pulling in the parent catgeory set in the WP appearance api.
		$sec3_parentID = get_cat_ID( $sec3_parent ); // Getting the cat ID from the name we pulled in.
		$sec3_children = get_categories( // Setting the cat as a PARENT cat.
			array( // There's something we can use from Misha Reyzlin to order cats by recency of their updates (left in bookmarks).
				'parent' => $sec3_parentID,
			)
		); ?>
	
		<div id="sidebar-menuitem3" class="sidebar-menuitem clearfix">
			<div id="section3-title" class="front-title"><?php echo "<h2>" . get_category_by_slug($sec3_parent)->name . "</h2>"; ?></div>
			<div id="section1-subcats" class="front-subcats"><?php
				wp_list_categories( array(
					'orderby' => 'name',
					'show_count' => false,
					'title_li' => '',
					'use_dec_for_title' => false,
					'child_of' => $sec3_parentID
				) );?>			
			</div>		
		</div><!-- /section3-head -->
		
	</nav><!-- /sidebar-navi -->
	
	<ul>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-single') ) : endif; ?>
	</ul>

</div><!-- /sidebar-column -->