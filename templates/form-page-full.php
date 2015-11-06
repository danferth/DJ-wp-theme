<?php
/*
Template Name: FORM Full Width

//grab get and custom fields
*/
if(isset($_GET['success'])){
	$form_success = $_GET['success'];
}

$first_name = $_GET['first_name'];

if(get_post_meta($post->ID, "form-parse")){
$parse = '/wp-content/themes/TIC/form-parse/' . get_post_meta($post->ID, "form-parse", true) . '.php';
}

if(get_post_meta($post->ID, "form-ID")){
$form_id = get_post_meta($post->ID, "form-ID", true);
}

get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div class="row form-page-top">
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			
	<div class="small-12 large-12 columns" role="main">

			<div class="entry-content">
				<?php echo "<form action='" . $parse . "' method='POST' id='" . $form_id . "'>"; 
				
				/*
				CUSTOM FIELDS NEEDED:
				---------------------
				form-parse 	= file name of parse file exclude '.php'
				form_ID 		= ID of form used for form ID and jQuery validate
				
				EXTRA FILES NEEDED FOR THIS TO WORK:
				------------------------------------
				parse-$form-parse
				'form name'-error.txt make sure this is on server and has permisions 770
				
				BASIC FORM SETUP
				----------------
				Note: first name field that gets passed must be $_GET['first_name'] 
				
				<span>
					<input placeholder="label"> this is not required
				</span>
				
				<span id="ID of input">
					<input placeholder="label" required>
				</span>
				
				These do not require spans
				--------------------------
				<textarea>
				<input type="submit">
				*/
				?>	
			
				<?php the_content(); ?>
				
				</form>
				
			</div>
			<footer>
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
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
			text: '<b>" . $first_name . "</b> your submission was a success we will contact you shortly about your inquiry!',
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
			confirmButtonText: 'well shit!'
		});
	";
}

?>

function hasHTML5validation(){
	return (typeof document.createElement('input').checkValidity == 'function');
}
if( !hasHTML5validation() ){
	<?php 
	echo 'onload=function(){document.forms["' . $form_id .'"].reset()};
	jQuery(document).ready(function($){
		$("#' . $form_id . '").validate();
	});'; ?>
}
</script>

<?php get_footer(); ?>
