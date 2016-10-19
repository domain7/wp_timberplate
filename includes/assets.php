<?php

/**
 * Change the stylesheet url to our compiled stylesheet from Sassyplayte
 */

function d7_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri){
	return $stylesheet_dir_uri . '/dist/styles/style.css';
}
add_filter('stylesheet_uri', 'd7_stylesheet_uri', 10, 2);

/**
 * Use wp_enqueue to add theme stylesheet & js to wp_head()
 */

function d7_enqueue_styles_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style('theme-stylesheet',  get_bloginfo( 'stylesheet_url' ) );

	wp_enqueue_script( 'application-head', get_template_directory_uri() . '/dist/js/application-head.js', array(), '1.0.0', false );
	wp_enqueue_script( 'application', get_template_directory_uri() . '/dist/js/application.js', array(), '1.0.0', true );

	$wp_object = array(
		'templateUrl' => get_bloginfo('template_url'),
		'stylesheetUrl' => get_bloginfo('stylesheet_url'),
		'stylesheetDirectory' => get_bloginfo('stylesheet_directory'),
		'siteName' => get_bloginfo('name'),
		'description' => get_bloginfo('description'),
		'currentTheme' => wp_get_theme(),
		'url' => get_bloginfo('url'),
	);

	wp_localize_script('application', 'D7WP', $wp_object);

	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'd7_enqueue_styles_scripts', 15 );