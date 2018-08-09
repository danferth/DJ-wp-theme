<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

//for loader
$pageloader = "<!-- page loader not needed for this page -->";
if(get_post_meta($post->ID, "pageloader", true)){
	$pageloader = "<div class='loader'>
  <div class='loaderAnimation'>
    <i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i>
  </div>
  </div>
</div>";
}


?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/icons/favicon.ico?v=2" type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/images/icons/apple-touch-icon-144x144-precomposed.png?v=3">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/images/icons/apple-touch-icon-114x114-precomposed.png?v=3">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/images/icons/apple-touch-icon-72x72-precomposed.png?v=3">
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/assets/images/icons/apple-touch-icon-precomposed.png?v=3">

		<?php wp_head(); ?>
		
		<!-- structured data -->
		<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name" : "Thomson Instrument Company",
  "url" : "https://htslabs.com",
  "sameAs" : [
  	"https://www.linkedin.com/company/thomson-instrument",
  	"https://twitter.com/tic_2017"
  ],
  "logo": "https://htslabs.com/wp-content/themes/TIC/images/TIC-logo-black.png",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+1-760-757-8080",
    "contactType": "customer service"
  },{
    "@type": "ContactPoint",
    "telephone": "+1-800-541-4792",
    "contactType": "customer service",
    "contactOption": [
      "TollFree"
    ]
  }]
}
</script>
	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>
<!-- loader -->
<?php echo $pageloader; ?>
<!-- end loader -->
<div class="railNav">
	<ul>
		<li><a href="https://twitter.com/tic_2017" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
		<li><a href="/tl/"><i class="fa fa-line-chart" aria-hidden="true"></i></a></li>
		<li><a href="https://www.linkedin.com/company/thomson-instrument" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	</ul>
</div>
	<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>

	<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<?php get_template_part('parts/top-search'); ?>
	<?php

		if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) :
		get_template_part( 'parts/off-canvas-menu' );
		endif;
	?>
	<?php get_template_part( 'parts/top-bar' ); ?>

<section class="container" role="document">
	<?php do_action( 'foundationpress_after_header' ); ?>
