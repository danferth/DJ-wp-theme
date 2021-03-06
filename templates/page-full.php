<?php
/*
Template Name: Full Width
*/
//start session to set timestamp
session_start();
if(isset($_SESSION['formLoadTime'])){
  unset($_SESSION['formLoadTime']);
  $_SESSION['formLoadTime'] = time();
}else{
  $_SESSION['formLoadTime'] = time();
};
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

<div class="row full-page-top" ng-app="tic" ng-controller="ticController" ng-strict-di>
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>" <?php echo $ng_controller; ?>>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="tweet-header-module">
					<span class="tweet-link animated">
					<a
						href="https://twitter.com/share"
						class="twitter-share-button"
						data-text="Check out <?php the_title(); ?> from Thomson!"
						data-url="<?php	true_url(); ?>"
						data-hashtags="science,TICscience"
						data-show-count="false">
						Tweet
					</a>
					<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					</span>
				</div>
			</header>
	<div class="small-12 large-12 columns" role="main">

			<div class="entry-content">
				<?php the_content(); ?>
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
			text: '<b>" . $first_name . "</b> your ". $form_type ." submission was a success we will contact you shortly about your inquiry into ". $product_type ."!',
			type: 'success',
			html: true,
			confirmButtonText: 'Thanks'
		});
	";
}elseif($form_success == "false"){
	echo "
		window.onload = swal({
			title: 'Whoops',
			text: 'Our apologies but there was an error <b>" . $first_name . "</b>, we have logged this and will have a fix soon!',
			type: 'error',
			html: true,
			confirmButtonText: 'OK'
		});
	";
}elseif($form_success == "email"){
	echo "
		window.onload = swal({
			title: 'Error',
			text: 'It seems there was an error with one or more of your email entries. " . $first_name . ", please make sure it is a valid email and try to submit the form again.',
			type: 'error',
			html: true,
			confirmButtonText: 'OK'
		});
	";
}elseif($form_success == "required"){
	echo "
		window.onload = swal({
			title: 'Error',
			text: 'It looks like you have missed some of the required fields in your attempt. Please make sure all fields with an <b>*</b> are completed and try submiting the form again.',
			type: 'error',
			html: true,
			confirmButtonText: 'OK'
		});
	";
}

?>

//function hasHTML5validation(){
//	return (typeof document.createElement('input').checkValidity == 'function');
//}
//if(!hasHTML5validation() ){
	$(window).bind("load", function() {
		  //$("#product-inquiry-sample").validate();
		  //$("#product-inquiry-quote").validate();
		  //$("#product-inquiry-contact").validate();
		  
		  $("#product-inquiry-sample").attr("novalidate","novalidate");
		  $("#product-inquiry-quote").attr("novalidate","novalidate");
		  $("#product-inquiry-contact").attr("novalidate","novalidate");
		  
});
//}
</script>

<?php get_footer(); ?>
