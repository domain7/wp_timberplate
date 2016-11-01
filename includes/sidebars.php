<?php

/**
 * Register Sidebars
 */

add_action('widgets_init', 'd7_register_sidebars');

function d7_register_sidebars() {
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Primary Sidebar', 'Admin - ' . get_bloginfo('name')  ),
			'class' => 'foo',
			'description' => __( 'The following widgets will appear in the main sidebar div.', 'Admin - ' . get_bloginfo('name') ),
			'before_widget' => '<div id="%1$s" class="widget widget--%2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget__title">',
			'after_title' => '</h4><div class="widget__body">'
		)
	);
}