<?php
/*
Template Name: No Angular
*/

get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div class="row full-page-top">
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
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

<?php get_footer(); ?>
