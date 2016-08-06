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


<ul>
	<li ng-repeat="p in products | filter:{line:'FV'} | filter:{series:'standard'}">{{ p.title }}</li>
</ul>

<button class="button large overlayBtn">Show me the overlay</button>

<script>
var overlay = "<div class='overlay hidden'><div class='overlay-content'><div class='row'><div class='small=12 column'><p>Here is some content</p></div></div></div></div>";

	$('body').prepend(overlay);
	
	$('button.overlayBtn').on('click', function(){
		$('.overlay').removeClass('hidden');
		$('.overlay-content').addClass('animated fadeInUp');
	});
	
	$('.overlay').on('click', function(){
		$(this).addClass('hidden');
		$('.overlay-content').removeClass('animated fadeInUp')
	});
</script>


<!-- ========================END======================== -->
</div><!-- END DIV FOR CONTENT -->
			
			
			<?php comments_template(); ?>
	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>

<?php get_footer(); ?>
