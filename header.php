<?php
/**
 * The template for displaying the header.
 *
 * The area of the page that contains links to fonts & scripts, the logo, and header menu.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
		<script src="https://use.fontawesome.com/b5ba9501bd.js"></script>
		<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/append-classes.js"></script><!-- The external class adding file. -->
		<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/masonry-properties.js"></script><!-- The external masonry properies file. -->
	</head>
	
<body <?php body_class(); ?>>
	
	<div class="container">
	
		<header class="header clearfix">
			
			<div class="header-title">	
				<?php if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				} ?>
			</div><!-- /header-title -->
			
			<div class="header-meta">
				<a href="http://www.billfreehomes.com/?utm_source=bubble-header"><img src="https://www.thebubble.org.uk/wp-content/uploads/2017/04/image022.jpg" height="87" width="700"></a>
				<!-- <nav id="header-menu" class="site-nav">
					<?php	
					$args = array(
						'theme_location' => 'header'
					);	
					wp_nav_menu( $args ); ?>
				</nav> -->
			</div><!-- /header-meta -->
			
		</header><!-- /header -->