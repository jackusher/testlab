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
		<!-- <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/sliding-mainmenu.js"></script> -->
	</head>
	
<body <?php body_class(); ?>>
	
	<!-- The div 'container' includes all visible site content inside the margins. -->
	<div class="container">
	
		<!-- site-header begins. -->
		<header class="site-header">
		
			<!-- Behaviour of the text-based site title and tagline. -->		
			<div class="header-info clearfix">
				<div class="header-title">	
					<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
					<h5><?php bloginfo('description'); ?> <?php if (is_page('contact-us')) {?>
						- Learn how to contact me!
					<?php }?></h5>
				</div><!-- /header-title -->
				
				<div class="header-login">
					<span class="subtle-login"><a href="<?php echo get_home_url() . '/wp-login.php' ?>">Login</a></span>
				</div><!-- /header-login -->
			</div><!-- /header-info -->
			
			<!-- Putting the main menu in place, and defining a WP admin menu location. --> 
			<nav class="site-nav">
				<?php
				$args = array(
					'theme_location' => 'primary',
					'walker' => new CSS_Menu_Walker()
				);
				wp_nav_menu( $args ); ?>
			</nav><?php
			
			$term = get_queried_object();
			$children = get_terms( $term->taxonomy, array(
				'parent'    => $term->term_id,
				'hide_empty' => false
			) );
			// print_r($children); // Uncomment for debugging.
			if($children && is_category() ) { ?>
			
    			<nav id="site-subnav" class="site-nav">
					<ul><?php
						wp_list_categories(
   							array(
    							'child_of' => get_queried_object_id(), // this will be ID of current category in a category archive
  		  						'style' => 'none',
  		  						'depth' => 2,
  		  						'title_li' => '',
    							'orderby' => 'name',
    							'show_option_none' => '',
    							'style' => 'list'
    						)
						); ?>
					</ul>
				</nav> <?php
				
			} else {
			
				echo '<style type="text/css">
					.site-subnav {
						display: none;
					}
					</style>';
			} ?>
			
		</header><!-- /site-header -->