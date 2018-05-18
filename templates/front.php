<?php
/*
Template Name: Front
*/
get_header(); ?>

<header id="front-hero" role="banner">
	<div class="marketing">
		<div class="tagline">
			<h1><a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h4 class="subheader"><?php bloginfo( 'description' ); ?></h4>
		</div>

		<div id="watch" class="small-12 columns">
			<section id="stargazers">
				<a href="https://www.linkedin.com/company/thomson-instrument">Thomson Instrument Company</a>
			</section>
			<section id="twitter">
				<a href="https://twitter.com/tic_2017">@tic_2017</a>
			</section>
		</div>

	</div>

</header>

	<div class="row">
		<?php get_template_part( 'parts/check-if-sidebar-exist' ); ?>
		<?php do_action( 'foundationpress_before_content' ); ?>

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
				<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<footer>
					<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
					<p><?php the_tags(); ?></p>
				</footer>
				<?php do_action( 'foundationpress_page_before_comments' ); ?>
				<?php comments_template(); ?>
				<?php do_action( 'foundationpress_page_after_comments' ); ?>
			</article>
		<?php endwhile;?>

		<?php do_action( 'foundationpress_after_content' ); ?>

		</div>

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
