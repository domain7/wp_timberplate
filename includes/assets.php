<?php

/**
 * Change the stylesheet url to our compiled stylesheet from Sassyplayte
 *
 * @package d7
 * @subpackage boilerplate-theme_filters+hooks
 * @internal only called as `stylesheet_uri` filter
 * @link https://bitbucket.org/domain7/sassyplate Sassyplate SASS boilerplate repo
 *
 */

function d7_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri){
  return $stylesheet_dir_uri . '/dist/styles/style.css';
}
add_filter('stylesheet_uri', 'd7_stylesheet_uri', 10, 2);

/**
 * Use wp_enqueue to add theme stylesheet to wp_head()
 *
 * @package d7
 * @subpackage boilerplate-theme\filters+hooks
 * @uses d7_stylesheet_uri()
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 * @internal the '15' in the add_action forces the file to load after the other styles in wp_head().
 *
 */

function d7_enqueue_styles_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_style('theme-stylesheet',  get_bloginfo( 'stylesheet_url' ) );
    wp_enqueue_script( 'application-head', get_template_directory_uri() . '/dist/js/application-head.js', array(), '1.0.0', false );
    wp_enqueue_script( 'application', get_template_directory_uri() . '/dist/js/application.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'd7_enqueue_styles_scripts', 15 );