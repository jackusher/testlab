	<!-- Defining the footer class and content in this file. -->
	<footer class="site-footer">
		
		<!-- Creating a footer menu location for WP admin. -->
		<nav class="site-nav">
			<?php	
			$args = array(
				'theme_location' => 'footer'
			);				
			?>	
			<?php wp_nav_menu(  $args ); ?>
		</nav>

		<!-- Creating the 'copyright' div location for copyright info. Define content. -->
		<div class="copyright">
			<p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y');?></p>
		</div>
	
	</footer>

</div><!-- /container -->

<?php wp_footer(); ?>

</body>
</html>