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
$ng_controller = "";
if(get_post_meta($post->ID, "ng-controller")){
	$ngController = get_post_meta($post->ID, "ng-controller", true);
	$ng_controller = "ng-controller='" . $ngController . "'";
}

//for raodmap
$science = $_GET['sci'];

get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div id="tech_result_page" class="row full-page-top" ng-app="tic" ng-controller="ticController" ng-strict-di>
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>" <?php echo $ng_controller; ?>>
			<header>
				<h1 class="entry-title" ng-bind-html="pageTitle">Technical Note</h1>
				<div class="tweet-header-module animated">
					<span class="tweet-link">
						<a
							href="https://twitter.com/share"
							class="twitter-share-button"
							data-text="Check out this application note from Thomson!"
							data-url="<?php	true_url(); ?>"
							data-hashtags="science,TICscience"
							data-show-count="false">
							Tweet
						</a>
						<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					</span>
				</div>
			</header>
	<div class="small-12 large-12 columns" role="main" >

			<div class="entry-content">
				<?php //the_content(); this is normally uncomented and WP adds the content of the page from the db  this page is more for testing so put everything in here that you would mornally and have it just work ?>
			
<!-- =======================START======================= -->
<!-- ==============PDF's==================== -->
<div class="tech-PDF row" ng-show="PDF">
  <div class="pdfDownloadWrap small-12 medium-4 large-3 column">
			<a class="pdfDownloadIcon" href="<?php echo content_url('/uploads/downloads/'); ?>{{ techNote.link }}"><i class=" down fa fa-download"></i></a>
		<div class="pdfDownloadText">click <i class="fa fa-arrow-up"></i> to download <i class=" file fa fa-file-pdf-o"></i>
		</div>
  </div>
	<div class="small-12 medium-8 large-9 column">
		<h2 class="tech-title" ng-bind-html="techNote.title"></h2>
		<p class="tech-description" ng-bind-html="techNote.description" ng-hide="!techNote.description"><i class='fa fa-spinner' aria-hidden='true'></i></p>
		<p class="tech-citation" ng-bind-html="techNote.citation" ng-hide="!techNote.citation"><i class='fa fa-spinner' aria-hidden='true'></i></p>
		<p class="tech-share">
		  <a class='tech-share-mailto' href='mailto:&subject={{techNote.title}}%20PDF%20Link&body=Download%20the%20PDF%20for%20{{techNote.title}}%20with%20the%20link%20below.%0Ahttps:htslabs.com/wp-content/uploads/downloads/{{techNote.link}}'>
		    <i class='fa fa-envelope' arie-hidden='true' title="Email this PDF!"></i>
		  </a>
		  <a
		  	href="https://twitter.com/share"
		  	class="twitter-share-button"
		  	data-text="Check out this application note from Thomson!"
		  	data-url="<?php	true_url(); ?>"
		  	data-hashtags="TICscience"
		  	data-show-count="false">
		  	Tweet
		  </a>
		  <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</p>
	</div>
</div>


<!-- ==============VIDEO==================== -->
<div class="row" ng-show="VIDEO">
	<div class="tech-VIDEO small-12 medium-7 large-9 column">
		<video src="{{ videoUrl | trustUrl }}" controls muted autoplay>
			Our apologies, but video playback in not possible at this time. <a href="<?php echo content_url('/uploads/video/videos/'); ?>{{ techNote.link }}.mp4">Please download</a> the video to play it with video player of your choice. 
			
		</video>
	</div>
	
	<div class="first small-12 medium-5 large-3 column">
		<p class="tech-description" ng-bind-html="techNote.description" ng-hide="!techNote.description"><i class='fa fa-spinner' aria-hidden='true'></i></p>
		<p class="tech-citation" ng-bind-html="techNote.citation" ng-hide="!techNote.citation"><i class='fa fa-spinner' aria-hidden='true'></i></p>
		<div class="spaced pdfDownloadWrap">
			<a class="pdfDownloadIcon" href="<?php echo content_url('/uploads/video/videos/'); ?>{{ techNote.link }}.mp4"><i class=" down fa fa-download"></i></a>
		  <div class="pdfDownloadText">click <i class="fa fa-arrow-up"></i> to download <i class=" file fa fa-video-camera"></i></div>
		</div>
	</div>

</div>

<div class="row" ng-controller="techlibraryController">
	<div class="first small-12 medium-8 large-6 column">
	<p class="techNoteOther">Explore more of what {{ pi.title }} has to offer in one of the categories below.</p>
	<?php echo do_shortcode('[tech_nav]'); ?>
	</div>
</div>

<!-- ==============GI==================== -->
    
<!-- ========================END======================== -->
</div><!-- END DIV FOR CONTENT -->
			
			
			<?php comments_template(); ?>
	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>

<?php get_footer(); ?>
