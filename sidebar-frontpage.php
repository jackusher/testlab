<?php
/**
 * The template for the front page sidebar.
 *
 * The area of the page that contains meta links and other information.
 *
 * @package WordPress
 * @subpackage Bubble3
 * @since Bubble3 0.1 alpha
 */
?>

<ul>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-front') ) : endif; ?>
</ul>