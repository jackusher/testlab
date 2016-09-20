<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<!-- This file defines the content and behaviour of the theme header. -->
	<!-- Putting header information in place, including fonts. -->
	<head>
		<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/masonry-properties.js"></script><!-- The external masonry properies file. -->
	</head>
	
<body <?php body_class(); ?>>

	<!-- The div 'container' includes all visible site content inside the margins. -->
	<div class="container">
	
		<!-- site-header begins. -->
		<header class="site-header">
		
			<!-- Behaviour of the text-based site title and tagline. -->		
			<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<h5><?php bloginfo('description'); ?> <?php if (is_page('contact-us')) {?>
				- Learn how to contact me!
			<?php }?></h5>
			
			<!-- Putting the main menu in place, and defining a WP admin menu location. --> 
			<nav class="site-nav">
				<?php
				$args = array(
					'theme_location' => 'primary'
				); ?>
				<!-- header-search section. -->
				<div class="header-search">
					<?php get_search_form(); ?>
				</div><!-- /header-search -->
				<?php wp_nav_menu(  $args ); ?>
			</nav>
			
		</header><!-- /site-header -->