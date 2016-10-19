<?php

if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
    } );
  return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

  function __construct() {
    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    parent::__construct();
  }

  function add_to_context( $context ) {
    $context['site'] = $this;
        $context['footer_menu'] = new TimberMenu('footer');
        $context['main_menu'] = new TimberMenu('main-menu');

        // ACF Options
        // Usage: {{ options.optionname }
        $context['options'] = get_fields('option');

        // Add popular trips - used in mega menu
        $popular_trip_args = array(
            'post_type' => 'trip',
            'posts_per_page' => -1,
            'meta_query' => array(
              array(
                'key'     => 'trip_popular',
                'value'   => 1,
                'compare' => '=',
              ),
            ),
        );

        $context['popular_trips'] = Timber::get_posts( $popular_trip_args );

        // Add type taxonomy - used in mega menu
        $context['trip_types'] = Timber::get_terms('type');

        // Add region taxonomy - used in mega menu
        $context['trip_regions'] = Timber::get_terms('region');

        // Add Random Canadian Insider
        $insider_args = array(
            'post_type' => 'canadian_insider',
            'posts_per_page' => 1,
            'orderby' => 'rand'
        );
        $context['insider'] = Timber::get_posts( $insider_args );
        return $context;
  }

  function myfoo( $text ) {
    $text .= ' bar!';
    return $text;
  }

  function add_to_twig( $twig ) {
    /* this is where you can add your own fuctions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
    return $twig;
  }

}

new StarterSite();