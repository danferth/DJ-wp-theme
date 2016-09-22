<?php
/*
Template Name: techResult
*/

//grab the tech library item from $_GET[]
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	echo '<script type="text/javascript">
           window.location = "' . home_url("/tl/") . '";
      </script>';
}

//for prefooter
if(get_post_meta($post->ID, "has-prefooter")){
	$prefooter_class = "has-prefooter";
}else{
	$prefooter_class = "";
}

//for angular
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

//for raodmap
$science = $_GET['sci'];

get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div class="row full-page-top <?php echo $prefooter_class; ?>" <?php echo $ng_app . " " . $ng_controller; ?>>
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title" ng-bind-html="pageTitle">Technical Note</h1>
			</header>
	<div class="small-12 large-12 columns" role="main" >

			<div class="entry-content">
				<?php //the_content(); this is normally uncomented and WP adds the content of the page from the db  this page is more for testing so put everything in here that you would mornally and have it just work ?>
			
<!-- =======================START======================= -->

<div class=" tech-APPNOTE row" ng-show="APPNOTE">
	<div class="small-12 column">
		<p ng-bind-html="techNote.id"></p>
		<p ng-bind-html="setType"></p>
		<p ng-bind-html="techNote.title"></p>
		<p ng-bind-html="techNote.description"></p>
	</div>
</div>
      
<!-- ========================END======================== -->
</div><!-- END DIV FOR CONTENT -->
			
			
			<?php comments_template(); ?>
	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>

<?php get_footer(); ?>
