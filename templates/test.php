<?php
/*
Template Name: test
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
<div class="full-background show-for-medium-up row">
	<div class="full-background-image medium-12 column">
		<?php echo do_shortcode("[img class='full-image' src='page/UYF-hero.jpg']"); ?>
	</div>
	<div class="full-background-select medium-12 column">
		<select name="sub-science" ng-model="cell_line_choice" ng-options="cellLine.label for cellLine in cellLines">
			<option value="">choose your cell line</option>
		</select>
	</div>
</div>

<div class="show-for-small-only row">
	<div class="small-12 column">
		<select name="sub-science" ng-model="cellLineChoice" ng-options="cellLine.label for cellLine in cellLines">
			<option value="">choose your cell line</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="small-12 medium-6 large-7 column">
		<h2>Thomson Ultra Yield™ Solution</h2>
		<p>Thomson’s Ultra Yield Flasks™ (patented) have proven over the last decade to enhance the growth of E.coli & other microbial cells. The patented flask design makes them the work horse of protein and DNA labs worldwide. The Ultra Yield Flasks come in standardized sizes of 125mL, 250mL, 500mL and 2.5L.</p>
			<p>The flasks are designed to be closed on top by using our Enhanced AirOTop™ Seals (patented). These seals are designed to fit on the tops of the flasks. Enhanced AirOtop™ Seals are sterile, easy to use, and single use. The Enhanced AirOtop™ Seals properties include a 0.2µm resealable sterile membrane barrier providing high air exchange for all types of shake flasks.  Multiple sizes are available to keep all of your flasks covered. Testing has been conducted at multiple customer sites with great results on up to 24 hours of growth. The organisms tested included Protista (Algae), E.coli and other microbes which have resulted in improved cell density, a more neutral pH of the cultures with the increased gas exchange.</p>
	</div>
	<div class="small-12 medium-6 large-5 column">
		<product-inquiry product="Ultra Yield Flask"></product-inquiry>
	</div>
</div>

<div class="row">
	<div class="small-12 medium-7 large-5 column">
		<h2>Key Features</h2>
		<ul>
			<li>10x Increased Aeration Over Standard Shake Flasks</li>
			<li>Increased DNA & Protein Production</li>
			<li>Fully Scalable Results</li>
			<li>Replacement For Glass Flasks</li>
			<li>Fit All Standard Flask Clamps</li>
			<li>Easily Adaptable Into Microbial Growth Protocols</li>
			<li>Sterile, Disposable, Single-Use Flasks From 125mL - 2.5L</li>
		</ul>
	</div>

	<div class="small-12 medium-5 large-7 column">
		<?php echo do_shortcode("[img src='page/UYF-flask-in-shaker.jpg']"); ?>
		<p class="disclaimer">Thomson is not affiliated with Khuner or there products</p>
	</div>
</div>

<div class="row">
	<div class="small-12 column">
		<?php echo do_shortcode("[img src='page/UYF-scaleable-hero.jpg']"); ?>
	</div>
</div>

<div class="row">
	<div class="small-12 medium-6 column">
		<h2>Data from Pfizer-610% Yeild Increase*</h2>
		<?php echo do_shortcode("[img src='page/UYF-pfizer-data.jpg']"); ?>
		<p class="disclaimer">*Economical parallel protein expression screening and scale-up in Escherichia coli.  Journal of Structural and Functional Genomics2006 Jun;7(2):101-8. Epub 2006 Dec 23.</p>
	</div>

	<div class="small-12 medium-6 column">
		<h2>Data from GSK</h2>
		<?php echo do_shortcode("[img src='page/UYF-gsk-data.jpg']"); ?>
	</div>
</div>
    <?php 
    echo do_shortcode("[parts title='Ultra Yield Flask' line='UYF' series='flask']");
    ?>  
      
      
<!-- ========================END======================== -->
</div><!-- END DIV FOR CONTENT -->
			
			
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
