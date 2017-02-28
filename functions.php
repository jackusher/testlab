<?php
// All theme functions are defined in this file.

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
function testlab_setup() {

	/* IV.a. Registering navigation menu locations. */
		register_nav_menus(array(
			'header' => __( 'Header Menu', 'testbench'),
			'footer' => __( 'Footer Menu', 'testbench')
		));
	
	/* IV.b. Adding image sizes. */
	add_theme_support('post-thumbnails');
	add_image_size('featured-level1-column-thumbnail', 920, 250, true);
	add_image_size('featured-level2-column-thumbnail', 290, 150, true);
	add_image_size('masonry-thumbnail', 245, 184, true);
	add_image_size('title-list-thumbnail', 163, 123, true);
	add_image_size('column-thumbnail', 120, 100, true);
	add_image_size('banner-image', 920, 210, true);
	add_image_size('standard-blog-thumbnail', 170, 124, true);
	add_image_size('front-latest', 358, 240, true);
	add_image_size('archive-top', 500, 240, true);
	add_image_size('archive-article', 235, 170, true);
	add_image_size('archive-second', 235, 240, true);
	
	/* IV.c. Adding post formats. */
	add_theme_support('post-formats', array('gallery'));
	
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'automatic-feed-links' );
	
}

add_action('after_setup_theme', 'testlab_setup');



/* SECTION V: Defining theme widget locations. */
function testlab_widgets() {

	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar1',
		'before_widget' => '<div class = "sidebar-widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class = "sidebar-widget-title">',
		'after_title' => '</h4>'
	));
}

add_action('widgets_init', 'testlab_widgets');



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
function testlab_customise_register( $wp_customize ) {
	
	// WP appearance settings.
	$wp_customize->add_setting('tl_link_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_setting('tl_button_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_setting('front_third_section1', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_string',
	));
	
	$wp_customize->add_setting('front_third_section2', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_string',
	));
	
	$wp_customize->add_setting('front_full', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_string',
	));	
	
	$wp_customize->add_setting('title_section1', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_string',
	));
	
	$wp_customize->add_setting('title_section2', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_string',
	));
	
	$wp_customize->add_setting('title_section3', array(
		'default' => 'uncategorized',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_string',
	));		
	
	// WP appearance sections.
	$wp_customize->add_section('tl_standard_colors', array(
		'title' => __('Standard Colours', 'testbench'),
		'priority' => 30
	));
	
	$wp_customize->add_section('tl_front_cats', array(
		'title' => __('Front Page Categories', 'testbench'),
		'priority' => 120
	));
	
	// WP appearance controls.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tl_link_color_control', array (
		'label' => __('Link Color', 'testbench'),
		'section' => 'tl_standard_colors',
		'settings' => 'tl_link_color'
	)));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tl_button_color_control', array (
		'label' => __('Button Color', 'testbench'),
		'section' => 'tl_standard_colors',
		'settings' => 'tl_button_color'
	)));
	
	$wp_customize->add_control( 'front_third_section1', array(
		'settings' => 'front_third_section1',
		'label' => 'Third-Length Column 1',
		'section' => 'tl_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));
	
	$wp_customize->add_control( 'front_third_section2', array(
		'settings' => 'front_third_section2',
		'label' => 'Third-Length Column 2',
		'section' => 'tl_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));
	
	$wp_customize->add_control( 'front_full', array(
		'settings' => 'front_full',
		'label' => 'Full-Length Section',
		'section' => 'tl_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));	
	
	$wp_customize->add_control( 'title_section1', array(
		'settings' => 'title_section1',
		'label' => 'Title Section 1',
		'section' => 'tl_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));
	
	$wp_customize->add_control( 'title_section2', array(
		'settings' => 'title_section2',
		'label' => 'Title Section 2',
		'section' => 'tl_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));
	
	$wp_customize->add_control( 'title_section3', array(
		'settings' => 'title_section3',
		'label' => 'Title Section 3',
		'section' => 'tl_front_cats',
		'type' => 'select',
		'choices' => get_categories_select()
	));		
}

add_action('customize_register', 'testlab_customise_register');

/* VI.c. Defining the CSS elements targeted by $wp_customize settings. */
function testlab_customise_css() { ?>
	
	<style type="text/css">
		
		a:link,
		a:visited {
			color: <?php echo get_theme_mod('tl_link_color'); ?>;
		}
		
	</style>
	
<?php }

add_action('wp_head', 'testlab_customise_css');



/* SECTION VII: Add support for menu search location (HTML5). */
add_theme_support('html5', array('search-form'));
add_filter('wp_nav_menu_items', 'add_search_form_to_menu', 10, 2);

function add_search_form_to_menu($items, $args) { // Note that this function MAY be causing issues in Safari. Consider replacing with static searchform.php.
	if( !($args->theme_location == 'primary') )
		return $items;
	return $items . '<li class="my-nav-menu-search">' . get_search_form(false) . '</li>';
}



/* SECTION VIII: Popular posts widget. Thanks to Jeff Starr for the code:
   DIY Popular Posts @ https://digwp.com/2016/03/diy-popular-posts/ */
function shapeSpace_popular_posts($post_id) {
	$count_key = 'popular_posts';
	$count = get_post_meta($post_id, $count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($post_id, $count_key);
		add_post_meta($post_id, $count_key, '0');
	} else {
		$count++;
		update_post_meta($post_id, $count_key, $count);
	}
}
function shapeSpace_track_posts($post_id) {
	if (!is_single()) return;
	if (empty($post_id)) {
		global $post;
		$post_id = $post->ID;
	}
	shapeSpace_popular_posts($post_id);
}
add_action('wp_head', 'shapeSpace_track_posts');



/* SECTION IX: Custom WP menu walker class. */
class CSS_Menu_Walker extends Walker {

	var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');
	
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}
	
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	
		global $wp_query;
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		
		/* Add active class */
		if (in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
			unset($classes['current-menu-item']);
		}
		
		/* Check for children */
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (!empty($children)) {
			$classes[] = 'has-sub';
		}
		
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';
		
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		
		$attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
		$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
		$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
		$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;
		
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
	
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}



/* SECTION X: Storing most-recently updated subcatgeories of parents in a global array. */
$category_parent = get_theme_mod( 'title_section1' ); // Pulling in the parent catgeory set in the WP appearance api.
$category_ID = get_cat_ID( $category_parent );
$categories = get_categories(
	array(
		'parent' => $category_ID,
	)
);

$GLOBALS['catsArray'] = array();

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
		$GLOBALS['catsArray'][$category->slug] = array(
			'date' => get_the_time('U'),
			'category' => $category,
			'post' => $post
		);

	endwhile;

	// Resetting query.
	wp_reset_query();

}

// Compares two arrays by their "date" field.
function compareDates($a, $b) {
	if ( $a['date'] == $b['date'] ) {
		return 0;
	}
		return ($a['date'] < $b['date']) ? 1 : -1;
	}

// Sort using defined function.
usort($GLOBALS['catsArray'], "compareDates");