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
<!-- ==============APPNOTE==================== -->
<div class=" tech-APPNOTE row" ng-show="APPNOTE">
	<div class="small-12 medium-8 large-10 column">
		<h2 class="tech-title" ng-bind-html="techNote.title"></h2>
		<p class="tech-description" ng-bind-html="techNote.description"></p>
		<p class="tech-citation" ng-bind-html="techNote.citation"></p>
		<p><a href="<?php echo content_url('/uploads/downloads/'); ?>{{ techNote.link }}">Download <i class="fa fa-file-pdf-o"></i> now</a></p>
	</div>
</div>
<!-- ==============VIDEO==================== -->
<div class=" tech-VIDEO row" ng-show="VIDEO">
	<div class="small-12 flex-video column">
		<video controls="" muted="" autoplay="autoplay">
	<source ng-src="<?php echo content_url('/uploads/video/videos/'); ?>{{ trustedVideoURL }}.mp4" type="video/mp4">
		<!--<img ng-src="<?php //echo content_url('/uploads/video/thumbs/'); ?>{{ techNote.image }}" alt="{{ techNote.description }}" title="No video playback capabilities, please download the video below">-->
</video>
	</div>
	
	<div class="small-12 column">
		<h2 class="tech-title" ng-bind-html="techNote.title"></h2>
		<p class="tech-description" ng-bind-html="techNote.description"></p>
		<p class="tech-citation" ng-bind-html="techNote.citation"></p>
		<p><a href="<?php echo content_url('/uploads/video/videos/'); ?>{{ techNote.link }}.mp4">Download <i class="fa fa-file-video-o"></i> now</a></p>
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
