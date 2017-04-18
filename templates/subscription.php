<?php
/*
Template Name: Subscription
*/

//for forms
if(isset($_GET['success'])){
	$form_success = $_GET['success'];
}

if(isset($_GET['first_name'])){
	$first_name = $_GET['first_name'];
}

if(isset($_GET['form_type'])){
	$form_type = $_GET['form_type'];
}

if(isset($_GET['product'])){
	$product_type = $_GET['product'];
}

//for angular
$ng_controller = "";
if(get_post_meta($post->ID, "ng-controller")){
	$ngController = get_post_meta($post->ID, "ng-controller", true);
	$ng_controller = "ng-controller='" . $ngController . "'";
}


get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div class="row full-page-top subscription" ng-app="tic" ng-controller="ticController" ng-strict-di>
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>" <?php echo $ng_controller; ?>>
			<!--<header>-->
			<!--	<h1 class="entry-title"><?php the_title(); ?></h1>-->
			<!--</header>-->
	<div class="small-12 large-12 columns" role="main">

			<div class="entry-content">
				<?php
				  // if(!is_user_logged_in()){
				  //   echo "<p class='first'>Our apologies, but you need to log in to see this content, you can log in <a href='/login/'>here</a></p>";
				  // }else{
    		// 		the_content();
    		// 	}
    			
    			if( ! is_user_logged_in() ){
    			  printf('<p class="first">Our apologies, but you need to log in to see this page.</p>');
            printf( '<a href="%s">%s</a>', wp_login_url( get_permalink() ), __( '<button class="button small round">Click here to login</button>' ));
          }else{
            the_content();
          }
    			
    			?>
			</div>
			
			<?php comments_template(); ?>
	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>

<script type="text/javascript">
<?php
if($form_success == "true"){
	echo "
		window.onload = swal({
			title: 'Success',
			text: 'Thank you! Your submission was a success & we will make addjustment to the site with your input',
			type: 'success',
			html: true,
			confirmButtonText: 'Thanks'
		});
	";
}elseif($form_success == "false"){
	echo "
		window.onload = swal({
			title: 'Whoops',
			text: 'Our apologies but there was an error, we have logged this and will have a fix soon!',
			type: 'error',
			html: true,
			confirmButtonText: 'OK'
		});
	";
}

?>

	$(window).bind("load", function() {
		 $("#sftofv-form").validate();
		 $("#salestip-form").validate();
		 $('#suggest-tweet-form').validate();
		 $('#submit-tweet-form').validate();
		 $('#suggestion-box').validate();
});




</script>

<?php get_footer(); ?>
