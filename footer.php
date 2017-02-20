	<!-- Defining the footer class and content in this file. -->
	<footer class="site-footer">
		
		<div class="footer-widgets clearfix"><?php
			// Wonderful code from SimonStaton@stackexchange.
			$args = array(
				'orderby' => 'name',
				'parent' => 0,
				'include' => array(8, 7, 27)
			);
			$categories = get_categories( $args );
			$first = true;
  				foreach ($categories as $category) {
    				if ( $first )
   					{
       					echo '<li class="meta-list clearfix"><a href="' . get_category_link($category->term_id) . '"><h2 class="meta-title">'.$category->cat_name.'</h2></a>';
    					$first = false;
    				}
    				else
    				{
        				echo '<li class="meta-list clearfix"><a href="' . get_category_link($category->term_id) . '"><h2 class="meta-title">'.$category->cat_name.'</h2></a>';
    				}
    				$theid = $category->term_id;
    				$children = $wpdb->get_results( "SELECT term_id FROM $wpdb->term_taxonomy WHERE parent=$theid" );
       					$no_children = count($children);
					if ($no_children > 0) {
        				echo "<ul>";
        				$args2 = array(
        					'orderby' => 'name',
        					'parent' => 2
         				);
        				$args2["parent"]=$category->term_id;
        				$categories2 = get_categories( $args2 );
        					foreach ($categories2 as $category2) {

        						echo '<li><a href="' . get_category_link($category2->term_id) . '">'.$category2->cat_name.'</a></li>';

    						}
        					echo '</ul>';
    					} else {
    					echo '</li>';
						}

					} ?>
		</div>
		
		<div class="footer-meta">
			<!-- Creating a footer menu location for WP admin. -->
			<nav id="footer-menu" class="site-nav">
				<?php	
				$args = array(
					'theme_location' => 'footer'
				);	
				wp_nav_menu( $args ); ?>
			</nav>

			<!-- Creating the 'copyright' div location for copyright info. Define content. -->
			<section class="copyright">
				<p><?php bloginfo('name'); ?>, &copy; <?php echo date('Y');?></p>
			</section>
		</div>
	
	</footer>

</div><!-- /container -->

<?php wp_footer(); ?>

</body>
</html>