<?php
/*
Template Name: Full Width
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

<div class="row full-page-top <?php echo $prefooter_class; ?>" ng-app="tic" ng-controller="ticController">
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>" <?php echo $ng_controller; ?>>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
	<div class="small-12 large-12 columns" role="main">

			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			
			<!-- the below footer and enclosed p tag caused a position issue with the 
			prefooter optional addition to pages. It caused the prefooter to not sit 
			flush to the top of the  footer so is comented out as this site will probably 
			not have a series of multiple pages  uncoment or create new temploate to use -->
			<!--<footer>-->
			<!--	<?php //wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>-->
			<!--	<p><?php //the_tags(); ?></p>-->
			<!--</footer>-->
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
			text: '" . $first_name . " your ". $form_type ." submission was a success we will contact you shortly about your inquiry into ". $product_type ."!',
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
}

?>

function hasHTML5validation(){
	return (typeof document.createElement('input').checkValidity == 'function');
}
if( !hasHTML5validation() ){
	<?php 
	echo 'onload=function(){document.forms["product-inquery-sample"].reset()};
	onload=function(){document.forms["product-inquery-quote"].reset()};
	onload=function(){document.forms["product-inquery-contact"].reset()};
	jQuery(document).ready(function($){
		$("#product-inquery-sample").validate();
		$("#product-inquery-quote").validate();
		$("#product-inquery-contact").validate();
	});'; ?>
}
</script>

<?php get_footer(); ?>
