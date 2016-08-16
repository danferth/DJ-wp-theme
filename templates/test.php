<?php
/*
Template Name: test
*/
if(get_post_meta($post->ID, "has-prefooter")){
$prefooter_class = "has-prefooter";
}else{
	$prefooter_class = "";
}

$ng_app = "";
if(get_post_meta($post->ID, "ng-app")){
$ngApp = get_post_meta($post->ID, "ng-app", true);
$ng_app = "ng-app='" . $ngApp . "'";
}

$ng_controller = "";
if(get_post_meta($post->ID, "ng-controller")){
$ngController = get_post_meta($post->ID, "ng-controller", true);
$ng_controller = "ng-controller='" . $ngController . "'";
}

$science = $_GET['sci'];

get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div class="row full-page-top <?php echo $prefooter_class; ?>">
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
	<div class="small-12 large-12 columns" role="main" <?php echo $ng_app . " " . $ng_controller; ?>>

			<div class="entry-content">
				<?php //the_content(); this is normally uncomented and WP adds the content of the page from the db  this page is more for testing so put everything in here that you would mornally and have it just work ?>
			
<!-- =======================START======================= -->

<?php 

echo "get_home_url(); | " . get_home_url() . "</br>";
echo "home_url() | " . home_url() . "</br>";

echo "</br></br>";
echo "get_home_url('/test'); | " . get_home_url('/test') . "</br>";
echo "home_url('/test') | " . home_url('/test') . "</br>";


echo "</br></br>";
echo "includes_url() | " . includes_url() . "</br>";
echo "content_url(); | " . content_url() . "</br>";
echo "content_url('/myfolder/'); | " . content_url('/myfolder/') . "</br>";
echo "plugins_url() | " . plugins_url() . "</br>";

echo "</br></br>";
echo "<pre>";
echo "wp_upload_dir(); | " . print_r(wp_upload_dir()) . "</br>";
echo "</pre>";

echo "</br></br>";
$content_url = wp_upload_dir();
$prod_url = $content_url['url'];
echo $prod_url;
?>
  
      
      
      
<!-- ========================END======================== -->
</div><!-- END DIV FOR CONTENT -->
			
			
			<?php comments_template(); ?>
	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>

<?php get_footer(); ?>
