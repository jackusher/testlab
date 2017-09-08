<?php
/**
 * The template for the site footer.
 *
 * The area of the page that contains the sitemap, meta links, and the copyright notice.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
?>
	<footer class="footer">
		
		<nav class="sitemap clearfix">
			<?php $args = array(
				'theme_location' => 'sitemap'
			);	
			wp_nav_menu( $args ); ?>
		</nav>
		
		<div class="footer-meta">

			<nav id="footer-menu" class="site-nav">
				<?php	
				$args = array(
					'theme_location' => 'footer'
				);	
				wp_nav_menu( $args ); ?>
			</nav>

			<section class="copyright">
				<p><?php bloginfo('name'); ?>, &copy; <?php echo date('Y');?></p>
			</section>
			
		</div><!-- /footer-meta -->
	
	</footer><!-- /footer -->

</div><!-- /container -->

<?php wp_footer(); ?>

</body>
</html>