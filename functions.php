<?php
/**
 * The theme functions file.
 *
 * The file that contains all functions for additional template features.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */

/* SECTION I: Calling theme stylesheets and scripts. */
function get_theme_scripts() {
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('masonry');
	wp_enqueue_style('masonry');
	wp_enqueue_script('jquery');
	// wp_enqueue_script('masonryLoader', get_template_directory_uri() . '/js/masonry.js', array('masonry', 'jquery') );
}
add_action('wp_enqueue_scripts', 'get_theme_scripts');



/* SECTION II: Function to get categeory ancestor. Used in deprecated page submenus. */
function get_top_ancestor_id() {
	global $post;
	if ($post->post_parent) {
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		return $ancestors[0];
	}
	return $post->ID;
}



/* SECTION III: Does page have children? function. Used within deprecated page submenus. */
function has_children() {
	global $post;
	$pages = get_pages('child_of=' . $post->ID);
	return count($pages);
}



/* SECTION IV: Theme setup, implementing pre-requisites. */
function bubble_setup() {

	/* IV.a. Registering navigation menu locations. */
		register_nav_menus(array(
			'header' => __( 'Header Menu', 'bubble3'),
			'sitemap' => __( 'Footer Sitemap', 'bubble3' ),
			'footer' => __( 'Footer Menu', 'bubble3')
		));
	
	/* IV.b. Adding image sizes. */
	add_theme_support('post-thumbnails');
	add_image_size('featured-level1-column-thumbnail', 920, 250, true);
	add_image_size('featured-level2-column-thumbnail', 290, 150, true);
	add_image_size('masonry-thumbnail', 245, 184, true);
	add_image_size('title-list-thumbnail', 163, 123, true);
	add_image_size('column-thumbnail', 120, 100, true);
	add_image_size('banner-image', 920, 210, true);
	add_image_size('standard-blog-thumbnail', 178, 132, true);
	add_image_size('front-latest', 358, 240, true);
	add_image_size('archive-top', 500, 240, true);
	add_image_size('archive-article', 235, 170, true);
	add_image_size('archive-second', 235, 240, true);
	
	/* IV.c. Adding post formats. */
	add_theme_support('post-formats', array('gallery'));
	
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'automatic-feed-links' );
	
}

add_action('after_setup_theme', 'bubble_setup');



/* SECTION V: Defining theme widget locations. */
function bubble_widgets() {

	if( function_exists('register_sidebar') ) {

		register_sidebar( array(
			'name' => 'Front Page Sidebar',
			'id' => 'sidebar-front',
			'before_widget' => '<div class = "widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class = "widget-title">',
			'after_title' => '</h4>'
		));
		
		register_sidebar( array(
			'name' => 'Single Page Sidebar',
			'id' => 'sidebar-single',
			'before_widget' => '<div class = "widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class = "widget-title">',
			'after_title' => '</h4>'
		));
			
	}
	
}

add_action('widgets_init', 'bubble_widgets');



/* SECTION VI: WP_Customize API settings. */
/* VI.a. Function to pull site categories in to substantiate Customize calls to categories. */
function get_categories_select() {
	$teh_cats = get_categories();
	$results;
	$count = count($teh_cats);
	for ($i=0; $i < $count; $i++) {
		if (isset($teh_cats[$i]))
			$results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
		else
			$count++;
		}
	return $results;
}

/* VI.b. WP_Customize API settings, sections, controls. */
function bubble_customise_register( $wp_customize ) {
	
	// WP appearance settings.
	$wp_customize->add_setting('bubble_global_link_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_setting('bubble_menu_button_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_setting('editor_pick_accent', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_setting('editor_pick_dark_accent', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_setting('editor_pick_author_accent', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_setting('front_full', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_category',
	));	
	
	$wp_customize->add_setting('title_section1', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_category',
	));
	
	$wp_customize->add_setting('title_section2', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_category',
	));
	
	$wp_customize->add_setting('title_section3', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_category',
	));
	
	$wp_customize->add_setting('bottom_section', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_category',
	));			
	
	// WP appearance sections.
	$wp_customize->add_section('bubble_site_colors', array(
		'title' => __('Site Colours', 'bubble3'),
		'priority' => 30
	));
	
	$wp_customize->add_section('bubble_front_cats', array(
		'title' => __('Front Page Categories', 'bubble3'),
		'priority' => 120
	));
	
	// WP appearance controls.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bubble_global_link_color_control', array (
		'label' => __('Global Link Color', 'bubble3'),
		'section' => 'bubble_site_colors',
		'settings' => 'bubble_global_link_color'
	)));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bubble_menu_button_color_control', array (
		'label' => __('Menu Button Color', 'bubble3'),
		'section' => 'bubble_site_colors',
		'settings' => 'bubble_menu_button_color'
	)));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'editor_pick_accent_color_control', array (
		'label' => __('Editors Picks Accent', 'bubble3'),
		'section' => 'bubble_site_colors',
		'settings' => 'editor_pick_accent'
	)));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'editor_pick_dark_accent_color_control', array (
		'label' => __('Editors Picks Dark Accent', 'bubble3'),
		'section' => 'bubble_site_colors',
		'settings' => 'editor_pick_dark_accent'
	)));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'editor_pick_author_accent_color_control', array (
		'label' => __('Editors Picks Author Accent', 'bubble3'),
		'section' => 'bubble_site_colors',
		'settings' => 'editor_pick_author_accent'
	)));
	
	$wp_customize->add_control( 'front_full', array(
		'settings' => 'front_full',
		'label' => 'Full-Length Section 1',
		'section' => 'bubble_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));	
	
	$wp_customize->add_control( 'title_section1', array(
		'settings' => 'title_section1',
		'label' => 'Title Section 1',
		'section' => 'bubble_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));
	
	$wp_customize->add_control( 'title_section2', array(
		'settings' => 'title_section2',
		'label' => 'Title Section 2',
		'section' => 'bubble_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));
	
	$wp_customize->add_control( 'title_section3', array(
		'settings' => 'title_section3',
		'label' => 'Title Section 3',
		'section' => 'bubble_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));
	
	$wp_customize->add_control( 'bottom_section', array(
		'settings' => 'bottom_section',
		'label' => 'Bottom Section',
		'section' => 'bubble_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));			
}

add_action('customize_register', 'bubble_customise_register');

/* VI.c. Defining the CSS elements targeted by $wp_customize settings. */
function bubble_customise_css() { ?>
	
	<style type="text/css">
		
		a:link,
		a:visited {
			color: <?php echo get_theme_mod('bubble_global_link_color'); ?>;
		}
		
		.recent-head,
		.sidebar-menuitem {
			background-color: <?php echo get_theme_mod('bubble_menu_button_color'); ?>;
		}
		
		.editor-pick .recent-blurb {
			background-color: <?php echo get_theme_mod('editor_pick_accent'); ?>;
		}
		
		.editor-pick .recent-meta {
			background-color: <?php echo get_theme_mod('editor_pick_dark_accent'); ?>;
		}
		
		h4.front-full-article-author a {
			background-color: <?php echo get_theme_mod('editor_pick_author_accent'); ?>;
		}
		
	</style>
	
<?php }

add_action('wp_head', 'bubble_customise_css');



/* SECTION VII: Add support for menu search location (HTML5). */
add_theme_support('html5', array('search-form'));



/* SECTION VIII: Storing most-recently updated subcatgeories of parents in a global array. */

/* SECTION VIII.i: Function to compares two arrays by their "date" field. */
function compareDates($a, $b) {
	if ( $a['date'] == $b['date'] ) {
		return 0;
	}
		return ($a['date'] < $b['date']) ? 1 : -1;
	}

/* SECTION VIII.ii: Looping through the parent categories and their subcategories to populate
				  global arrays with the parents' subcategories ordered by recency of their updates. */
$category_parents = array(
		get_theme_mod( 'title_section1' ),
		get_theme_mod( 'title_section2' ),
		get_theme_mod( 'title_section3' )
	);

foreach($category_parents as $category_parent) {

	$category_ID = get_cat_ID( $category_parent );
	$categories = get_categories(
		array(
			'parent' => $category_ID,
		)
	);

	$GLOBALS[$category_parent] = array();

	// Loop through categories.
	foreach($categories as $category ) {

		$post_args = array(
			'orderby' => 'post_date',
			'order' => 'DESC',
			'showposts' => 1,
			'category__in' => array($category->term_id),
			'ignore_sticky_posts' => true
		);

		// Retrieve the latest post.
		query_posts( $post_args );

		// Cache latest posts data.
		while ( have_posts() ) : the_post();
			$GLOBALS[$category_parent][$category->slug] = array(
				'date' => get_the_time('U'),
				'category' => $category,
				'post' => $post
			);

		endwhile;

		// Resetting query.
		wp_reset_query();

	}
	
	// Sort the category arrays using our function.
	usort($GLOBALS[$category_parent], "compareDates");
	
	// Resetting query.
	wp_reset_query();
	
}



/* SECTION IX: Defining content width. */
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}



/* SECTION X: Adding custom logo support. */
function bubble_custom_logo_setup() {
    $defaults = array(
        'height'      => 90,
        'width'       => 311,
        'flex-height' => false,
        'flex-width'  => false,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'bubble_custom_logo_setup' );