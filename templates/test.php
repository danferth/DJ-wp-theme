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

<div class="full-background show-for-medium-up row" <?php echo do_shortcode('[bgImg src="page/UYF-hero.jpg"]') ?> >
	<div class="science-selection medium-12 column">
		<select name="sub-science">
			<option value="">choose your cell line</option>
			<option value="ecoli"><i>E. coli</i></option>
			<option value="microbial">microbial</option>
			<option value="pick-bactiria">pink backtiria</option>
			<option value="streptomyces">streptomyces</option>
		</select>
	</div>
</div>
<div class="show-for-small-only row">
	<select name="sub-science">
		<option value="">choose your cell line</option>
		<option value="ecoli"><i>E. coli</i></option>
		<option value="microbial">microbial</option>
		<option value="pick-bactiria">pink backtiria</option>
		<option value="streptomyces">streptomyces</option>
	</select>
</div>
  
      
      
      
<!-- ========================END======================== -->
</div><!-- END DIV FOR CONTENT -->
			
			
			<?php comments_template(); ?>
	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>

<?php get_footer(); ?>
