<?php

/**
 * Register menu positions
 */

add_action('init', 'd7_register_menus');

function d7_register_menus() {
	register_nav_menus(array(
		'main-nav' => __('Main Nav', 'Admin - ' . get_bloginfo('name')  ),
    // 'secondary-nav' => __('Secondary Nav', 'Admin - ' . get_bloginfo('name')  )
	));
}