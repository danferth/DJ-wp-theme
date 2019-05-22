<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_scripts' ) ) :
	function foundationpress_scripts() {
	//Google fonts Oswald 300,700 & Source Sans Pro 300,400,700
	//<link href='https://fonts.googleapis.com/css?family=Oswald:400,700|Source+Sans+Pro:400,300,700' rel='stylesheet' type='text/css'>
	//wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Oswald:400,700|Source+Sans+Pro:400,300,700' );
	//version for updates
	//$version = '2.4.6';
	$version = time();
	// Enqueue the main Stylesheet.
	wp_enqueue_style( 'main-stylesheet', get_stylesheet_directory_uri() . '/assets/stylesheets/foundation.css', array(), $version, $media = 'all' );

	// Deregister the jquery version bundled with WordPress.
	wp_deregister_script( 'jquery' );

	// Modernizr is used for polyfills and feature detection. Must be placed in header. (Not required).
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/javascript/vendor/modernizr.js', array(), $version, false);

	// Fastclick removes the 300ms delay on click events in mobile environments. Must be placed in header. (Not required).
	wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/assets/javascript/vendor/fastclick.js', array(), $version, false );

	// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), '2.1.0', false );

	//JQ validate
	wp_enqueue_script( 'validate', get_template_directory_uri() . '/assets/javascript/lib/jquery.validate.min.js', array('jquery'), $version, true );

	//JQ waypoints for scroll triggers
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/javascript/lib/jquery.waypoints.min.js', array('jquery'), $version, true );

	//TweenMax for animations
	wp_enqueue_script('TweenMax', get_template_directory_uri() . '/assets/javascript/lib/TweenMax.min.js', array(), $version, true );

	//sweetalert cause it's cool man
	wp_enqueue_script('sweetalert', get_template_directory_uri() . '/assets/javascript/lib/sweetalert.min.js', array(), $version, false);

	//angularjs
	wp_enqueue_script('angular', get_template_directory_uri() . '/assets/javascript/lib/angular.min.js', array(), $version, true);
	//angular-sanitize
	wp_enqueue_script('angular-sanitize', get_template_directory_uri() . '/assets/javascript/lib/angular-sanitize.min.js', array('angular'), $version, true);

	//app.js (angular stuff goes here for now)
	//wp_enqueue_script('app', get_template_directory_uri(). '/assets/javascript/app.js', array('angular'), $version, true);
	//wp_enqueue_script('directives', get_template_directory_uri(). '/assets/javascript/directives.js', array('angular'), $version, true);
	//site.js TIC custome js for pages
	//wp_enqueue_script('site', get_template_directory_uri() . '/assets/javascript/site.js', array('jquery'), $version, true);

	// If you'd like to cherry-pick the foundation components you need in your project, head over to gulpfile.js and see lines 77-99.
	// It's a good idea to do this, performance-wise. No need to load everything if you're just going to use the grid anyway, you know :)
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/javascript/foundation.js', array('jquery'), $version, true );

	// Add the comment-reply library on pages where it is necessary
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	}

	add_action( 'wp_enqueue_scripts', 'foundationpress_scripts' );
endif;

?>
