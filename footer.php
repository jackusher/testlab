	<!-- Defining the footer class and content in this file. -->
	<footer class="site-footer">
		
		<!-- footer-widgets -->
		<div class="footer-widgets clearfix">
			
			<?php if (is_active_sidebar('footer1')) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
			<?php endif; ?>
			
			<?php if (is_active_sidebar('footer2')) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
			<?php endif; ?>
			
			<?php if (is_active_sidebar('footer3')) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar('footer3'); ?>
				</div>
			<?php endif; ?>
			
			<?php if (is_active_sidebar('footer4')) : ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar('footer4'); ?>
				</div>
			<?php endif; ?>
		
		</div><!-- /footer-widgets -->
		
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

</div><!-- container -->

<?php wp_footer(); ?>

</body>
</html>