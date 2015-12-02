<?php
/*
Template Name: Tech Library
*/
if(get_post_meta($post->ID, "has-prefooter")){
$prefooter_class = "has-prefooter";
}else{
	$prefooter_class = "";
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

<?php

//add multi_expand option to this accordion
function mytestjs(){

echo "<script>
	$(document).foundation({
	accordion: {
		multi_expand: true,
		toggleable: true
	}
});
</script>";	
	
};

add_action('foundationpress_before_closing_body','mytestjs');
?>

<?php get_footer(); ?>